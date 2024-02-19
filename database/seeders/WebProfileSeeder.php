<?php

namespace Database\Seeders;

use App\Models\WebProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebProfile::create([
            'title' => 'Nama Web Anda',
            'description' => 'Deskripsi singkat tentang web Anda.',
            'logo' => 'path/ke/logo.png',
            'favicon' => 'path/ke/favicon.ico',
        ]);
    }
}
