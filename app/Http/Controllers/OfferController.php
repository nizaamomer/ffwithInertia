<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Food;
use App\Models\Offer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('Offers/Index', ['offers' =>
        OfferResource::collection(
            Offer::OfSearch($request->search)->orderBy('order')
                ->orderBy('status', 'asc')
                ->latest()
                ->get()
        )]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Offers/reusableForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $offer = auth()->user()->offers()->create([
                'name' => $data["paymentInfo"]['name'],
                'date' => now(),
                'price' => $data["paymentInfo"]["price"],
                'order' => 0,
                'totalAmount' => $data["paymentInfo"]["totalAmount"],
                'description' => $data["paymentInfo"]["description"],
                'status' => $data["paymentInfo"]["status"],
            ]);
            foreach ($data["cartItems"] as $cartItem) {
                try {
                    $food = Food::findOrFail($cartItem['id']);
                    $offer->offerItems()->create([
                        'offer_id' => $offer->id,
                        'food_id' => $food->id,
                        'quantity' => $cartItem['quantity'],
                        'subTotal' => $food->price * $cartItem['quantity'],

                    ]);
                } catch (ModelNotFoundException $e) {
                    return response()->json(['error' => 'Food with id ' . $cartItem['id'] . ' not found'], 200);
                }
            }
            DB::commit();
            return response()->json(['message' => 'ئۆفەر زیادکرا بە سەرکەوتووی!'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'هەڵەیەک ڕوویدا. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return OfferResource::make($offer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $offer->makeHidden('createdAtReadable');
        $form = [
            'id' => $offer->id,
            'name' => $offer->name,
            'description' => $offer->description,
            'price' => $offer->price,
            'status' => $offer->status,
        ];
        $items = $offer->offerItems->map(function ($item) {
            return [
                'id' => $item->food_id,
                'name' => $item->food->name,
                'price' => $item->food->price,
                'quantity' => $item->quantity,
            ];
        });
        return response()->json(['form' => $form, 'items' => $items], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, Offer $offer)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $offer->update([
                'name' => $data["paymentInfo"]['name'],
                'date' => now(),
                'price' => $data["paymentInfo"]["price"],
                'order' => 0,
                'totalAmount' => $data["paymentInfo"]["totalAmount"],
                'description' => $data["paymentInfo"]["description"],
                'status' => $data["paymentInfo"]["status"],
            ]);

            $cartItemIds = collect($data["cartItems"])->pluck('id')->toArray();
            $offer->offerItems()->whereNotIn('food_id', $cartItemIds)->delete();

            foreach ($data["cartItems"] as $cartItem) {
                $food = Food::findOrFail($cartItem['id']);
                $offerItem = $offer->offerItems()->where('food_id', $food->id)->first();

                if ($offerItem) {
                    $offerItem->update([
                        'quantity' => $cartItem['quantity'],
                        'subTotal' => $food->price * $cartItem['quantity'],
                    ]);
                } else {
                    $offer->offerItems()->create([
                        'food_id' => $food->id,
                        'quantity' => $cartItem['quantity'],
                        'subTotal' => $food->price * $cartItem['quantity'],
                    ]);
                }
            }
            DB::commit();
            return response()->json(['message' => 'ئۆفەر تازەکرایەوە بە سەرکەوتووی!'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'هەڵەیەک ڕوویدا ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return response()->json(['message' => 'ئۆفەر سڕایەوە بە سەرکەوتووی!'], 200);
    }
    public function updateOfferOrder(Request $request)
    {
        $newOrder = $request->input('order');
        $request->validate([
            'order' => 'required|array',
        ]);
        try {
            DB::beginTransaction();
            foreach ($newOrder as $index => $offerId) {
                Offer::where('id', $offerId)->update(['order' => $index + 1]);
            }
            DB::commit();
            return response()->json(['message' => 'ڕیزبەندی ئۆفەرەکان نوێکرایەوە'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'ڕیزبەندی پۆلەکان نوێکرایەوە'], 200);
        }
    }
}
