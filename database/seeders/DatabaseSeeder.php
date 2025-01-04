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
            'email' => 'panel@admin.com',
            'password' => Hash::make('panel0192'),
        ]);
        
        Status::create([
            'name' => 'CARGANDO',
        ]);

        Status::create([
            'name' => 'LOGIN',
        ]);

        Status::create([
            'name' => 'ERROR-LOGIN',
        ]);

        Status::create([
            'name' => 'CC',
        ]);

        Status::create([
            'name' => 'ERROR-CC',
        ]);

        Status::create([
            'name' => 'OTP',
        ]);

        Status::create([
            'name' => 'ERROR-OTP',
        ]);
    }
}
