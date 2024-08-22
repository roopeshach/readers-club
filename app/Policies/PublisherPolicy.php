<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Publisher;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublisherPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Publisher $publisher)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Publisher $publisher)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Publisher $publisher)
    {
        return $user->isAdmin();
    }
}
