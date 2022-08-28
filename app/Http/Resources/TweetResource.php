<?php

namespace App\Http\Resources;

use App\Models\Tweet;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //$tweet = Tweet::withCount(['likes', 'retweets'])->find($this->id);
        $this->resource-> loadCount(['likes', 'retweets', 'replies']);
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'body' => $this->body,
            'type' => $this->type,
            'original_tweet' => new TweetResource($this->original_tweet),
            'like_count' => $this->likes_count,
            'retweet_count' => $this->retweets_count,
            'reply_count' => $this->replies_count,
            'created_at' => $this->created_at->timestamp,
            'human_time' => Carbon::parse($this->created_at)->diffForHumans(),
            'media' => new MediaCollection($this->media),
            'entities' => new EntityCollection($this->entities),
            'parent_id' => $this->parent_id,
            'parent_ids' => $this->parents()->pluck('id')->toArray(),
            'replying_to' => optional(optional($this->parentTweet)->user)->username,
            // 'updated_at' => $this->updated_at->timestamp,
        ];
    }
}
