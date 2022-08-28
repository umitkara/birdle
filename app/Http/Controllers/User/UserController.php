<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();
        // if user not found, redirect to 404 page
        if (!$user) {
            abort(404);
        }
        return view('user.profile', ['profile_user' => $user]);
    }
}
