<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BeneficiaryController extends Controller
{
    /**
     * عرض قائمة المستفيدين
     */
    public function index()
    {
        $beneficiaries = Beneficiary::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * عرض نموذج تسجيل مستفيد جديد
     */
    public function create()
    {
        return view('frontend.beneficiaries.create');
    }

    /**
     * حفظ مستفيد جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:beneficiaries',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'has_diseases' => 'required|boolean',
            'is_supporting_others' => 'required|boolean',
            'marital_status' => 'required|string',
            'family_members_count' => 'required|integer|min:1',
            'children_under_10_count' => 'required|integer|min:0',
            'critical_surgery_diseases' => 'nullable|string',
            'average_monthly_income' => 'required|numeric|min:0',
            'id_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_book' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // تخزين الملفات
        $documentPath = $request->file('document')->store('beneficiary_documents');
        $idDocumentPath = $request->file('id_document')->store('beneficiary_id_documents');
        $familyBookPath = $request->file('family_book') ? $request->file('family_book')->store('beneficiary_family_books') : null;

        // إنشاء المستفيد
        $beneficiary = Beneficiary::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'age' => $validated['age'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'document_path' => $documentPath,
            'has_diseases' => $validated['has_diseases'],
            'is_supporting_others' => $validated['is_supporting_others'],
            'marital_status' => $validated['marital_status'],
            'family_members_count' => $validated['family_members_count'],
            'children_under_10_count' => $validated['children_under_10_count'],
            'critical_surgery_diseases' => $validated['critical_surgery_diseases'],
            'average_monthly_income' => $validated['average_monthly_income'],
            'id_document' => $idDocumentPath,
            'family_book' => $familyBookPath,
            'is_approved' => false,
        ]);

        // إنشاء إشعار للمدير
        $title = 'مستفيد جديد';
        $message = 'تم تسجيل مستفيد جديد: ' . $beneficiary->name;
        $url = URL::route('admin.beneficiaries.show', $beneficiary->id);

        AdminNotification::create([
            'title' => $title,
            'message' => $message,
            'type' => 'beneficiary',
            'record_id' => $beneficiary->id,
            'url' => $url,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'تم تسجيل طلبك بنجاح وجاري مراجعته');
    }
} 