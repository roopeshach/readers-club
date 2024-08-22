<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    // Fillable properties for mass assignment
    protected $fillable = ['name', 'location',];

    /**
     * The books that belong to the publisher.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
