<?php

namespace Database\Seeders;

use App\Models\WebProfile;
use Illuminate\Database\Seeder;

class WebProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebProfile::create([
            'title' => 'Kopi Pucuk Kute',
            'description' => 'Kopi Pucuk Kute (KPK) memproduksi Kopi jenis Robusta yang berasal dari kawasan Pegunungan Bukit Barisan dengan Ketinggi +/- 900 Mdpl yang tepatnya berada di Pulau Beringin, Tanjung Kari OKU Selatan Sumatera
            selatan',
            'email' => 'contact@kopi-pucuk-kute.com',
            'phone' => '085611223344',
            'address' => 'Jl. Jenderal Ahmad Yani, 14',
            'province' => 'Sumatera Selatan',
            'city' => 'Palembang',
            'district' => 'Seberang Ulu II',
            'village' => 'Ulu',
            'zip_code' => '30111',
        ]);
    }
}
