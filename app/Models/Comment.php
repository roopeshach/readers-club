<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_reference', 
        'commenter_id', 
        'comment_text',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_reference');
    }

    public function commenter()
    {
        return $this->belongsTo(User::class, 'commenter_id');
    }
}
