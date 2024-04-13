<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phoneNumber' => $this->phoneNumber,
            'image' => $this->fullPathUserImage,
            'email' => $this->email,
            'status' => $this->status,
            'created_at' => $this->createdAtReadable,
            'addedBy' => $this->user?->name,
            'isAdmin' => $this->isAdmin,
        ];
    }
}
