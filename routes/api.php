<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Timeline Routes
Route::get('/timeline', ['App\Http\Controllers\Api\Timeline\TimelineController', 'index'])->name('timeline');
//
// Tweet Media Routes
Route::get('/media/types', 'App\Http\Controllers\Api\Media\MediaTypeController@index')->name('media.types');
Route::post('/media', 'App\Http\Controllers\Api\Media\MediaController@store')->name('media.store');
//
// New Tweet Route
Route::post("/tweet", ['App\Http\Controllers\Api\Tweets\TweetController', 'store'])->name('tweet.store');
//
// Get Tweets Route
Route::get("/tweet", ['App\Http\Controllers\Api\Tweets\TweetController', 'index'])->name('tweet');
//
// Tweet Routes
Route::get("/tweet/{tweet}", ['App\Http\Controllers\Api\Tweets\TweetController', 'show'])->name('tweet.show');
Route::delete("/tweet/{tweet}", ['App\Http\Controllers\Api\Tweets\TweetController', 'destroy'])->name('tweet.destroy');
//
// Tweet Like Routes
Route::post("/tweet/{tweet}/like", ['App\Http\Controllers\Api\Tweets\TweetLikeController', 'store'])->name('tweet.like');
Route::delete("/tweet/{tweet}/like", ['App\Http\Controllers\Api\Tweets\TweetLikeController', 'destroy'])->name('tweet.unlike');
//
// Tweet Retweet Routes
Route::post("/tweet/{tweet}/retweet", ['App\Http\Controllers\Api\Tweets\TweetRetweetController', 'store'])->name('tweet.retweet');
Route::delete("/tweet/{tweet}/retweet", ['App\Http\Controllers\Api\Tweets\TweetRetweetController', 'destroy'])->name('tweet.unretweet');
//
// Tweet Quote Routes
Route::post("/tweet/{tweet}/quote", ['App\Http\Controllers\Api\Tweets\TweetQuoteController', 'store'])->name('tweet.quote');
//
// Tweet Reply Routes
Route::post("/tweet/{tweet}/reply", ['App\Http\Controllers\Api\Tweets\TweetReplyController', 'store'])->name('tweet.reply');
Route::get("/tweet/{tweet}/reply", ['App\Http\Controllers\Api\Tweets\TweetReplyController', 'show'])->name('tweet.reply.show');
//
// Notifications Routes
Route::get("/notifications", ['App\Http\Controllers\Api\Notifications\NotificationController', 'index'])->name('notifications');
//
// User Routes
Route::get("/user/{user}", ['App\Http\Controllers\Api\User\UserController', 'show'])->name('user.show');
Route::get('user/{user}/tweets', ['App\Http\Controllers\Api\User\UserTweetsController', 'index'])->name('user.tweets');
Route::post('user/{user}/follow', ['App\Http\Controllers\Api\User\UserFollowController', 'store'])->name('user.follow');
Route::delete('user/{user}/unfollow', ['App\Http\Controllers\Api\User\UserFollowController', 'destroy'])->name('user.unfollow');
Route::get('user/{user}/replies', ['App\Http\Controllers\Api\User\UserRepliesController', 'index'])->name('user.replies');
Route::get('user/{user}/media', ['App\Http\Controllers\Api\User\UserMediaController', 'index'])->name('user.media');
Route::get('user/{user}/connections', ['App\Http\Controllers\Api\User\UserConnectionsController', 'index'])->name('user.connections');
//
// Hashtag Routes
Route::get('hashtag/{hashtag}', ['App\Http\Controllers\Api\Hashtag\HashtagController', 'show'])->name('hashtag.show');
//
// Chat Routes
Route::get('chats', ['App\Http\Controllers\Api\Messages\ChatController', 'index'])->name('chats');
Route::get('chat/{chat}', ['App\Http\Controllers\Api\Messages\ChatController', 'show'])->name('chat.show');
// Message Routes
Route::post('chat/{chat}/message', ['App\Http\Controllers\Api\Messages\MessageController', 'store'])->name('message.store');
