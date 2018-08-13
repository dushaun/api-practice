<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Post;
use App\Topic;
use App\Transformers\TopicTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class TopicController extends Controller
{
    /**
     * Return index of topics.
     *
     * @return mixed
     */
    public function index()
    {
        $topics = Topic::latestFirst()->paginate(10);
        $topicsCollection = $topics->getCollection();

        return fractal()
            ->collection($topicsCollection)
            ->parseIncludes(['user'])
            ->transformWith(new TopicTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($topics))
            ->toArray();
    }

    /**
     * Show selected topic.
     *
     * @param Topic $topic
     * @return array
     */
    public function show(Topic $topic)
    {
        return fractal()
            ->item($topic)
            ->parseIncludes(['user', 'posts', 'posts.user'])
            ->transformWith(new TopicTransformer())
            ->toArray();
    }

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
        $topic->slug = str_slug($request->title);
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

    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->title = $request->get('title', $topic->title);
        $topic->save();

        return fractal()
            ->item($topic)
            ->parseIncludes(['user'])
            ->transformWith(new TopicTransformer())
            ->toArray();
    }
}
