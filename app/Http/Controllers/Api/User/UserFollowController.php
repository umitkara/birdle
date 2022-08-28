<?php

namespace App\Http\Controllers\Api\User;

use App\Events\User\UserFollowerUpdated;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only("store");
    }

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
    public function store(User $user)
    {
         auth()->user()->follow($user);
         broadcast(new UserFollowerUpdated($user));
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
        auth()->user()->unfollow($user);
        broadcast(new UserFollowerUpdated($user));
    }
}
