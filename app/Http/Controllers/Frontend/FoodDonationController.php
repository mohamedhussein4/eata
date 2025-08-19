<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FoodDonation;
use App\Traits\RewardPointsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodDonationController extends Controller
{
    use RewardPointsTrait;
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
        $rules = [
            'donation_type' => 'required|string|max:255',
            'supply_category' => 'required|string|max:255',
            'supply_type' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'unit' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'is_available' => 'required|boolean',
            'amount' => 'nullable|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'notes' => 'nullable|string',
        ];

        // إذا كان الطعام متوفر، نجعل حقل الكمية مطلوباً
        if ($request->input('is_available')) {
            $rules['amount'] = 'required|numeric|min:0';
        } else {
            $rules['amount'] = 'nullable|numeric|min:0';
        }

        $validated = $request->validate($rules);

        $donationData = [
            'user_id' => Auth::id(),
            'donation_type' => $validated['donation_type'],
            'supply_category' => $validated['supply_category'],
            'supply_type' => $validated['supply_type'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'description' => $validated['description'] ?? null,
            'is_available' => $validated['is_available'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ];

        // إضافة الكمية فقط إذا كانت موجودة في البيانات المصادق عليها
        if (isset($validated['amount'])) {
            $donationData['amount'] = $validated['amount'];
        }

        $donation = FoodDonation::create($donationData);

        // إضافة نقاط المكافأة
        if ($validated['is_available']) {
            $this->addRewardPoints(
                $validated['amount'],
                'food_donation',
                $donation
            );
        }

        return redirect()->route('food-donations.index')
            ->with('success', 'تم إرسال تبرع الطعام بنجاح وسيتم مراجعته قريباً');
    }
}
