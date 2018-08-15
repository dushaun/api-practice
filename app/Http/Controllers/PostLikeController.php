<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Store newly created topic.
     *
     * @param Request $request
     * @param Topic $topic
     * @param Post $post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Topic $topic, Post $post)
    {
        $this->authorize('like', $post);

        if ($request->user()->hasLikedPost($post))
            return response(null, 409);

        $like = new Like();
        $like->user()->associate($request->user());

        $post->likes()->save($like);

        return response(null, 204);
    }
}
