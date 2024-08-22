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
        return true;
    }

    public function view(User $user, Author $author)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->user_role === 'admin';
    }

    public function update(User $user, Author $author)
    {
        return $user->user_role === 'admin';
    }

    public function delete(User $user, Author $author)
    {
        return $user->user_role === 'admin';
    }
}
