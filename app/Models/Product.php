<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'manufacturer_id'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function activeIngredients()
    {
        return $this->belongsToMany(
            ActiveIngredient::class,
            'product_active_ingredients'
        );
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
