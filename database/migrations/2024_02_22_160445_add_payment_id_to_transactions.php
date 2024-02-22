<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIdToTransactions extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Tambah kolom id_payment setelah kolom shipping_price
            $table->unsignedBigInteger('id_payment')->after('shipping_price')->nullable();
            // Tambah foreign key ke tabel payments
            $table->foreign('id_payment')->references('id')->on('payments');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus foreign key dan kolom id_payment jika diperlukan
            $table->dropForeign(['id_payment']);
            $table->dropColumn('id_payment');
        });
    }
}
