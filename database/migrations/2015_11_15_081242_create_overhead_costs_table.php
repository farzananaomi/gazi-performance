<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverheadCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overhead_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('header_id');
            $table->unsignedInteger('overhead_id');
            $table->float('cost');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('header_id')->references('id')->on('overhead_cost_headers');
            $table->foreign('overhead_id')->references('id')->on('overhead_titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('overhead_costs');
    }
}
