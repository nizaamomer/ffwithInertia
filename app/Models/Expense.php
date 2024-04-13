<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search !== null) {
            return   $query->where(
                function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%")
                        ->orWhere('amount', 'like', "%$search%")
                        ->orWhere('date', 'like', "%$search%");
                }
            );
        }
        return $query;
    }
    public function scopeOfDateRange($query, $dateRange, $customStartDate = null, $customEndDate = null)
    {
        $currentDate = now();
        if ($dateRange === 'today') {
            return $query->whereDate('date', $currentDate->toDateString());
        } elseif ($dateRange === 'this_week') {
            return $query->whereBetween('date', [
                $currentDate->startOfWeek(),
                $currentDate->endOfWeek()
            ]);
        } elseif ($dateRange === 'last_week') {
            return $query->whereBetween('date', [
                $currentDate->copy()->subWeek()->startOfWeek(),
                $currentDate->copy()->subWeek()->endOfWeek()
            ]);
        } elseif ($dateRange === 'this_month') {
            return $query->whereBetween('date', [
                $currentDate->startOfMonth(),
                $currentDate->endOfMonth()
            ]);
        } elseif ($dateRange === 'last_month') {
            return $query->whereBetween('date', [
                $currentDate->copy()->subMonth()->startOfMonth(),
                $currentDate->copy()->subMonth()->endOfMonth()
            ]);
        } elseif ($customStartDate && $customEndDate) {
            return $query->whereBetween('date', [$customStartDate, $customEndDate]);
        } elseif (!$customStartDate && $customEndDate) {
            return $query->whereDate('date', '<=', $customEndDate);
        } elseif ($customStartDate && !$customEndDate) {
            return $query->whereDate('date', '>=', $customStartDate);
        }
        return $query;
    }

}
