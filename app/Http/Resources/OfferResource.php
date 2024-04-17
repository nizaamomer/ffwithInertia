<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'status' => $this->status,
            'price' => $this->price,
            'totalAmount' => $this->totalAmount,
            'itemsLength' => $this->offerItems->count(),
            'addedBy' => $this->user?->name,
            'description' => $this->description,
            'date' => $this->createdAtReadable,
            'items' => $this->when($request->routeIs('offers.show'), function () {
                return $this->offerItems->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'quantity' => $item->quantity,
                        'subTotal' => $item->subTotal,
                        'food' => [
                            'id' => $item->food->id,
                            'name' => $item->food->name,
                            'image' => $item->food->fullPathFoodImage,
                            'price' => $item->food->price,
                        ],
                    ];
                });
            }),
        ];    }
}
