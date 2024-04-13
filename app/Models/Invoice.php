<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['createdAtReadable'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function scopeOfUser($query, $user_id)
    {
        if ($user_id !== null) {
            return $query->where('user_id', $user_id);
        }
        return $query;
    }
    public function scopeOfStatus($query, $status)
    {
        if ($status === 'cash') {
            $query->where('status', 'cash');
        } elseif ($status === 'togo') {
            $query->where('status', 'togo');
        } elseif ($status === 'delivery') {
            $query->where('status', 'delivery');
        } else {
            return $query;
        }
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search !== null) {
            return $query->where('id', 'like', "%$search%")
                ->orWhere('discount', 'like', "%$search%")
                ->orWhere('totalAmount', 'like', "%$search%");
        }
        return $query;
    }
    public function scopeOfDateRange($query, $dateRange = null, $customStartDate = null, $customEndDate = null)
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
            // Case 1: Both customStartDate and customEndDate provided
            return $query->whereBetween('date', [$customStartDate, $customEndDate]);
        } elseif (!$customStartDate && $customEndDate) {
            // Case 2: customStartDate is missing, customEndDate provided
            return $query->where('date', '<=', $customEndDate);
        } elseif ($customStartDate && !$customEndDate) {
            // Case 3: customStartDate provided, customEndDate is missing
            return $query->where('date', '>=', $customStartDate);
        }

        return $query; // Default behavior if no conditions match
    }
    public function getCreatedAtReadableAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

}
