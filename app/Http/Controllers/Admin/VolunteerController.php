<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function create()
    {
        return view('admin.volunteers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'age' => 'required|integer|min:18',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'motivation' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'is_approved' => 'boolean',
        ]);

        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('volunteer_cvs', 'public');
        }

        Volunteer::create($validated);

        return redirect()->route('admin.volunteers.index')->with('success', 'تم إنشاء المتطوع بنجاح');
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        return view('admin.volunteers.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email,' . $volunteer->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'age' => 'required|integer|min:18',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'motivation' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'is_approved' => 'boolean',
        ]);

        if ($request->hasFile('cv')) {
            // حذف الملف القديم إذا وجد
            if ($volunteer->cv) {
                \Storage::disk('public')->delete($volunteer->cv);
            }
            $validated['cv'] = $request->file('cv')->store('volunteer_cvs', 'public');
        }

        $volunteer->update($validated);

        return redirect()->route('admin.volunteers.index')->with('success', 'تم تحديث المتطوع بنجاح');
    }

    public function destroy(Volunteer $volunteer)
    {
        // حذف الملف المرفق إذا وجد
        if ($volunteer->cv) {
            \Storage::disk('public')->delete($volunteer->cv);
        }
        
        $volunteer->delete();
        return redirect()->route('admin.volunteers.index')->with('success', 'تم حذف المتطوع بنجاح');
    }

    public function approve(Volunteer $volunteer)
    {
        $volunteer->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'تم الموافقة على المتطوع بنجاح');
    }

    public function reject(Volunteer $volunteer)
    {
        $volunteer->update(['is_approved' => false]);
        return redirect()->back()->with('success', 'تم رفض المتطوع بنجاح');
    }
} 