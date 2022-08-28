<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sender' => new UserResource(User::find($this->user_id)),
            'recipient' => new UserResource(User::find($this->receiver_id)),
            'lastMessage' => new MessageResource($this->lastMessage),
            'created_at' => $this->created_at->timestamp,
            'human_time' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
