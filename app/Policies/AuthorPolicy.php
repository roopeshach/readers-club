<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All users can view authors
    }

    public function view(User $user, Author $author)
    {
        return true; // All users can view a specific author
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin'; // Only admin or superadmin can create an author
    }

    public function update(User $user, Author $author)
    {
        return $user->role === 'admin' || $user->role === 'superadmin'; // Only admin or superadmin can update an author
    }

    public function delete(User $user, Author $author)
    {
        return $user->role === 'admin' || $user->role === 'superadmin'; // Only admin or superadmin can delete an author
    }
}
