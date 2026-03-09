<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'manufacturer_id'
    ];

    protected $with = [
        'manufacturer'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {

            $query->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")

                    ->orWhereHas('manufacturer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('activeIngredients', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        });
    }

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
