<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Check if user is authorised to update selected post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $user->ownsPost($post);
    }

    /**
     * Check if user is authorised to delete select post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function destroy(User $user, Post $post)
    {
        return $user->ownsPost($post);
    }

    /**
     * Check if user is authorised to like the selected post.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function like(User $user, Post $post)
    {
        return !$user->ownsPost($post);
    }
}
