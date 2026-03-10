<?php

namespace App\DTO\Crop;

class CropStoreData
{
    public function __construct(
        public string $name,
        public int $harvestYear,
        public int $fieldId
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            harvestYear: $data['harvest_year'],
            fieldId: $data['field_id']
        );
    }
}
