<?php


namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->user_role === 'admin' || $user->user_role === 'user';
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->comment_user_id || $user->user_role === 'admin';
    }
}
