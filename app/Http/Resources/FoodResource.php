<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'category_id' => $this->category_id,
            'name' => $this->name,
            'created_at' => $this->createdAtReadable,
            'image' => $this->fullPathFoodImage,
            'price' => $this->price,
            'status' => $this->status,
            'addedBy' => $this->user?->name,
        ];    }
}
