<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Food;
use App\Models\Invoice;
use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $food = Food::where('status', 'active')->count();
        $expense = Expense::whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');
        $salemonth = Invoice::whereBetween('date', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])
            ->sum('totalAmount');
        $saletoday = Invoice::whereDate('date', Carbon::today())->sum('totalAmount');
        $offer = Offer::where('status', 'active')->count();
        $category = Category::where('status', 'active')->count();
        return inertia('Dashboard', ['data' => [
            'offer' => $offer,
            'category' => $category,
            'user' => $user,
            'food' => $food,
            'expense' => $expense,
            'saletoday' => $saletoday,
            'salemonth' => $salemonth,
        ]]);
    }
}
