<?php

namespace App;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeable;

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = ['body'];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
