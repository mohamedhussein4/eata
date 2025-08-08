<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'ticket_assignments', 'ticket_id', 'admin_id');
    }
}
