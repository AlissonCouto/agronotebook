<?php

namespace App\DTO\Crop;

class CropUpdateData
{
    public function __construct(
        public int $id,
        public string $name,
        public int $harvestYear,
        public int $fieldId
    ) {}

    public static function fromRequest(array $data, int $id): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            harvestYear: $data['harvest_year'],
            fieldId: $data['field_id']
        );
    }
}
