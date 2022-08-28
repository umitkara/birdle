<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use App\Models\User;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class UserRepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only("store");
    }

    /**
     * Display a listing of the resource.
     *
     * @return TweetCollection
     */
    public function index(User $user)
    {
        $replies = $user->tweets()
            ->where("tweets.type", TweetType::REPLY)
            ->latest("tweets.created_at")
            ->with([
                'user',
                'likes',
                'entities',
                'original_tweet' => function ($query) {
                    $query->with('user');
                    $query->with('likes');
                    $query->with('media.baseMedia');
                },
                'media.baseMedia'
            ])
            ->simplePaginate(10);
        return new TweetCollection($replies);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
