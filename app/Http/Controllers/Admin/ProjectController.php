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
            'description' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'image_or_video' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_or_video')) {
            $imagePath = $request->file('image_or_video')->store('projects', 'public');
            $validated['image_or_video'] = $imagePath;
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'تم إنشاء المشروع بنجاح');
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
            'description' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'image_or_video' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_or_video')) {
            // حذف الصورة القديمة
            if ($project->image_or_video) {
                Storage::disk('public')->delete($project->image_or_video);
            }
            
            $imagePath = $request->file('image_or_video')->store('projects', 'public');
            $validated['image_or_video'] = $imagePath;
        }

        $project->update($validated);

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