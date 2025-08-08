<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\BeneficiaryStory;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        $testimonials = Testimonial::where('is_approved', true)
            ->latest()
            ->take(4)
            ->get();

        $featuredStories = BeneficiaryStory::where('is_approved', true)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.index', compact('featuredProjects', 'testimonials', 'featuredStories'));
    }

    public function showProject($id)
    {
        $project = Project::where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        // زيادة عدد المشاهدات
        $project->increment('visits');

        // جلب مشاريع مشابهة
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.projects.show', compact('project', 'relatedProjects'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about-us')->first();
        return view('frontend.page', compact('page'));
    }

    public function contact()
    {
        return view('frontend.contact.index');
    }

    public function privacy()
    {
        $page = Page::where('slug', 'privacy-policy')->first();
        return view('frontend.page', compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms-of-service')->first();
        return view('frontend.page', compact('page'));
    }

    public function faq()
    {
        $page = Page::where('slug', 'faq')->first();
        return view('frontend.page', compact('page'));
    }
} 