<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'username',
        'phone_number',
        'email',
        'password',
        'role',
        'account_name',
        'account_number',
        'bank',
        'ref_id',
        'image'
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

    public function user_socials()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function hasSocials(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => UserSocial::where('user_id', $att['id'])->where('status', 'approved')->exists());
    }

    public function referralBal(): Attribute
    {
        return Attribute::make(get: function ($val, $att) {
            $ref_earns = Earning::where('user_id', $att['id'])->where('type', 'referral_commission')->sum('amount');
            $ref_withs = ReferralWithdrawal::where('user_id', $att['id'])->where('status', 'approved')->sum('amount');

            return $ref_earns - $ref_withs;
        });
    }

    public function activityBal(): Attribute
    {
        return Attribute::make(get: function ($val, $att) {
            $act_earns = Earning::where('user_id', $att['id'])->where('type', '!=', 'referral_commission')->sum('amount');
            $act_withs = Withdrawal::where('user_id', $att['id'])->where('status', 'approved')->sum('amount');

            return $act_earns - $act_withs;
        });
    }

    public function user_courses()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }
}
