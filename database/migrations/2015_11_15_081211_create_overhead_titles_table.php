<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverheadTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overhead_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->enum('type', ['fixed', 'variable', 'provision']);
            $table->unsignedInteger('overhead_group_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('overhead_group_id')->references('id')->on('overhead_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('overhead_titles');
    }
}
