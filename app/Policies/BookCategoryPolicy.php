<?php

namespace App\Policies;

use App\Models\BookCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, BookCategory $category)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->user_role === 'admin';
    }

    public function update(User $user, BookCategory $category)
    {
        return $user->user_role === 'admin';
    }

    public function delete(User $user, BookCategory $category)
    {
        return $user->user_role === 'admin';
    }
}
