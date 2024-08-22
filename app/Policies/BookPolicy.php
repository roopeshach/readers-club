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
        return true;
    }

    public function create(User $user)
    {
        return $user->user_role === 'admin' || $user->user_role === 'user';
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->owner_id || $user->user_role === 'admin';
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->owner_id || $user->user_role === 'admin';
    }
}
