<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stores_id');
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->unsignedBigInteger('labels_id')->nullable();
            $table->string('product_name');
            $table->string('price_buy');
            $table->string('price_sell');
            $table->longText('note')->nullable();
            $table->string('img')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->timestamps();

            $table->foreign('stores_id')->references('id')->on('stores');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('labels_id')->references('id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
