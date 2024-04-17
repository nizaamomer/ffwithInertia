<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Invoice;
use App\Models\Offer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{

    public function index(Request $request)
    {

        $categories = Category::select('id', 'name')
            ->with(['foods' => function ($query) use ($request) {
                if ($request->search) {
                    $query->OfSearch($request->search);
                }
            }])
            ->orderBy('order')
            ->get();
        $categories->makeHidden(["foods.status", "foods.created_at", "foods.updated_at", "foods.createdAtReadable"]);

        $offers = Offer::where('status', 'active')->select('id', 'name', 'price', 'totalAmount')->with(['offerItems:id,offer_id,food_id,quantity', 'offerItems.food:id,name,price,image'])->get();
        $offers->makeHidden(["createdAtReadable", "offer_items.createdAtReadable", "offer_items.food.createdAtReadable"]);
        info($offers);
        return response()->json([
            'offers' => $offers,
            'categories' => $categories,
        ], 200);
    }


    public function pay(Request $request)
    {
        $data = $request->validate([
            'cartItems' => 'required|array',
            'paymentInfo' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            $invoice = auth()->user()->invoices()->create([
                'name' => auth()->user()->name,
                'date' => now(),
                'totalAmount' => $data["paymentInfo"]["totalAmount"],
                'status' => $data["paymentInfo"]["status"],
                'discount' =>  $data["paymentInfo"]["discount"] ?? 0,
            ]);
            foreach ($data["cartItems"] as $cartItem) {
                try {
                    if ($cartItem['type'] === 'food') {
                        $food = Food::findOrFail($cartItem['id']);
                        $invoice->invoiceItems()->create([
                            'name' => $food->name,
                            'price' => $food->price,
                            'quantity' => $cartItem['quantity'],
                            'subTotal' => $food->price * $cartItem['quantity'],
                        ]);
                    } elseif ($cartItem['type'] === 'offer') {
                        $offer = Offer::findOrFail($cartItem['id']);
                        $invoice->invoiceItems()->create([
                            'name' => $offer->name,
                            'price' => $offer->price,
                            'quantity' => $cartItem['quantity'],
                            'subTotal' => $offer->price * $cartItem['quantity'],
                        ]);
                    }
                } catch (ModelNotFoundException $e) {
                    Log::error('Food with id ' . $cartItem['id'] . ' not found');
                }
            }
            DB::commit();
            return response()->json(['message' => 'Payment processed successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Payment processing failed. Please try again. ' . $e->getMessage()], 500);
        }
    }

    public function payy(Request $request)
    {

        $data = $request->validate([
            'cartItems' => 'required|array',
            'paymentInfo' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            $invoice = Invoice::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->name,
                'date' => now(),
                'totalAmount' => $data["totalAmount"],
                'status' => $data["status"],
                'discount' => $data["discount"] ?? 0,
            ]);
            foreach ($data["cartItems"] as $cartItem) {
                if ($cartItem->item_type == 'food') {
                    $food = Food::find($cartItem->item_id);
                    $invoice->invoice_items::create([
                        'user_id' => auth()->user()->id,
                        'name' => $food->name,
                        'price' => $food->price,
                        'quantity' => $cartItem->quantity,
                        'subTotal' => $food->price * $cartItem->quantity,
                    ]);
                } elseif ($cartItem->item_type == 'offer') {
                    $offer = Offer::find($cartItem->item_id);
                    $invoice->invoice_items::create([
                        'user_id' => auth()->user()->id,
                        'name' => $offer->name,
                        'price' => $offer->price,
                        'quantity' => $cartItem->quantity,
                        'subTotal' => $offer->price * $cartItem->quantity,
                    ]);
                }
            }

            DB::commit();
            if ($request->print == true) {
                return response()->json(['message' => 'Payment processed successfully', 'invoice' => $invoice->load('invoiceItems')]);
            } else {
                return response()->json(['message' => 'Payment processed successfully']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Payment processing failed. Please try again.'], 500);
        }
    }
}
