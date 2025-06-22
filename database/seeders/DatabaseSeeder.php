<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mail.com'], 
            [
                'name' => 'Test User',
                'password' => bcrypt(123456),
            ]
        );

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'Roketin',
                'email' => 'info@roketin.com',
                'phone' => '08123456789',
                'address' => 'Jl. Contoh Alamat No.1, Jakarta',
            ]
        );
    }
}
