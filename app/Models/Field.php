<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'area',
        'farm_id'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function crops()
    {
        return $this->hasMany(Crop::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
