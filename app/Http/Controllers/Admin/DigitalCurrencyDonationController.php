<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalCurrencyDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigitalCurrencyDonationController extends Controller
{
    /**
     * عرض قائمة تبرعات العملات الرقمية
     */
    public function index()
    {
        $digitalDonations = DigitalCurrencyDonation::with(['user'])
            ->latest()
            ->get();

        // إحصائيات التبرعات
        $statistics = [
            'total' => $digitalDonations->count(),
            'pending' => $digitalDonations->where('status', 'pending')->count(),
            'completed' => $digitalDonations->where('status', 'completed')->count(),
            'cancelled' => $digitalDonations->where('status', 'cancelled')->count(),
            'total_amount' => $digitalDonations->sum('amount'),
            'completed_amount' => $digitalDonations->where('status', 'completed')->sum('amount'),
        ];

        return view('admin.digital-currency-donations.index', compact('digitalDonations', 'statistics'));
    }

    /**
     * تحديث حالة التبرع
     */
    public function updateStatus(Request $request, DigitalCurrencyDonation $digitalDonation)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $digitalDonation->update([
            'status' => $request->status
        ]);

        // إنشاء إشعار للمستخدم
        if ($digitalDonation->user_id) {
            \App\Models\Notification::create([
                'user_id' => $digitalDonation->user_id,
                'title' => app()->getLocale() === 'ar' ? 'تحديث حالة التبرع' : 'Donation Status Update',
                'message' => app()->getLocale() === 'ar' 
                    ? 'تم تحديث حالة تبرعك بالعملة الرقمية إلى ' . $request->status 
                    : 'Your digital currency donation status has been updated to ' . $request->status,
                'type' => 'donation'
            ]);
        }

        return back()->with('success', 
            app()->getLocale() === 'ar' 
                ? 'تم تحديث حالة التبرع بنجاح' 
                : 'Donation status updated successfully'
        );
    }

    /**
     * حذف تبرع
     */
    public function destroy(DigitalCurrencyDonation $digitalDonation)
    {
        // حذف الملف المرفق إذا وجد
        if ($digitalDonation->proof_document) {
            \Storage::delete('public/donations/digital/' . $digitalDonation->proof_document);
        }

        $digitalDonation->delete();

        return back()->with('success', 
            app()->getLocale() === 'ar' 
                ? 'تم حذف التبرع بنجاح' 
                : 'Donation deleted successfully'
        );
    }

    /**
     * تحميل مستند الإثبات
     */
    public function downloadProof(DigitalCurrencyDonation $digitalDonation)
    {
        if (!$digitalDonation->proof_document) {
            return back()->with('error', 
                app()->getLocale() === 'ar' 
                    ? 'لا يوجد مستند إثبات مرفق' 
                    : 'No proof document attached'
            );
        }

        $path = storage_path('app/public/donations/digital/' . $digitalDonation->proof_document);
        
        if (!file_exists($path)) {
            return back()->with('error', 
                app()->getLocale() === 'ar' 
                    ? 'الملف غير موجود' 
                    : 'File not found'
            );
        }

        return response()->download($path);
    }
} 