<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All users can view books
    }

    public function view(User $user, Book $book)
    {
        return true; // All users can view a specific book
    }

    public function create(User $user)
    {
        return $user !== null; // Any authenticated user can create a book
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->user_id || $user->role === 'admin' || $user->role === 'superadmin'; // Owner, admin, or superadmin can update
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id || $user->role === 'admin' || $user->role === 'superadmin'; // Owner, admin, or superadmin can delete
    }
}
