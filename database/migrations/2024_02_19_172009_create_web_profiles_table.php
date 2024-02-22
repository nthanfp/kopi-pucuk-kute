<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('web_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable(); // Alamat email
            $table->string('phone')->nullable(); // Nomor telepon
            $table->string('address')->nullable(); // Alamat
            $table->string('province')->nullable(); // Provinsi
            $table->string('city')->nullable(); // Kota
            $table->string('district')->nullable(); // Kecamatan
            $table->string('village')->nullable(); // Kelurahan/Desa
            $table->string('zip_code')->nullable(); // Kode Pos
            // Anda dapat menambahkan field-field lain sesuai kebutuhan aplikasi Anda
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_profiles');
    }
};
