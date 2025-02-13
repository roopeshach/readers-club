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
        // must login
        return $user->isAuthenticated();
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Book $book)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Book $book)
    {
        return $user->isAdmin();
    }
}
