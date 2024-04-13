<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $appends = ['createdAtReadable', 'fullPathUserImage'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeOfSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phoneNumber', 'like', '%' . $search . '%');
        }
        return $query;
    }
    public function getCreatedAtReadableAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }
    public function getFullPathUserImageAttribute()
    {
        return $this->image ? env('APP_URL') . "userImages/" . $this->image : null;
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
