<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeneficiaryStory;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeneficiaryStoryController extends Controller
{
    public function index()
    {
        $stories = BeneficiaryStory::with('beneficiary')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.stories.index', compact('stories'));
    }

    public function pending()
    {
        $stories = BeneficiaryStory::where('status', 'pending')->with('beneficiary')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.stories.pending', compact('stories'));
    }

    public function create()
    {
        $beneficiaries = Beneficiary::all();
        return view('admin.stories.create', compact('beneficiaries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,pending,published',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories', 'public');
            $validated['image'] = $imagePath;
        }

        BeneficiaryStory::create($validated);

        return redirect()->route('admin.stories.index')->with('success', 'تم إضافة القصة بنجاح');
    }

    public function show(BeneficiaryStory $story)
    {
        return view('admin.stories.show', compact('story'));
    }

    public function edit(BeneficiaryStory $story)
    {
        $beneficiaries = Beneficiary::all();
        return view('admin.stories.edit', compact('story', 'beneficiaries'));
    }

    public function update(Request $request, BeneficiaryStory $story)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,pending,published',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($story->image) {
                Storage::disk('public')->delete($story->image);
            }
            
            $imagePath = $request->file('image')->store('stories', 'public');
            $validated['image'] = $imagePath;
        }

        $story->update($validated);

        return redirect()->route('admin.stories.index')->with('success', 'تم تحديث القصة بنجاح');
    }

    public function destroy(BeneficiaryStory $story)
    {
        if ($story->image) {
            Storage::disk('public')->delete($story->image);
        }

        $story->delete();

        return redirect()->route('admin.stories.index')->with('success', 'تم حذف القصة بنجاح');
    }

    public function approve(BeneficiaryStory $story)
    {
        $story->update(['status' => 'published']);
        return redirect()->back()->with('success', 'تم الموافقة على القصة بنجاح');
    }

    public function reject(BeneficiaryStory $story)
    {
        $story->update(['status' => 'draft']);
        return redirect()->back()->with('success', 'تم رفض القصة');
    }

    public function unapprove(BeneficiaryStory $story)
    {
        $story->update(['status' => 'pending']);
        return redirect()->back()->with('success', 'تم إلغاء الموافقة على القصة بنجاح');
    }

    public function toggleFeatured(BeneficiaryStory $story)
    {
        $story->update(['is_featured' => !$story->is_featured]);
        return redirect()->back()->with('success', 'تم تحديث حالة التمييز بنجاح');
    }
} 