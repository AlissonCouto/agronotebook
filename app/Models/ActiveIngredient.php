<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveIngredient extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_active_ingredients');
    }
}
