<?php

namespace App\Services;

use App\Models\Crop;
use Illuminate\Support\Facades\DB;
use App\DTO\Crop\CropStoreData;
use App\DTO\Crop\CropUpdateData;

class CropService
{
    public function store(CropStoreData $data): Crop
    {
        return DB::transaction(function () use ($data) {

            return Crop::create([
                'name' => $data->name,
                'harvest_year' => $data->harvestYear,
                'field_id' => $data->fieldId
            ]);
        });
    }

    public function update(CropUpdateData $data): Crop
    {
        return DB::transaction(function () use ($data) {

            $crop = Crop::findOrFail($data->id);

            $crop->update([
                'name' => $data->name,
                'harvest_year' => $data->harvestYear,
                'field_id' => $data->fieldId
            ]);

            return $crop;
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {

            $crop = Crop::findOrFail($id);

            $crop->delete();
        });
    }
}
