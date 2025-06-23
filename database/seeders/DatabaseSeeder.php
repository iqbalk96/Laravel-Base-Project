<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\History;
use App\Models\PrivacyPolicy;
use App\Models\Setting;
use App\Models\User;
use App\Models\VisionMission;
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
                'company_name' => 'Sukangopi',
                'email' => 'info@sukangopi.com',
                'phone' => '08123456789',
                'address' => 'Jl. Contoh Alamat No.1, Jakarta',
            ]
        );

        About::firstOrCreate([
            'title' => 'Tentang Kami',
        ], [
            'content' => 'Konten awal tentang kami',
        ]);

        History::firstOrCreate([
            'title' => 'Sejarah',
        ], [
            'content' => 'Konten awal history',
        ]);

        VisionMission::firstOrCreate([
            'vision' => 'Visi',
        ], [
            'mission' => 'Mission 1',
        ]);

        PrivacyPolicy::firstOrCreate([
            'content' => 'Privacy',
        ]);
    }
}
