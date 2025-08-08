<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.beneficiaries.index', compact('beneficiaries'));
    }

    public function show(Beneficiary $beneficiary)
    {
        return view('admin.beneficiaries.show', compact('beneficiary'));
    }

    public function edit(Beneficiary $beneficiary)
    {
        return view('admin.beneficiaries.edit', compact('beneficiary'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:beneficiaries,email,' . $beneficiary->id,
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'is_approved' => 'boolean',
        ]);

        $beneficiary->update($validated);

        return redirect()->route('admin.beneficiaries.index')->with('success', 'تم تحديث المستفيد بنجاح');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->route('admin.beneficiaries.index')->with('success', 'تم حذف المستفيد بنجاح');
    }

    public function approve(Beneficiary $beneficiary)
    {
        $beneficiary->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'تم الموافقة على المستفيد بنجاح');
    }
} 