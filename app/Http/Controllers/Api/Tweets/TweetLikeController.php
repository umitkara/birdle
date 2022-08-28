<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetLikesUpdated;
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Tweet;
use App\Notifications\Tweets\TweetLikeNotification;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param Request $request
     * @param Tweet $tweet
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function store(Request $request, Tweet $tweet)
    {
        if($request->user()->hasLiked($tweet)) {
            //409
            return response()->json(['message' => 'You already liked this tweet'], 409);
        }
        $request->user()->likes()->create([
            'tweet_id' => $tweet->id,
        ]);
        if ($tweet->user->id !== $request->user()->id) {
            $tweet->user->notify(new TweetLikeNotification($request->user(), $tweet));
        }
        broadcast(new TweetLikesUpdated($request->user(), $tweet));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function destroy(Request $request, Tweet $tweet)
    {
        if(!$request->user()->hasLiked($tweet)) {
            return response()->json(['message' => 'You have not liked this tweet'], 409);
        }
        $request->user()->likes()->where('tweet_id', $tweet->id)->first()->delete();
        broadcast(new TweetLikesUpdated($request->user(), $tweet));
        // delete notification if exists
    }
}
