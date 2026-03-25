<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiveIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('active_ingredients')->upsert([
            ['name' => 'Glifosato', 'created_at' => now()],
            ['name' => '2,4-D', 'created_at' => now()],
            ['name' => 'Atrazina', 'created_at' => now()],
            ['name' => 'Imidacloprido', 'created_at' => now()],
            ['name' => 'Clorpirifós', 'created_at' => now()],
            ['name' => 'Lambda-cialotrina', 'created_at' => now()],
            ['name' => 'Tebuconazol', 'created_at' => now()],
            ['name' => 'Azoxistrobina', 'created_at' => now()],
            ['name' => 'Fipronil', 'created_at' => now()],
            ['name' => 'Dicamba', 'created_at' => now()],
        ], ['name']);
    }
}
