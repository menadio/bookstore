<?php

namespace App;

use App\User;
use App\Rating;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['user_id', 'title', 'author'];

    /**
     * Book/User relationship
     * A book belongs to only one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Book/Rating relationship
     * A book has many ratings
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
