<?php

namespace App\Transformers;

use App\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'likes'];

    /**
     * A Fractal transformer.
     *
     * @param Post $post
     * @return array
     */
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'body' => $post->body,
            'likes_count' => $post->likes()->count(),
            'created_at' => $post->created_at->toDateTimeString(),
            'created_at_human' => $post->created_at->diffForHumans(),
        ];
    }

    /**
     * Return optional User item.
     *
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Post $post)
    {
        return $this->item($post->user, new UserTransformer());
    }

    /**
     * Return optional list of Likes.
     *
     * @param Post $post
     * @return \League\Fractal\Resource\Collection
     */
    public function includeLikes(Post $post)
    {
        return $this->collection($post->likes->pluck('user'), new UserTransformer());
    }
}
