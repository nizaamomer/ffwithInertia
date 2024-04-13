<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['createdAtReadable', 'fullPathFoodImage'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }
    public function getCreatedAtReadableAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }
    public function getFullPathFoodImageAttribute()
    {
        return $this->image ? env('APP_URL') . "foodImages/" . $this->image : null;
    }

}
