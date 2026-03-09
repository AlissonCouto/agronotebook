<?php

namespace App\Services;

use App\DTO\Product\ProductStoreData;
use App\DTO\Product\ProductUpdateData;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function store(ProductStoreData $data): Product
    {
        return DB::transaction(function () use ($data) {

            $product = Product::create([
                'name' => $data->name,
                'manufacturer_id' => $data->manufacturerId,
            ]);

            if (!empty($data->activeIngredientsId)) {

                $product->activeIngredients()->sync(
                    $data->activeIngredientsId
                );
            }

            return $product;
        });
    }

    public function update(ProductUpdateData $data): Product
    {
        return DB::transaction(function () use ($data) {

            $product = Product::findOrFail($data->id);

            $product->update([
                'name' => $data->name,
                'manufacturer_id' => $data->manufacturerId
            ]);

            $product->activeIngredients()->sync(
                $data->activeIngredientsId
            );

            return $product;
        });
    }
}
