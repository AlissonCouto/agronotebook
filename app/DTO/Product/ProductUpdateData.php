<?php

namespace App\DTO\Product;

class ProductUpdateData
{
    public function __construct(
        public int $id,
        public string $name,
        public int $manufacturerId,
        public ?array $activeIngredientsId
    ) {}

    public static function fromRequest(array $data, int $id): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            manufacturerId: $data['manufacturer_id'],
            activeIngredientsId: $data['active_ingredients_id'] ?? []
        );
    }
}
