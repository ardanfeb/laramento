<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipe');
            $table->string('invoice');
            $table->string('marketplace')->nullable();
            $table->string('expedition')->nullable();
            $table->string('postal_fee')->nullable();
            $table->string('total_product');
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('users_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('customers_id')->references('id')->on('customers');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
