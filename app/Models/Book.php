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
        'publisher_id', // Link with Publisher
        'release_version', 
        'genre_id', // Link with Category (Genre)
        'owner_id', 
        'image_path', 
        'view_count',
    ];

    public function genre()
    {
        return $this->belongsTo(Category::class, 'genre_id'); // Relationship with Category
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_reference');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id'); // Relationship with Publisher
    }

    public function incrementViews()
    {
        $this->increment('view_count');
    }
}
