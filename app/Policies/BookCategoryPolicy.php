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
        return true; // All users can view categories
    }

    public function view(User $user, BookCategory $category)
    {
        return true; // All users can view specific categories
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'user';
    }

    public function update(User $user, BookCategory $category)
    {
        return $user->role === 'admin' || $user->role === 'superadmin';
    }

    public function delete(User $user, BookCategory $category)
    {
        return $user->role === 'admin' || $user->role === 'superadmin';
    }
}
