<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['book_title', 'book_code', 'author_id', 'category_id', 'owner_id', 'cover_image_path', 'views_count'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_id');
    }

    public function reacts()
    {
        return $this->hasMany(React::class, 'book_id');
    }
}
