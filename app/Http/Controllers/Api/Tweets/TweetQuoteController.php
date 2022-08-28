<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetCreated;
use App\Events\Tweets\TweetRetweetUpdated;
use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Notifications\Tweets\TweetQuoteNotification;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetQuoteController extends Controller
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
    public function store(Tweet $tweet, Request $request)
    {
        $quote = $request->user()->tweets()->create([
            'body' => $request->body,
            'type' => TweetType::QUOTE,
            'original_tweet_id' => $tweet->id,
            'parent_tweet_id' => $tweet->id,
        ]);

        if ($tweet->user->id !== $request->user()->id) {
            $tweet->user->notify(new TweetQuoteNotification($request->user(), $quote));
        }

        broadcast(new TweetCreated($quote));
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
    public function destroy(Tweet $tweet)
    {
        //
    }
}
