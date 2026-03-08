<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $fillable = [
        'name',
        'harvest_year',
        'field_id'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
