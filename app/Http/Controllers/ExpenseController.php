<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia(
            'Expenses/Index',
            ['expenses' => ExpenseResource::collection(
                Expense::OfSearch($request->search)
                    ->latest()->paginate(10)
            )]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Expenses/reusableForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $data["user_id"] = auth()->user()->id;
        Expense::create($data);
        return redirect()->route('expenses.index')
            ->with('message', 'خەرجی زیادکرا بە سەرکەوتووی!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return ExpenseResource::make($expense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return inertia('Expenses/reusableForm', [
            'expense' => ExpenseResource::make($expense)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        return redirect()->route('expenses.index')
            ->with('message', 'خەرجی تازەکرایەوە بە سەرکەوتووی!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')
            ->with('message', 'خەرجی سڕایەوە بە سەرکەوتووی!');
    }
}
