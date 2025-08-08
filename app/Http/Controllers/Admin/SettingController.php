<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        if (!$settings) {
            $settings = Setting::create([]);
        }
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'copyright' => 'nullable|string',
            'footer_description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->extension();
            $logo->move(public_path('logos'), $logoName);
            $validated['logo'] = 'logos/' . $logoName;
        }

        $settings = Setting::first();
        if (!$settings) {
            $settings = Setting::create([]);
        }
        $settings->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الإعدادات بنجاح');
    }

    // إدارة الصفحات
    public function pages()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.settings.pages.index', compact('pages'));
    }

    public function createPage()
    {
        return view('admin.settings.pages.create');
    }

    public function storePage(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|max:255|unique:pages',
            'is_active' => 'boolean',
        ]);

        Page::create($validated);

        return redirect()->route('admin.settings.pages.index')->with('success', 'تم إضافة الصفحة بنجاح');
    }

    public function showPage(Page $page)
    {
        return view('admin.settings.pages.show', compact('page'));
    }

    public function editPage(Page $page)
    {
        return view('admin.settings.pages.edit', compact('page'));
    }

    public function updatePage(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'is_active' => 'boolean',
        ]);

        $page->update($validated);

        return redirect()->route('admin.settings.pages.index')->with('success', 'تم تحديث الصفحة بنجاح');
    }

    public function destroyPage(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.settings.pages.index')->with('success', 'تم حذف الصفحة بنجاح');
    }
} 