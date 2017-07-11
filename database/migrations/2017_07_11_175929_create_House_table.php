<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('House', function (Blueprint $table){
            $table->engine = 'InnoDB';


            $table->increments('numberID');
            $table->unique('numberID', 'numberID');

            //$table->unique('numberID');
            $table->integer('houseID')->default(0);
            $table->string('fullHouseID')->nullable();
            $table->integer('houseOwnerID')->unsigned();
            
            $table->date('dateHouseAdded')->nullable();
            $table->string('houseIDByOwner')->nullable();
            $table->string('region')->nullable();
            $table->string('houseAddress')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('houseZip')->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            
            
            $table->string('houseType')->nullable();
            $table->string('houseTypeOther')->nullable();
            $table->integer('repWithOwner')->nullable();
            $table->integer('size')->nullable();
            $table->integer('numOfRooms')->nullable();
            $table->integer('numOfBaths')->nullable();
            $table->integer('numOfBeds')->nullable();
            $table->integer('maxNumOfGuests')->nullable();
            $table->string('onOtherWebsite')->nullable();
            $table->integer('repWithGuest')->nullable();

                        // DB::statement('ALTER TABLE house_loc ADD SPATIAL INDEX (location)');


        });
        DB::statement('ALTER TABLE House ADD location POINT NOT NULL' );
        DB::statement('ALTER TABLE House ADD SPATIAL INDEX (location)');

        Schema::table('House', function($table) {
            $table->foreign('houseOwnerID')->references('houseOwnerID')->on('HouseOwner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('House');
    }
}
