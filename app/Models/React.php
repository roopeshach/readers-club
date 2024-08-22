<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'react_user_id', 'reaction_type'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'react_user_id');
    }
}
