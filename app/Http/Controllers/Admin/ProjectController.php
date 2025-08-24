<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * عرض قائمة المشاريع
     */
    public function index(Request $request)
    {
        $query = Project::with(['translations']);

        // البحث
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // فلتر الحالة
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * عرض نموذج إنشاء مشروع
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * حفظ مشروع جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'target_amount' => 'required|numeric|min:0',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:255',
            'image_or_video' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:10240',
            'is_featured' => 'nullable|boolean',
            'allow_donations' => 'nullable|boolean',
            'action' => 'required|in:draft,publish',
        ]);

        // تحديد الحالة بناء على الإجراء
        $status = $validated['action'] === 'publish' ? 'active' : 'draft';

        // إنشاء المشروع
        $projectData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'total_amount' => $validated['target_amount'], // تحويل من target_amount إلى total_amount
            'remaining_amount' => $validated['target_amount'], // في البداية المبلغ المتبقي = المبلغ المستهدف
            'beneficiaries_count' => $validated['beneficiaries_count'] ?? 0,
            'category' => $validated['category'] ?? null,
            'status' => $status,
            'is_featured' => $validated['is_featured'] ?? false,
            'visits' => 0,
        ];

        // معالجة الصورة/الفيديو
        if ($request->hasFile('image_or_video')) {
            $imagePath = $request->file('image_or_video')->store('projects', 'public');
            $projectData['image_or_video'] = $imagePath;
        }

        $project = Project::create($projectData);

        // إضافة الترجمات إذا كانت موجودة
        if (!empty($validated['title_en']) || !empty($validated['description_en'])) {
            $project->translations()->create([
                'locale' => 'en',
                'title' => $validated['title_en'],
                'description' => $validated['description_en'],
            ]);
        }

        $message = $status === 'active' ? 'تم إنشاء ونشر المشروع بنجاح' : 'تم حفظ المشروع كمسودة بنجاح';
        
        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    /**
     * عرض تفاصيل المشروع
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * عرض نموذج تعديل المشروع
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * تحديث المشروع
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'target_amount' => 'required|numeric|min:0',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:255',
            'image_or_video' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:10240',
            'is_featured' => 'nullable|boolean',
            'allow_donations' => 'nullable|boolean',
        ]);

        // تحديث بيانات المشروع
        $projectData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'total_amount' => $validated['target_amount'], // تحويل من target_amount إلى total_amount
            'beneficiaries_count' => $validated['beneficiaries_count'] ?? 0,
            'category' => $validated['category'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
        ];

        // معالجة الصورة/الفيديو الجديدة
        if ($request->hasFile('image_or_video')) {
            // حذف الصورة القديمة
            if ($project->image_or_video) {
                Storage::disk('public')->delete($project->image_or_video);
            }
            
            $imagePath = $request->file('image_or_video')->store('projects', 'public');
            $projectData['image_or_video'] = $imagePath;
        }

        $project->update($projectData);

        // تحديث أو إضافة الترجمات
        if (!empty($validated['title_en']) || !empty($validated['description_en'])) {
            $project->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'title' => $validated['title_en'],
                    'description' => $validated['description_en'],
                ]
            );
        }

        return redirect()->route('admin.projects.index')->with('success', 'تم تحديث المشروع بنجاح');
    }

    /**
     * حذف المشروع
     */
    public function destroy(Project $project)
    {
        if ($project->image_or_video) {
            Storage::disk('public')->delete($project->image_or_video);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'تم حذف المشروع بنجاح');
    }

    /**
     * تبديل حالة التمييز
     */
    public function toggleFeatured(Project $project)
    {
        $project->update(['is_featured' => !$project->is_featured]);

        return redirect()->back()->with('success', 'تم تحديث حالة التمييز بنجاح');
    }

    /**
     * الموافقة على المشروع
     */
    public function approve(Project $project)
    {
        $project->update(['is_active' => true]);

        return redirect()->back()->with('success', 'تم الموافقة على المشروع بنجاح');
    }
} 