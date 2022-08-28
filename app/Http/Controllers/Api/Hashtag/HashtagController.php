<?php

namespace App\Http\Controllers\Api\Hashtag;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use App\Models\Entity;
use App\Models\Tweet;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return TweetCollection
     */
    public function show(string $name)
    {
        // get all rows from entities table
        $tweetIds = Entity::where('type', 'hashtag')->where('body_plain', $name)->pluck('tweet_id');
        $tweets = Tweet::whereIn('id', $tweetIds)->simplePaginate(10);
        return new TweetCollection($tweets);
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
