<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return TweetCollection
     */
    public function index(Request $request)
    {
        // Need a cache implementation
        $tweets = $request->user()
            ->tweetsFromFollowing()
            ->parent()
            ->latest("tweets.created_at")
            ->with([
                'user',
                'likes',
                'replies',
                'entities',
                'original_tweet' => function ($query) {
                    $query->with('user');
                    $query->with('likes');
                    $query->with('media.baseMedia');
                },
                'media.baseMedia'
            ])
            ->simplePaginate(10);
        return new TweetCollection($tweets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
