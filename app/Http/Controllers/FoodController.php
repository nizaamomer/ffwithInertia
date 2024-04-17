<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Category;
use App\Models\Food;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $foods = FoodResource::collection(
            Food::with('foods')
                ->OfSearch($request->search)
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc')
                ->get()
        );
        return inertia('Foods/Index', ['foods' => $foods]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Foods/reusableForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FoodRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request, 'image', 'foodImages');
        }
        Food::create($data);
        return redirect()->route('foods.index')
            ->with('message', 'خواردن زیادکرا بە سەرکەوتووی!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return FoodResource::make($food);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return inertia('Foods/reusableForm', [
            'food' => FoodResource::make($food)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FoodRequest $request, Food $food)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($food->image) {
                $this->deleteImage('foodImages/' . $food->image);
            }
            $data['image'] = $this->uploadImage($request, 'image', 'foodImages');
        }
        $food->update($data);
        return redirect()->route('foods.index')
            ->with('message', 'خواردن تازەکرایەوە بە سەرکەوتووی!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $this->deleteImage('foodImages/' . $food->image);
        $food->delete();
        return redirect()->route('foods.index')
        ->with('message', 'خواردن سڕایەوە بە سەرکەوتووی!');
    }
    public function getCategories()
    {
        $categories = Category::where('status', 'active')->select('id', 'name')->get();
        $categories->makeHidden(['createdAtReadable', 'fullPathCategoryImage']);
        return response()->json(['categories' => $categories]);
    }
}
