<?php

namespace App\Policies;

use App\Topic;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Check if user is authorised to update selected topic.
     *
     * @param User $user
     * @param Topic $topic
     * @return bool
     */
    public function update(User $user, Topic $topic)
    {
        return $user->ownsTopic($topic);
    }

    /**
     * Check if user is authorised to delete selected topic.
     *
     * @param User $user
     * @param Topic $topic
     * @return bool
     */
    public function destroy(User $user, Topic $topic)
    {
        return $user->ownsTopic($topic);
    }
}
