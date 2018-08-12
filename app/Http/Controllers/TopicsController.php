<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Post;
use App\Topic;
use App\Transformers\TopicTransformer;

class TopicsController extends Controller
{
    /**
     * Store newly created topic.
     *
     * @param StoreTopicRequest $request
     * @return array
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post();
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);

        return fractal()
            ->item($topic)
            ->parseIncludes(['user'])
            ->transformWith(new TopicTransformer())
            ->toArray();
    }
}
