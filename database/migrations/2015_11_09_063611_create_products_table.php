<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('standard')->nullable();
            $table->string('length');
            $table->string('min_thickness')->nullable();
            $table->string('max_thickness')->nullable();
            $table->string('weight')->nullable();
            $table->string('color')->nullable();
            $table->string('image_path');
            $table->unsignedInteger('recipe_id');
            $table->unsignedInteger('product_group_id');
            $table->unsignedInteger('product_sub_group_id');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('product_group_id')->references('id')->on('product_groups');
            $table->foreign('product_sub_group_id')->references('id')->on('product_sub_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
