<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('RoomRequirement')){
            Schema::create('RoomRequirement', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('inquiryID')->unsigned();
                $table->integer('roomID')->unsigned();
                $table->primary(['inquiryID', 'roomID']);
                $table->string('roomType', 20)->nullable();
                $table->string('roomTypeOther', 40)->nullable();
                $table->integer('numOfBeds')->nullable();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RoomRequirement');
    }
}
