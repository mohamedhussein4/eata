<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'locale',
        'title',
        'description',
        'content'
    ];

    protected $casts = [
        'project_id' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
