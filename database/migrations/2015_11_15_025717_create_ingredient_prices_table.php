<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('header_id');
            $table->unsignedInteger('ingredient_id');
            $table->float('price');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('header_id')->references('id')->on('ingredient_price_headers');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ingredient_prices');
    }
}
