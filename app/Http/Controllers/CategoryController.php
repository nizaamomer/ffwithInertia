<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = CategoryResource::collection(
            Category::OfSearch($request->search)
                ->orderBy('order', 'asc')
                ->orderBy('status', 'asc')
                ->get()
        );
        return inertia('Categories/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Categories/reusableForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        // $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request, 'image', 'categoryImages');
        }
        Category::create($data);
        return redirect()->route('categories.index')
            ->with('message', 'پۆل زیادکرا بە سەرکەوتووی!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia('Categories/reusableForm', [
            'category' => CategoryResource::make($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->deleteImage('categoryImages/' . $category->image);
            }
            $data['image'] = $this->uploadImage($request, 'image', 'categoryImages');
        }
        $category->update($data);
        return redirect()->route('categories.index')
            ->with('message', 'پۆل تازەکرایەوە بە سەرکەوتووی!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->deleteImage('categoryImages/' . $category->image);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('message', 'پۆل سڕایەوە بە سەرکەوتووی!');
    }

    public function updateCategoryOrder(Request $request)
    {
        $newOrder = $request->input('order');
        $request->validate([
            'order' => 'required|array',
        ]);
        DB::beginTransaction();
        try {
            foreach ($newOrder as $index => $categoryId) {
                Category::where('id', $categoryId)->update(['order' => $index + 1]);
            }
            DB::commit();
            return redirect()->back()->with('message',  'ڕیزبەندی پۆلەکان نوێکرایەوە');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message',  'هەڵەیەک ڕوویدا');
        }
    }
}
