<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TweetCollection extends ResourceCollection
{
    public $collection = TweetResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'likes' => $this->likes($request),
                'retweets' => $this->retweets($request),
            ],
        ];
    }

    protected function likes($request)
    {
        if (!$user = $request->user()) {
            return [];
        }
        $likes = $user->likes()
            ->whereIn('tweet_id', $this->collection->pluck('id'))
            ->pluck('tweet_id')
            ->toArray();
        $originalTweetLikes = $user->likes()
            ->whereIn('tweet_id', $this->collection->pluck('original_tweet_id'))
            ->pluck('tweet_id')
            ->toArray();
        return array_merge($likes, $originalTweetLikes);
    }

    protected function retweets($request)
    {
        if (!$user = $request->user()) {
            return [];
        }
        return $user->retweets()/*->pluck('original_tweet_id')*/
            ->whereIn('original_tweet_id', $this->collection->pluck('id')->merge($this->collection->pluck('original_tweet_id')))
            ->pluck('original_tweet_id')
            ->toArray();
    }
}
