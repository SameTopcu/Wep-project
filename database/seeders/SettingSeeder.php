<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::firstOrCreate(
            ['id' => 1],
            [
                'footer_address' => '34 Antiger Lane, USA, 12937',
                'footer_email' => 'contact@example.com',
                'footer_phone' => '122-222-1212',
                'footer_copyright' => 'Copyright &copy; 2024, TripSummit. All Rights Reserved.',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'youtube' => 'https://youtube.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ]
        );
    }
}
