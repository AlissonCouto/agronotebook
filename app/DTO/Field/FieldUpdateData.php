<?php

namespace App\DTO\Field;

class FieldUpdateData
{
    public function __construct(
        public int $id,
        public string $name,
        public float $area,
        public int $farmId
    ) {}

    public static function fromRequest(array $data, int $id): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            area: $data['area'],
            farmId: $data['farm_id']
        );
    }
}
