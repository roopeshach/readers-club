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
        return true; // All users can view comments
    }

    public function view(User $user, Comment $comment)
    {
        return true; // All users can view specific comments
    }

    public function create(User $user)
    {
        return $user->role === 'admin' || $user->role === 'superadmin' || $user->role === 'user';
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->comment_user_id || $user->role === 'admin' || $user->role === 'superadmin';
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->comment_user_id || $user->role === 'admin' || $user->role === 'superadmin';
    }
}
