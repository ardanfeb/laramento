<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpnameItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opname_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_opnames_id');
            $table->unsignedBigInteger('products_id');
            $table->integer('qty_system');
            $table->integer('qty_real');
            $table->integer('diff');
            $table->string('price_old');
            $table->string('price_new');
            $table->timestamps();

            $table->foreign('stock_opnames_id')->references('id')->on('stock_opnames');
            $table->foreign('products_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_opname_items');
    }
}
