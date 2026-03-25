<?php

namespace App\Services;

use App\Models\Farm;
use App\DTO\Farm\FarmStoreData;
use App\DTO\Farm\FarmUpdateData;
use Illuminate\Support\Facades\DB;

class FarmService
{
    public function store(FarmStoreData $data): Farm
    {
        return DB::transaction(function () use ($data) {

            $userId = auth()->id();

            $farm = Farm::create([
                'name' => $data->name,
                'description' => $data->description,
                'location' => $data->location,
                'total_area' => $data->totalArea,
                'user_id' => $userId
            ]);

            // Cria vínculo na pivot como OWNER
            $farm->users()->attach($userId, [
                'role' => 'OWNER'
            ]);

            return $farm;
        });
    }

    public function update(FarmUpdateData $data): Farm
    {
        return DB::transaction(function () use ($data) {

            $farm = Farm::findOrFail($data->id);

            $farm->update([
                'name' => $data->name,
                'description' => $data->description,
                'location' => $data->location,
                'total_area' => $data->totalArea
            ]);

            return $farm;
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {

            $farm = Farm::findOrFail($id);

            $farm->delete();
        });
    }
}
