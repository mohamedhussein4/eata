<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FoodDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodDonationController extends Controller
{
    /**
     * عرض قائمة تبرعات الطعام
     */
    public function index()
    {
        $donations = FoodDonation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.food-donations.index', compact('donations'));
    }

    /**
     * عرض نموذج تبرع طعام جديد
     */
    public function create()
    {
        return view('frontend.food-donations.create');
    }

    /**
     * حفظ تبرع طعام جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_type' => 'required|string|max:255',
            'is_available' => 'required|boolean',
            'amount' => 'nullable|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'notes' => 'nullable|string',
        ]);

        $donation = FoodDonation::create([
            'user_id' => Auth::id(),
            'donation_type' => $validated['donation_type'],
            'is_available' => $validated['is_available'],
            'amount' => $validated['is_available'] ? $validated['amount'] : null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        return redirect()->route('food-donations.index')
            ->with('success', 'تم إرسال تبرع الطعام بنجاح وسيتم مراجعته قريباً');
    }
} 