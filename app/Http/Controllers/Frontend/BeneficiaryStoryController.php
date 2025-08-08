<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BeneficiaryStory;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class BeneficiaryStoryController extends Controller
{
    /**
     * عرض قائمة قصص المستفيدين
     */
    public function index()
    {
        $stories = BeneficiaryStory::where('is_approved', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.stories.index', compact('stories'));
    }

    /**
     * عرض نموذج إنشاء قصة جديدة
     */
    public function create()
    {
        return view('frontend.stories.create');
    }

    /**
     * حفظ قصة جديدة
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'beneficiary_name' => 'required|string|max:255',
            'beneficiary_age' => 'required|integer|min:1',
            'beneficiary_location' => 'required|string|max:255',
            'story_type' => 'required|in:success,need,emergency',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:2048',
            'is_anonymous' => 'boolean',
        ]);

        // معالجة الملفات
        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('story_media', 'public');
            $validated['media'] = 'storage/' . $mediaPath;
        }

        // إنشاء القصة
        $story = BeneficiaryStory::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'beneficiary_name' => $validated['beneficiary_name'],
            'beneficiary_age' => $validated['beneficiary_age'],
            'beneficiary_location' => $validated['beneficiary_location'],
            'story_type' => $validated['story_type'],
            'media' => $validated['media'] ?? null,
            'is_anonymous' => $request->has('is_anonymous'),
            'is_approved' => false,
            'is_featured' => false,
        ]);

        // إنشاء إشعار للمدير
        $title = 'قصة مستفيد جديدة';
        $message = 'تم إضافة قصة جديدة: ' . $story->title;
        $url = URL::route('admin.stories.show', $story->id);

        AdminNotification::create([
            'title' => $title,
            'message' => $message,
            'type' => 'story',
            'record_id' => $story->id,
            'url' => $url,
            'is_read' => false,
        ]);

        return redirect()->route('stories.index')
            ->with('success', 'تم إرسال قصتك بنجاح وسيتم مراجعتها قريباً');
    }

    /**
     * عرض تفاصيل القصة
     */
    public function show(BeneficiaryStory $story)
    {
        // التحقق من أن القصة معتمدة
        if (!$story->is_approved) {
            abort(404);
        }

        // زيادة عدد المشاهدات
        $story->increment('views');

        // جلب قصص مشابهة
        $relatedStories = BeneficiaryStory::where('id', '!=', $story->id)
            ->where('is_approved', true)
            ->where('story_type', $story->story_type)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.stories.show', compact('story', 'relatedStories'));
    }

    /**
     * عرض قصص المستخدم
     */
    public function myStories()
    {
        $stories = BeneficiaryStory::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.stories.my-stories', compact('stories'));
    }

    /**
     * عرض نموذج تعديل القصة
     */
    public function edit(BeneficiaryStory $story)
    {
        // التحقق من ملكية القصة
        if ($story->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.stories.edit', compact('story'));
    }

    /**
     * تحديث القصة
     */
    public function update(Request $request, BeneficiaryStory $story)
    {
        // التحقق من ملكية القصة
        if ($story->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'beneficiary_name' => 'required|string|max:255',
            'beneficiary_age' => 'required|integer|min:1',
            'beneficiary_location' => 'required|string|max:255',
            'story_type' => 'required|in:success,need,emergency',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:2048',
            'is_anonymous' => 'boolean',
        ]);

        // معالجة الملفات
        if ($request->hasFile('media')) {
            // حذف الملف القديم
            if ($story->media) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $story->media));
            }
            
            $mediaPath = $request->file('media')->store('story_media', 'public');
            $validated['media'] = 'storage/' . $mediaPath;
        }

        $story->update($validated);

        return redirect()->route('stories.my-stories')
            ->with('success', 'تم تحديث القصة بنجاح');
    }

    /**
     * حذف القصة
     */
    public function destroy(BeneficiaryStory $story)
    {
        // التحقق من ملكية القصة
        if ($story->user_id !== Auth::id()) {
            abort(403);
        }

        // حذف الملف المرتبط
        if ($story->media) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $story->media));
        }

        $story->delete();

        return redirect()->route('stories.my-stories')
            ->with('success', 'تم حذف القصة بنجاح');
    }
} 