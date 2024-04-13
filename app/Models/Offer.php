<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['createdAtReadable'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function offerItems()
    {
        return $this->hasMany(OfferItem::class);
    }
    public function getCreatedAtReadableAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
