<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Resources\TweetMediaCollection;
use App\Models\TweetMedia;
use Illuminate\Http\Request;

class MediaController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MediaStoreRequest $request
     * @return TweetMediaCollection
     */
    public function store(MediaStoreRequest $request)
    {
        $result = collect($request->media)->map(function ($media) {
            return $this->addMedia($media);//->toMediaCollection('tweet_media');
        });
        return new TweetMediaCollection($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TweetMedia  $tweetMedia
     * @return \Illuminate\Http\Response
     */
    public function show(TweetMedia $tweetMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TweetMedia  $tweetMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TweetMedia $tweetMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TweetMedia  $tweetMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(TweetMedia $tweetMedia)
    {
        //
    }

    protected function addMedia($media)
    {
        $tweetMedia = TweetMedia::create([]);
        $tweetMedia->baseMedia()->associate($tweetMedia->addMedia($media)->toMediaCollection())
            ->save();
        return $tweetMedia;
    }
}
