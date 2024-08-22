<?php


namespace App\Policies;

use App\Models\React;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReactPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->user_role === 'admin' || $user->user_role === 'user';
    }

    public function delete(User $user, React $react)
    {
        return $user->id === $react->react_user_id || $user->user_role === 'admin';
    }
}
