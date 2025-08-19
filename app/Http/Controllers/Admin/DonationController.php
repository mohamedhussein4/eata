<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['user', 'project', 'bankAccount', 'eWallet'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        return view('admin.donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,rejected',
            'notes' => 'nullable|string',
        ]);

        $donation->update($validated);

        return redirect()->route('admin.donations.index')->with('success', 'تم تحديث التبرع بنجاح');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'تم حذف التبرع بنجاح');
    }

    public function approve(Donation $donation)
    {
        $donation->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'تم الموافقة على التبرع بنجاح');
    }

    public function reject(Donation $donation)
    {
        $donation->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'تم رفض التبرع بنجاح');
    }

    public function updateStatus(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        $donation->update(['status' => $request->status]);

        $statusText = $request->status === 'confirmed' ? 'تم قبول' : 'تم رفض';
        return redirect()->back()->with('success', $statusText . ' التبرع بنجاح');
    }
}
