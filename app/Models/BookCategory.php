<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}
