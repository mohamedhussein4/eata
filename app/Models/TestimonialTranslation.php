<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestimonialTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonial_id',
        'locale',
        'name',
        'content'
    ];

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}
