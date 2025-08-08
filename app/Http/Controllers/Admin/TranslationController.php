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
        // إحصائيات المشاريع
        $projectsCount = Project::count();
        $projectsTranslatedCount = Project::whereHas('translations')->count();

        // إحصائيات الصفحات
        $pagesCount = Page::count();
        $pagesTranslatedCount = Page::whereHas('translations')->count();

        // إحصائيات الآراء
        $testimonialsCount = Testimonial::count();
        $testimonialsTranslatedCount = Testimonial::whereHas('translations')->count();

        // إحصائيات القصص
        $storiesCount = BeneficiaryStory::count();
        $storiesTranslatedCount = BeneficiaryStory::whereHas('translations')->count();

        // إجمالي المحتوى العربي والإنجليزي
        $arabicContent = $projectsCount + $pagesCount + $testimonialsCount + $storiesCount;
        $englishContent = $projectsTranslatedCount + $pagesTranslatedCount + $testimonialsTranslatedCount + $storiesTranslatedCount;

        // حساب نسبة الترجمة الإجمالية
        $translationProgress = $arabicContent > 0 ? round(($englishContent / $arabicContent) * 100) : 0;

        return view('admin.translations.index', compact(
            'projectsCount',
            'pagesCount',
            'testimonialsCount',
            'storiesCount',
            'arabicContent',
            'englishContent',
            'translationProgress'
        ));
    }

        public function projects()
    {
        $totalCount = Project::count();
        $translatedCount = Project::whereHas('translations')->count();
        $pendingCount = $totalCount - $translatedCount;
        $translationProgress = $totalCount > 0 ? round(($translatedCount / $totalCount) * 100) : 0;

        $projects = Project::withCount('translations')
            ->when(request('search'), function($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('description', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('translation_status'), function($query) {
                if (request('translation_status') === 'translated') {
                    $query->whereHas('translations');
                } elseif (request('translation_status') === 'pending') {
                    $query->doesntHave('translations');
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.translations.projects', compact(
            'projects',
            'totalCount',
            'translatedCount',
            'pendingCount',
            'translationProgress'
        ));
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
        $totalCount = Page::count();
        $translatedCount = Page::whereHas('translations')->count();
        $pendingCount = $totalCount - $translatedCount;
        $translationProgress = $totalCount > 0 ? round(($translatedCount / $totalCount) * 100) : 0;

        $pages = Page::withCount('translations')
            ->when(request('search'), function($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('content', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('translation_status'), function($query) {
                if (request('translation_status') === 'translated') {
                    $query->whereHas('translations');
                } elseif (request('translation_status') === 'pending') {
                    $query->doesntHave('translations');
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.translations.pages', compact(
            'pages',
            'totalCount',
            'translatedCount',
            'pendingCount',
            'translationProgress'
        ));
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
        $totalCount = Testimonial::count();
        $translatedCount = Testimonial::whereHas('translations')->count();
        $pendingCount = $totalCount - $translatedCount;
        $translationProgress = $totalCount > 0 ? round(($translatedCount / $totalCount) * 100) : 0;

        $testimonials = Testimonial::withCount('translations')
            ->when(request('search'), function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('content', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('translation_status'), function($query) {
                if (request('translation_status') === 'translated') {
                    $query->whereHas('translations');
                } elseif (request('translation_status') === 'pending') {
                    $query->doesntHave('translations');
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.translations.testimonials', compact(
            'testimonials',
            'totalCount',
            'translatedCount',
            'pendingCount',
            'translationProgress'
        ));
    }

    public function editTestimonial(Testimonial $testimonial)
    {
        return view('admin.translations.edit-testimonial', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        \Log::info('Testimonial Translation Update Request:', [
            'testimonial_id' => $testimonial->id,
            'request_data' => $request->all()
        ]);

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
            \Log::info('Testimonial Translation Updated Successfully:', [
                'testimonial_id' => $testimonial->id,
                'translations' => $testimonial->translations()->get()->toArray()
            ]);
            return redirect()->route('admin.translations.testimonials')
                ->with('success', 'تم تحديث الترجمة بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'حدث خطأ أثناء حفظ الترجمة');
        }
    }

    public function stories()
    {
        $totalCount = BeneficiaryStory::count();
        $translatedCount = BeneficiaryStory::whereHas('translations')->count();
        $pendingCount = $totalCount - $translatedCount;
        $translationProgress = $totalCount > 0 ? round(($translatedCount / $totalCount) * 100) : 0;

        $stories = BeneficiaryStory::withCount('translations')
            ->when(request('search'), function($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('content', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('translation_status'), function($query) {
                if (request('translation_status') === 'translated') {
                    $query->whereHas('translations');
                } elseif (request('translation_status') === 'pending') {
                    $query->doesntHave('translations');
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.translations.stories', compact(
            'stories',
            'totalCount',
            'translatedCount',
            'pendingCount',
            'translationProgress'
        ));
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
