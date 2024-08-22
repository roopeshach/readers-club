<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All users can view categories
    }

    public function view(User $user, Category $category)
    {
        return true; // All users can view a specific category
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin'; // Only admin or superadmin can create a category
    }

    public function update(User $user, Category $category)
    {
        return $user->role === 'admin' || $user->role === 'superadmin'; // Only admin or superadmin can update a category
    }

    public function delete(User $user, Category $category)
    {
        return $user->role === 'admin' || $user->role === 'superadmin'; // Only admin or superadmin can delete a category
    }
}
