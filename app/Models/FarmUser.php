<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmUser extends Model
{
    protected $fillable = [
        'user_id',
        'farm_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
