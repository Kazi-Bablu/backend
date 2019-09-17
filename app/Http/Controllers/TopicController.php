<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTopicRequest;
use App\Topic;
use App\Post;
//use Illuminate\Http\Request;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Requests\TopicCreateRequest;

class TopicController extends Controller
{
    //

    public function store(TopicCreateRequest $request)
    {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->post()->save($post);

        return new TopicResource($topic);
    }


    public function index()
    {
        $topics = Topic::latestFirst()->paginate(2);

        return TopicResource::collection($topics);
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);

    }

    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $topic->title = $request->get('title',$topic->title);
        $topic->save();

        return new TopicResource($topic);
    }

}
