<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name', 
        'book_code', 
        'published_by', 
        'release_version', 
        'genre_id', 
        'owner_id', 
        'image_path', 
        'view_count',
    ];

    public function genre()
    {
        return $this->belongsTo(Category::class, 'genre_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_reference');
    }

    public function incrementViews()
    {
        $this->increment('view_count');
    }
}
