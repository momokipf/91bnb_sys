<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HouseAvailability', function (Blueprint $table){
            $table->engine = 'InnoDB';


            $table->integer('numberID')->unsigned();
            $table->primary('numberID');

            $table->tinyInteger('rentShared');
            $table->tinyInteger('availability')->nullable();
            $table->date('nextAvailableDate')->nullable();
            $table->integer('minStayTerm')->nullable();
            $table->string('minStayUnit',5)->nullable();
            $table->tinyInteger('allowCooking')->nullable();
            $table->tinyInteger('furnished')->nullable();
            $table->string('availabilityNote',300)->nullable();

            

        });

        Schema::table('HouseAvailability', function($table) {
            $table->foreign('numberID')->references('numberID')->on('House');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HouseAvailability');
    }
}
