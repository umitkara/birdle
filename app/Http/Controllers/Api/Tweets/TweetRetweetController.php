<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetCreated;
use App\Events\Tweets\TweetRetweetDeleted;
use App\Events\Tweets\TweetRetweetUpdated;
use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Notifications\Tweets\TweetRetweetNotification;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        $retweet = $request->user()->tweets()->create([
            'type' => TweetType::RETWEET,
            'original_tweet_id' => $tweet->id,
        ]);
        if ($tweet->user->id !== $request->user()->id) {
            $tweet->user->notify(new TweetRetweetNotification($request->user(), $retweet));
        }

        broadcast(new TweetCreated($retweet));
        broadcast(new TweetRetweetUpdated($request->user(), $tweet));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tweet $tweet)
    {
        broadcast(new TweetRetweetDeleted($tweet->retweetedTweet()->where('user_id', $request->user()->id)->get()->first()));
        $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();
        broadcast(new TweetRetweetUpdated($request->user(), $tweet));
    }
}
