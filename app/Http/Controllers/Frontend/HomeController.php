<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\BeneficiaryStory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * عرض الصفحة الرئيسية
     */
    public function index()
    {
        // جلب المشاريع المميزة
        $featuredProjects = Project::where('is_featured', true)
            ->with('translations')
            ->latest()
            ->take(6)
            ->get();

        // جلب آراء العملاء المعتمدة
        $testimonials = Testimonial::where('is_approved', true)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        // جلب قصص المستفيدين المميزة
        $featuredStories = BeneficiaryStory::where('is_approved', true)
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home', compact('featuredProjects', 'testimonials', 'featuredStories'));
    }

    /**
     * عرض الملف الشخصي للمستخدم
     */
    public function profile()
    {
        $user = auth()->user();
        return view('frontend.profile.index', compact('user'));
    }

    /**
     * تحديث الملف الشخصي
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
} 