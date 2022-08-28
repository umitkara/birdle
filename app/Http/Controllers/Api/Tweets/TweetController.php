<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Http\Resources\TweetCollection;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Models\TweetMedia;
use App\Notifications\Tweets\TweetMentionNotification;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only("store");
    }

    /**
     * Display a listing of the resource.
     *
     * @return TweetCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tweet = Tweet::with(['user', 'likes', 'retweets', 'replies', 'original_tweet.user', 'original_tweet.likes', 'original_tweet.retweets'])->find(explode(',', $request->ids));
        return new TweetCollection($tweet);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Tweets\TweetStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), ['type' => TweetType::TWEET]));

        foreach ($request->media as $id) {
            $tweet->media()->save(TweetMedia::find($id));
        }

        foreach ($tweet->mentions->users() as $user) {
            if ($user->id !== $request->user()->id) {
                $user->notify(new TweetMentionNotification($request->user(), $tweet));
            }
        }

        broadcast(new TweetCreated($tweet));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return TweetCollection
     */
    public function show(Tweet $tweet)
    {
        return new TweetCollection(collect([$tweet])->merge($tweet->parents()));
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
    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
    }
}
