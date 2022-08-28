<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // if logged in, redirect to timeline
    if (auth()->check()) {
        return redirect()->route('timeline');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/notifications', [App\Http\Controllers\Notifications\NotificationController::class, 'index'])->name('notifications');

Route::get('/tweets/{tweet}', [App\Http\Controllers\Tweets\TweetController::class, 'show'])->name('tweet.show');

Route::get('/user/{user}', [App\Http\Controllers\User\UserController::class, 'show'])->name('user.profile.show');

Route::get('/user/{user}/connections', [App\Http\Controllers\User\UserConnectionsController::class, 'index'])->name('user.connections.index');

Route::get('/explore', [App\Http\Controllers\Hashtags\HashtagController::class, 'index'])->name('hashtags.index');

Route::get('/hashtags/{hashtag}', [App\Http\Controllers\Hashtags\HashtagController::class, 'show'])->name('hashtags.show');

Route::get('/messages', [App\Http\Controllers\Messages\MessageController::class, 'index'])->name('messages.index');

Route::get('/messages/{chat}', [App\Http\Controllers\Messages\MessageController::class, 'show'])->name('messages.show');
