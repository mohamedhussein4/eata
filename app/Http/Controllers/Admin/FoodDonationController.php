<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodDonation;
use Illuminate\Http\Request;

class FoodDonationController extends Controller
{
    /**
     * عرض قائمة تبرعات الطعام
     */
    public function index()
    {
        $foodDonations = FoodDonation::with(['user'])
            ->latest()
            ->get();

        // إحصائيات التبرعات
        $statistics = [
            'total' => $foodDonations->count(),
            'pending' => $foodDonations->where('status', 'pending')->count(),
            'completed' => $foodDonations->where('status', 'completed')->count(),
            'cancelled' => $foodDonations->where('status', 'cancelled')->count(),
        ];

        return view('admin.food-donations.index', compact('foodDonations', 'statistics'));
    }

    /**
     * تحديث حالة التبرع
     */
    public function updateStatus(Request $request, FoodDonation $foodDonation)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $foodDonation->update([
            'status' => $request->status
        ]);

        return back()->with('success', 
            app()->getLocale() === 'ar' 
                ? 'تم تحديث حالة التبرع بنجاح' 
                : 'Donation status updated successfully'
        );
    }

    /**
     * حذف تبرع
     */
    public function destroy(FoodDonation $foodDonation)
    {
        $foodDonation->delete();

        return back()->with('success', 
            app()->getLocale() === 'ar' 
                ? 'تم حذف التبرع بنجاح' 
                : 'Donation deleted successfully'
        );
    }
} 