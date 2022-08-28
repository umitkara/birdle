<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Tweets\TweetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get followings of a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id');
    }

    /**
     * Get followers of a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id');
    }

    /**
     * Get tweets of following users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tweetsFromFollowing()
    {
        return $this->hasManyThrough(
            Tweet::class, Follower::class, 'user_id', 'user_id', 'id', 'following_id'
        );
    }

    /**
     * Returns the avatar image of the user.
     *
     * @return string
     */
    public function avatar()
    {
        return "https://i.pravatar.cc/150?u=" . $this->email;
    }

    /**
     * Get tweets of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * Get likes of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Returns the like relationship between the user and the tweet.
     *
     * @param Tweet $tweet
     * @return bool
     */
    public function hasLiked(Tweet $tweet)
    {
        return (bool) $this->likes->contains('tweet_id', $tweet->id);
    }

    /**
     * Get retweets of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function retweets()
    {
        return $this->hasMany(Tweet::class)
            ->where(function ($query) {
                $query->where('type', TweetType::RETWEET)
                    ->orWhere('type', TweetType::QUOTE);
            });
    }

    /**
     * Returns the following relationship between the current user and the given user.
     *
     * @param $userid
     * @return bool
     */
    public function isFollowing($userid)
    {
        $user = User::find($userid);
        return (bool) $this->following->contains('id', $user->id);
    }

    /**
     * Follow a user.
     *
     * @param User $user
     * @return void
     */
    public function follow(User $user)
    {
        $this->following()->attach($user);
    }

    /**
     * Unfollow a user.
     *
     * @param User $user
     * @return void
     */
    public function unfollow(User $user)
    {
        $this->following()->detach($user);
    }

    /**
     * Get chats of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
