<?php

namespace App\Http\Controllers\Api\Messages;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\MessageCollection;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return ChatCollection
     */
    public function index(Request $request)
    {
        // get chats where user_id or receiver_id is the current user
        $chats = Chat::where('user_id', $request->user()->id)
            ->orWhere('receiver_id', $request->user()->id);
        $chats = $chats->with(['lastMessage'])->simplePaginate(10);
        return new ChatCollection($chats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if a chat with user exists, return it
        // else create new chat with a user
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return MessageCollection
     */
    public function show(Chat $chat)
    {
        $messages = $chat->allMessages()->paginate(10);
        return new MessageCollection($messages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        // Delete a chat
    }
}
