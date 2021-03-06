<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPriceHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('month', ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December']);
            $table->integer('year');
            $table->enum('state', ['draft', 'final']);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['month', 'year', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_price_headers');
    }
}
