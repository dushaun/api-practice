<?php

namespace App\Traits;

use App\Like;

trait Likeable
{
    /**
     * Get likes of selected model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}