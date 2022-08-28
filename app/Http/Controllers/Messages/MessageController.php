<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index');
    }

    public function show(Chat $chat)
    {
        $chat = new ChatResource($chat);
        return view('messages.show')->with('chat', json_encode($chat));
    }
}
