<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'total_area',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'farm_users'
        )->withPivot('role');
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
