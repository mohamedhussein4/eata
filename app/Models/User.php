<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'age',
        'gender',
        'type',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * العلاقة مع التبرعات
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * العلاقة مع الإشعارات
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * العلاقة مع الرسائل
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * العلاقة مع التذاكر
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * العلاقة مع الدور
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'type', 'name');
    }

    /**
     * التحقق مما إذا كان المستخدم لديه دور معين
     */
    public function hasRole($roleName)
    {
        return $this->type === $roleName;
    }

    /**
     * التحقق من أن المستخدم مدير
     */
    public function isAdmin()
    {
        return $this->type === 'admin';
    }
}

