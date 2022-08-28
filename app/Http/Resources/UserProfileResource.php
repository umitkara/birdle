<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'username' => $this->username,
            'name' => $this->name,
            'avatar' => $this->avatar(),
            'email' => $this->email,
            'created_at' => $this->created_at,
            'followers' => $this->followers()->count(),
            'following' => $this->following()->count(),
            'is_following' => auth()->user()->isFollowing($this->id) ?? false,
        ];
    }
}
