<?php

namespace App\DTO\Application;

class ApplicationUpdateData
{
    public function __construct(
        public int $id,
        public string $applicationDate,
        public float $dose,
        public string $unit,
        public float $areaApplied,
        public string $applicationType,
        public string $responsibleTechnician,
        public ?string $notes,
        public int $productId,
        public int $fieldId,
        public int $cropId
    ) {}

    public static function fromRequest(array $data, int $id): self
    {
        return new self(
            id: $id,
            applicationDate: $data['application_date'],
            dose: $data['dose'],
            unit: $data['unit'],
            areaApplied: $data['area_applied'],
            applicationType: $data['application_type'],
            responsibleTechnician: $data['responsible_technician'],
            notes: $data['notes'] ?? null,
            productId: $data['product_id'],
            fieldId: $data['field_id'],
            cropId: $data['crop_id']
        );
    }
}
