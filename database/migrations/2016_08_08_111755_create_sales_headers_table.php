<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('month', ['January', 'February', 'March', 'April', 'May', 'June',
                                   'July', 'August', 'September', 'October', 'November', 'December']);
            $table->integer('year');
            $table->float('package_commission')->default(0);
            $table->float('special_commission')->default(0);
            $table->float('yearly_commission')->default(0);
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
        Schema::drop('sales_headers');
    }
}
