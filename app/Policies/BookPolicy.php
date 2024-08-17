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
        return true;
    }

    public function view(User $user, Book $book)
    {
        return true; // All users can view books
    }

    public function create(User $user)
    {
        return $user->role === 'user' || $user->isAdmin();
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->owner_id || $user->isAdmin();
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->owner_id || $user->isAdmin();
    }
}
