<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Ganti 'password' dengan kata sandi yang diinginkan
            'role' => 'admin',
            // Tambahkan data alamat admin jika diperlukan
            'address' => 'Alamat admin',
            'province' => 'Provinsi admin',
            'city' => 'Kota admin',
            'district' => 'Kecamatan admin',
            'village' => 'Desa admin',
            'zip_code' => '12345',
            'phone' => '081234567890',
        ]);
    }
}
