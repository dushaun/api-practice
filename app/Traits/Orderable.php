<?php

namespace App\Traits;


trait Orderable
{
    /**
     * Order model by latest first.
     *
     * @param $query
     * @return mixed
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Order model by oldest first.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOldestFirst($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}