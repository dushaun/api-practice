<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return url for a user gravatar.
     *
     * @return string
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/' . Hash::make($this->email) . '?s=45&d=mm';
    }

    /**
     * Check if user owns selected topic.
     *
     * @param Topic $topic
     * @return bool
     */
    public function ownsTopic(Topic $topic)
    {
        return $this->id === $topic->user->id;
    }

    /**
     * Check if user owns selected post.
     *
     * @param Post $post
     * @return bool
     */
    public function ownsPost(Post $post)
    {
        return $this->id === $post->user->id;
    }
}
