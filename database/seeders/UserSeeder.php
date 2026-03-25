<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');

        $user = new User();
        $user->name = 'Alisson Couto';
        $user->email = 'admin@gmail.com';
        $user->password = $password;
        $user->role = 'ADMIN';
        $user->save();
    }
}
