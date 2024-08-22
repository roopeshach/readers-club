<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_title',
        'book_code',
        'publisher_id',
        'category_id',
        'owner_id',
        'views_count',
    ];
    
    public function category() {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }
    
    public function publisher() {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
    
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    public function comments() {
        return $this->hasMany(Comment::class, 'book_id');
    }
    
}
