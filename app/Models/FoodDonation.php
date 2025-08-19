<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donation_type',
        'supply_category',
        'supply_type',
        'quantity',
        'unit',
        'description',
        'is_available',
        'amount',
        'status',
        'name',
        'email',
        'phone',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
