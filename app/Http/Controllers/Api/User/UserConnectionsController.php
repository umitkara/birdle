<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserConnectionCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class UserConnectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only("store");
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserConnectionCollection
     */
    public function index(User $user)
    {
        // paginate
        $followings = $user->following()->get();
        $followings = $followings->map(function ($following) {
            return new UserResource($following);
        });
        $followers = $user->followers()->get();
        $followers = $followers->map(function ($follower) {
            return new UserResource($follower);
        });
        return new UserConnectionCollection([
            'followers' => $followings,
            'following' => $followers,
        ]);
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
