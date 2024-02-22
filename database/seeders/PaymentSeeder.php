<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan data bank pertama
        Payment::create([
            'name' => 'Bank ABC',
            'account_number' => '1234567890',
            'account_name' => 'John Doe',
            'status' => 'ON',
        ]);

        // Tambahkan data bank kedua
        Payment::create([
            'name' => 'Bank XYZ',
            'account_number' => '0987654321',
            'account_name' => 'Jane Doe',
            'status' => 'OFF',
        ]);
    }
}
