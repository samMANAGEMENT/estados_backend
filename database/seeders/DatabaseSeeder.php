<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);
        
        Status::create([
            'name' => 'cargando',
        ]);

        Status::create([
            'name' => 'login',
        ]);

        Status::create([
            'name' => 'error-login',
        ]);

        Status::create([
            'name' => 'cc',
        ]);

        Status::create([
            'name' => 'error-cc',
        ]);

        Status::create([
            'name' => 'otp',
        ]);

        Status::create([
            'name' => 'error-otp',
        ]);
    }
}
