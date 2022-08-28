<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserConnectionsController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();
        return view('user.connections', ['profile_user' => $user]);
    }
}
