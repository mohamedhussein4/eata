<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * عرض آراء العملاء
     */
    public function index()
    {
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.testimonials.index', compact('testimonials'));
    }

    /**
     * عرض نموذج إضافة رأي جديد
     */
    public function create()
    {
        return view('frontend.testimonials.create');
    }

    /**
     * حفظ رأي جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048',
        ]);

        // معالجة الصورة إذا تم رفعها
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // إنشاء الرأي (غير معتمد افتراضياً)
        $validated['is_approved'] = false;
        $validated['is_featured'] = false;
        $validated['user_id'] = auth()->id();

        Testimonial::create($validated);

        return redirect()->route('testimonials.index')
            ->with('success', 'تم إرسال رأيك بنجاح وسيتم مراجعته قريباً');
    }
} 