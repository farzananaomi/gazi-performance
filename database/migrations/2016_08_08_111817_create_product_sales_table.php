<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('header_id');
            $table->unsignedInteger('product_id');
            $table->float('retail_quantity');
            $table->float('corporate_quantity');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('header_id')->references('id')->on('sales_headers');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_sales');
    }
}
