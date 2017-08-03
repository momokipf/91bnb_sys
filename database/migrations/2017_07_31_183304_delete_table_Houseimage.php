<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTableHouseimage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('HouseImage');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('HouseImage', function (Blueprint $table) {
            $table->increments('ImageID');
            $table->integer('numberID')->unsigned();
            $table->String('ImagePath',300);
        });
        Schema::table('HouseImage', function(Blueprint $table) {
                $table->foreign('numberID')->references('numberID')->on('House')->onDelete('cascade');
            });
    }
}
