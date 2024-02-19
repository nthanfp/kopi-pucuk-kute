<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id_transaction_detail');
            $table->unsignedInteger('id_transaction');
            $table->foreign('id_transaction')->references('id_transaction')->on('transactions')->onDelete('cascade');
            $table->unsignedInteger('id_product');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->unsignedInteger('id_variant');
            $table->foreign('id_variant')->references('id_variant')->on('product_variants')->onDelete('cascade');
            $table->integer('quantity');
            $table->float('price');
            $table->float('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
