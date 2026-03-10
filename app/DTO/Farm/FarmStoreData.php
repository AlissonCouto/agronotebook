<?php

namespace App\DTO\Farm;

class FarmStoreData
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $location,
        public ?float $totalArea
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            location: $data['location'] ?? null,
            totalArea: $data['total_area'] ?? null
        );
    }
}
