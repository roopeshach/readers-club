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
        return true; // All users can view a specific publisher
    }

    public function create(User $user)
    {
        return $user->isAdmin(); // Only admin or superadmin can create a publisher
    }

    public function update(User $user, Publisher $publisher)
    {
        return $user->isAdmin(); // Only admin or superadmin can update a publisher
    }

    public function delete(User $user, Publisher $publisher)
    {
        return $user->isAdmin(); // Only admin or superadmin can delete a publisher
    }
}
