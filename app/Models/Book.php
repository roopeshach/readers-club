<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'isbn', 'author', 'publisher', 'edition', 'category_id', 'cover_art', 'user_id','views',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

       // Increment the views count
       public function incrementViews()
       {
        $this->views = $this->views + 1;
        $this->save();
       }
}
