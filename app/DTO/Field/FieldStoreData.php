<?php

namespace App\DTO\Field;

class FieldStoreData
{
    public function __construct(
        public string $name,
        public float $area,
        public int $farmId
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            area: $data['area'],
            farmId: $data['farm_id']
        );
    }
}
