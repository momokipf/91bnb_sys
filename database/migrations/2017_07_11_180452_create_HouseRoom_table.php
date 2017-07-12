<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HouseRoom', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('numberID')->unsigned();
            $table->integer('roomID')->unsigned();
            $table->primary(['numberID', 'roomID']);

            $table->string('roomType', 20)->nullable();
            $table->string('roomTypeOther', 40)->nullable();
            $table->string('roomBedType', 20)->nullable();
            $table->string('roomBedTypeOther', 40)->nullable();
            $table->integer('numOfBeds')->nullable();
            $table->char('roomGuestMax', 11)->nullable();
            $table->integer('roomCostDayPrice')->nullable();
            $table->integer('roomCostWeekPrice')->nullable();
            $table->integer('roomCostMonthPrice')->nullable();
            $table->integer('roomCostUtility')->nullable();
            $table->string('utilityNote', 400)->nullable();
            $table->integer('roomCostCleaning')->nullable();
            $table->integer('roomCostSecurityDeposit')->nullable();
            $table->integer('roomRetailDayPrice')->nullable();
            $table->integer('roomRetailWeekPrice')->nullable();
            $table->integer('roomRetailMonthPrice')->nullable();
            $table->integer('roomRetailUtility')->nullable();
            $table->integer('roomRetailCleaning')->nullable();
            $table->integer('roomRetailSecurityDeposit')->nullable();

        });
        Schema::table('HouseRoom', function($table) {
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
        Schema::dropIfExists('HouseRoom');
        //
    }
}
