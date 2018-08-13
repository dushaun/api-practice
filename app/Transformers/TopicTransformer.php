<?php

namespace App\Transformers;

use App\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'posts'];

    /**
     * A Fractal transformer.
     *
     * @param Topic $topic
     * @return array
     */
    public function transform(Topic $topic)
    {
        return [
            'slug' => $topic->slug,
            'title' => $topic->title,
            'created_at' => $topic->created_at->toDateTimeString(),
            'created_at_human' => $topic->created_at->diffForHumans(),
        ];
    }

    /**
     * Return optional User item.
     *
     * @param Topic $topic
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Topic $topic)
    {
        return $this->item($topic->user, new UserTransformer());
    }

    /**
     * Return optional Posts collection.
     *
     * @param Topic $topic
     * @return \League\Fractal\Resource\Collection
     */
    public function includePosts(Topic $topic)
    {
        return $this->collection($topic->posts, new PostTransformer());
    }
}
