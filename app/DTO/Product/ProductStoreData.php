<?php

namespace App\DTO\Product;

class ProductStoreData
{
    public function __construct(
        public string $name,
        public int $manufacturerId,
        public ?array $activeIngredientsId
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            manufacturerId: $data['manufacturer_id'],
            activeIngredientsId: $data['active_ingredients_id'] ?? []
        );
    }
}
