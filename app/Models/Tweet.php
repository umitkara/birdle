<?php

namespace App\Models;

use App\Tweets\Entities\EntityExtractor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'type',
        'original_tweet_id',
        'parent_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function (Tweet $tweet) {
            $tweet->entities()->createMany((new EntityExtractor($tweet->body))->getAllEntities());
        });
    }

    public function scopeParent(Builder $query)
    {
        $query->whereNull('parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function original_tweet()
    {
        return $this->hasOne(Tweet::class, 'id', 'original_tweet_id');
    }

    public function likes()
    {
        // eager load tweet_id from likes
        return $this->hasMany(Like::class, 'tweet_id');
    }

    public function retweets()
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id');
    }

    public function retweetedTweet()
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id');
    }

    public function media()
    {
        return $this->hasMany(TweetMedia::class, 'tweet_id');
    }

    public function replies()
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }

    public function entities()
    {
        return $this->hasMany(Entity::class, 'tweet_id');
    }

    public function mentions()
    {
        return $this->hasMany(Entity::class, 'tweet_id')->where('type', 'mention');
    }

    public function parents()
    {
        $base = $this;
        $parents = [];

        while($base->parentTweet)
        {
            $parents[] = $base->parentTweet;
            $base = $base->parentTweet;
        }

        return collect($parents);
    }

    public function parentTweet()
    {
        return $this->belongsTo(Tweet::class, 'parent_id');
    }
}
