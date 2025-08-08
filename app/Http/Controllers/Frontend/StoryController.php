<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BeneficiaryStory;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * عرض قائمة قصص المستفيدين
     */
    public function index()
    {
        $stories = BeneficiaryStory::where('is_approved', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.stories.index', compact('stories'));
    }

    /**
     * عرض تفاصيل قصة مستفيد
     */
    public function show(BeneficiaryStory $story)
    {
        // التحقق من أن القصة معتمدة
        if (!$story->is_approved) {
            abort(404);
        }

        // زيادة عدد المشاهدات
        $story->increment('views');

        // جلب قصص مشابهة
        $relatedStories = BeneficiaryStory::where('id', '!=', $story->id)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.stories.show', compact('story', 'relatedStories'));
    }
} 