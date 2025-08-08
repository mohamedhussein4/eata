<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeneficiaryStoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_story_id',
        'locale',
        'title',
        'content'
    ];

    public function story()
    {
        return $this->belongsTo(BeneficiaryStory::class, 'beneficiary_story_id');
    }
}
