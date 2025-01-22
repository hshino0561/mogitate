<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
            $table->bigIncrements('id'); // PRIMARY KEY
            $table->bigInteger('product_id')->unsigned()->nullable(false);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('season_id')->unsigned()->nullable(false);
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_season');
    }
}
