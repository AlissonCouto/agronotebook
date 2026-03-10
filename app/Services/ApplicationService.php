<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use App\DTO\Application\ApplicationStoreData;
use App\DTO\Application\ApplicationUpdateData;

class ApplicationService
{
    public function store(ApplicationStoreData $data): Application
    {
        return DB::transaction(function () use ($data) {

            return Application::create([
                'application_date' => $data->applicationDate,
                'dose' => $data->dose,
                'unit' => $data->unit,
                'area_applied' => $data->areaApplied,
                'application_type' => $data->applicationType,
                'responsible_technician' => $data->responsibleTechnician,
                'notes' => $data->notes,
                'product_id' => $data->productId,
                'field_id' => $data->fieldId,
                'crop_id' => $data->cropId,
                'created_by' => auth()->id()
            ]);
        });
    }

    public function update(ApplicationUpdateData $data): Application
    {
        return DB::transaction(function () use ($data) {

            $application = Application::findOrFail($data->id);

            $application->update([
                'application_date' => $data->applicationDate,
                'dose' => $data->dose,
                'unit' => $data->unit,
                'area_applied' => $data->areaApplied,
                'application_type' => $data->applicationType,
                'responsible_technician' => $data->responsibleTechnician,
                'notes' => $data->notes,
                'product_id' => $data->productId,
                'field_id' => $data->fieldId,
                'crop_id' => $data->cropId,
            ]);

            return $application;
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {

            $application = Application::findOrFail($id);

            $application->delete();
        });
    }
}
