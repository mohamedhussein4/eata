<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VolunteerController extends Controller
{
    /**
     * عرض قائمة المتطوعين
     */
    public function index()
    {
        $volunteers = Volunteer::
            orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.volunteers.index', compact('volunteers'));
    }

    /**
     * عرض نموذج تسجيل متطوع جديد
     */
    public function create()
    {
        return view('frontend.volunteers.create');
    }

    /**
     * حفظ متطوع جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'age' => 'required|integer|min:18',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'previous_experiences' => 'nullable|string',
            'academic_degree' => 'required|string|max:255',
            'id_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // تخزين الملفات
        $documentPath = $request->file('document')->store('volunteer_documents');
        $idDocumentPath = $request->file('id_document')->store('volunteer_id_documents');
        $cvPath = $request->file('cv')->store('volunteer_cvs');

        // إنشاء المتطوع
        $volunteer = Volunteer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'age' => $validated['age'],
            'document_path' => $documentPath,
            'previous_experiences' => $validated['previous_experiences'],
            'academic_degree' => $validated['academic_degree'],
            'id_document' => $idDocumentPath,
            'cv_path' => $cvPath,
            'is_approved' => false,
        ]);

        // إنشاء إشعار للمدير
        $title = 'متطوع جديد';
        $message = 'تم تسجيل متطوع جديد: ' . $volunteer->name;
        $url = URL::route('admin.volunteers.show', $volunteer->id);

        AdminNotification::create([
            'title' => $title,
            'message' => $message,
            'type' => 'volunteer',
            'record_id' => $volunteer->id,
            'url' => $url,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'تم تسجيل طلبك بنجاح وجاري مراجعته');
    }
}
