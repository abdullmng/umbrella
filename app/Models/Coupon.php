<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'code',
        'amount',
        'status',
        'user_id',
        'date_used'
    ];

    public function usedBy(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => User::find($att['user_id'])?->username);
    }

    public function statusColor(): Attribute
    {
        return Attribute::make(get: function ($val, $att) {
            if ($att['status'] == 'unused')
            {
                return 'success';
            }
            return 'danger';
        });
    }
}
