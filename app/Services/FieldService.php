<?php

namespace App\Services;

use App\Models\Field;
use Illuminate\Support\Facades\DB;
use App\DTO\Field\FieldStoreData;
use App\DTO\Field\FieldUpdateData;

class FieldService
{
    public function store(FieldStoreData $data): Field
    {
        return DB::transaction(function () use ($data) {

            $field = Field::create([
                'name' => $data->name,
                'area' => $data->area,
                'farm_id' => $data->farmId
            ]);

            return $field;
        });
    }

    public function update(FieldUpdateData $data): Field
    {
        return DB::transaction(function () use ($data) {

            $field = Field::findOrFail($data->id);

            $field->update([
                'name' => $data->name,
                'area' => $data->area,
                'farm_id' => $data->farmId
            ]);

            return $field;
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {

            $field = Field::findOrFail($id);

            $field->delete();
        });
    }
}
