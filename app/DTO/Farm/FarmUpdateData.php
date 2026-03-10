<?php

namespace App\DTO\Farm;

class FarmUpdateData
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description,
        public ?string $location,
        public ?float $totalArea
    ) {}

    public static function fromRequest(array $data, int $id): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            description: $data['description'] ?? null,
            location: $data['location'] ?? null,
            totalArea: $data['total_area'] ?? null
        );
    }
}
