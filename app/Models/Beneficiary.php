<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age',
        'phone',
        'address',
        'document_path',
        'has_diseases',
        'is_supporting_others',
        'marital_status',
        'family_members_count',
        'children_under_10_count',
        'critical_surgery_diseases',
        'average_monthly_income',
        'id_document',
        'family_book', 
    ];
}
