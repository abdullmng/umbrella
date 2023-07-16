<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'short_description',
        'description',
        'amount',
        'earning_rate',
        'image'
    ];

    protected $appends = [
        'user_count',
        'total_sales'
    ];

    public function userCount(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => UserCourse::where('course_id', $att['id'])->count());
    }

    public function totalSales(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => $this->amount * $this->getAttribute('user_count'));
    }
}
