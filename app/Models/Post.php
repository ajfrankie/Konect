<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset(str_replace('public/', 'storage/', $this->image)) : null;
    }


    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
