<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['createdAtReadable','fullPathCategoryImage'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    
    public function scopeOfSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }
    public function scopeOfSearchFood($query, $search)
    {
        if ($search) {
            return $query->whereHas('foods', function ($foodQuery) use ($search) {
                $foodQuery->where('name', 'like', '%' . $search . '%');
            });
        }
    
        return $query;
    }
    public function getCreatedAtReadableAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }
    public function getFullPathCategoryImageAttribute()
    {
        return $this->image ? env('APP_URL') . "categoryImages/" . $this->image : null;
    }

}
