<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Comment $comment)
    {
        return true; // All users can view comments
    }

    public function create(User $user)
    {
        return $user->role === 'user' || $user->isAdmin();
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->commenter_id || $user->isAdmin();
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->commenter_id || $user->isAdmin();
    }
}
