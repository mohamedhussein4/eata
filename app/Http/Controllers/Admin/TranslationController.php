<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\BeneficiaryStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranslationController extends Controller
{
    public function index()
    {
        return view('admin.translations.index');
    }

    public function projects()
    {
        $projects = Project::withCount('translations')->latest()->paginate(10);
        return view('admin.translations.projects', compact('projects'));
    }

    public function editProject(Project $project)
    {
        return view('admin.translations.edit-project', compact('project'));
    }

    public function updateProject(Request $request, Project $project)
    {
        $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.description' => 'required|string',
            'translations.*.content' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->translations as $locale => $translation) {
                $project->translations()->updateOrCreate(
                    ['locale' => $translation['locale']],
                    [
                        'title' => $translation['title'],
                        'description' => $translation['description'],
                        'content' => $translation['content'] ?? null,
                    ]
                );
            }
            DB::commit();
            return redirect()->route('admin.translations.projects')
                ->with('success', 'تم تحديث الترجمة بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'حدث خطأ أثناء حفظ الترجمة');
        }
    }

    public function pages()
    {
        $pages = Page::withCount('translations')->latest()->paginate(10);
        return view('admin.translations.pages', compact('pages'));
    }

    public function editPage(Page $page)
    {
        return view('admin.translations.edit-page', compact('page'));
    }

    public function updatePage(Request $request, Page $page)
    {
        $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->translations as $locale => $translation) {
                $page->translations()->updateOrCreate(
                    ['locale' => $translation['locale']],
                    [
                        'title' => $translation['title'],
                        'content' => $translation['content'],
                    ]
                );
            }
            DB::commit();
            return redirect()->route('admin.translations.pages')
                ->with('success', 'تم تحديث الترجمة بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'حدث خطأ أثناء حفظ الترجمة');
        }
    }

    public function testimonials()
    {
        $testimonials = Testimonial::withCount('translations')->latest()->paginate(10);
        return view('admin.translations.testimonials', compact('testimonials'));
    }

    public function editTestimonial(Testimonial $testimonial)
    {
        return view('admin.translations.edit-testimonial', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->translations as $locale => $translation) {
                $testimonial->translations()->updateOrCreate(
                    ['locale' => $translation['locale']],
                    [
                        'name' => $translation['name'],
                        'content' => $translation['content'],
                    ]
                );
            }
            DB::commit();
            return redirect()->route('admin.translations.testimonials')
                ->with('success', 'تم تحديث الترجمة بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'حدث خطأ أثناء حفظ الترجمة');
        }
    }

    public function stories()
    {
        $stories = BeneficiaryStory::withCount('translations')->latest()->paginate(10);
        return view('admin.translations.stories', compact('stories'));
    }

    public function editStory(BeneficiaryStory $story)
    {
        return view('admin.translations.edit-story', compact('story'));
    }

    public function updateStory(Request $request, BeneficiaryStory $story)
    {
        $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->translations as $locale => $translation) {
                $story->translations()->updateOrCreate(
                    ['locale' => $translation['locale']],
                    [
                        'title' => $translation['title'],
                        'content' => $translation['content'],
                    ]
                );
            }
            DB::commit();
            return redirect()->route('admin.translations.stories')
                ->with('success', 'تم تحديث الترجمة بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'حدث خطأ أثناء حفظ الترجمة');
        }
    }
} 