<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HouseImage', function (Blueprint $table) {
            $table->increments('ImageId');
            $table->integer('numberID')->unsigned();
            $table->String('HousePath',300);
        });
        Schema::table('HouseImage', function(Blueprint $table) {
                $table->foreign('numberID')->references('numberID')->on('House')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HouseImage');
    }
}
