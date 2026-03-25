<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manufacturers')->upsert([
            ['name' => 'Bayer', 'created_at' => now()],
            ['name' => 'Syngenta', 'created_at' => now()],
            ['name' => 'BASF', 'created_at' => now()],
            ['name' => 'Corteva Agriscience', 'created_at' => now()],
            ['name' => 'FMC', 'created_at' => now()],
            ['name' => 'UPL', 'created_at' => now()],
            ['name' => 'Sumitomo Chemical', 'created_at' => now()],
            ['name' => 'Nufarm', 'created_at' => now()],
            ['name' => 'Adama', 'created_at' => now()],
            ['name' => 'Ourofino Agrociência', 'created_at' => now()],
        ], ['name']);
    }
}
