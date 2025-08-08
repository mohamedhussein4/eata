<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('translations', function($tq) use ($search) {
                      $tq->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                  });
            });
        }

        // فلتر الحالة
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // الترتيب
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'amount_high':
                $query->orderBy('total_amount', 'desc');
                break;
            case 'amount_low':
                $query->orderBy('total_amount', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $projects = $query->paginate(12);

        return view('frontend.projects.index', compact('projects'));
    }

    /**
     * عرض تفاصيل المشروع
     */
    public function show(Project $project)
    {
        // زيادة عدد الزيارات
        $project->increment('visits');

        // جلب المشاريع المشابهة
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->with('translations')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.projects.show', compact('project', 'relatedProjects'));
    }
} 