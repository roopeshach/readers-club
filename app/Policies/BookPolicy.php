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
        return true; // All users can view specific books
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'user';
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->owner_id || $user->role === 'admin' || $user->role === 'superadmin';
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->owner_id || $user->role === 'admin' || $user->role === 'superadmin';
    }
}
