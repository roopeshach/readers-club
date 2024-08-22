<?php


namespace App\Policies;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublisherPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All users can view publishers
    }

    public function view(User $user, Publisher $publisher)
    {
        return true; // All users can view specific publishers
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'user';
    }

    public function update(User $user, Publisher $publisher)
    {
        return $user->role === 'admin' || $user->role === 'superadmin';
    }

    public function delete(User $user, Publisher $publisher)
    {
        return $user->role === 'admin' || $user->role === 'superadmin';
    }
}
