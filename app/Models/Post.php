<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','name', 'content', 'author_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsCount(): Attribute
    {
        return Attribute::make(get: fn ($val, $att) => $this->comments()->count());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
