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
        if (!Schema::hasTable('House')){
                Schema::create('House', function (Blueprint $table){
                $table->engine = 'InnoDB';


                $table->increments('numberID');

                //$table->unique('numberID');
                $table->integer('houseID')->default(0);
                $table->string('fullHouseID',45)->nullable();
                $table->integer('houseOwnerID')->unsigned();
                
                $table->date('dateHouseAdded')->nullable();
                $table->string('houseIDByOwner',20)->nullable();
                $table->string('region',5)->nullable();
                $table->string('houseAddress',100)->nullable();
                $table->string('country',30)->nullable();
                $table->string('state',20)->nullable();
                $table->string('city',40)->nullable();
                $table->string('houseZip')->nullable();
                $table->float('longitude', 10, 6)->nullable();
                $table->float('latitude', 10, 6)->nullable();
                
                
                $table->string('houseType',20)->nullable();
                $table->string('houseTypeOther',20)->nullable();
                $table->tinyInteger('rentShared');

                $table->integer('repWithOwner')->nullable();

                $table->integer('size')->nullable();
                $table->integer('numOfRooms')->nullable();
                $table->float('numOfBaths')->nullable();
                $table->integer('numOfBeds')->nullable();
                $table->integer('maxNumOfGuests')->nullable();

                $table->integer('minStayTerm')->nullable();
                $table->string('minStayUnit',5)->nullable();

                $table->string('onOtherWebsite',200)->nullable();
                $table->integer('repWithGuest')->nullable();

                $table->string('note',300)->nullable();



                // DB::statement('ALTER TABLE house_loc ADD SPATIAL INDEX (location)');


            });
            DB::statement('ALTER TABLE House ADD location POINT NOT NULL' );
            DB::statement('ALTER TABLE House ADD SPATIAL INDEX (location)');

            Schema::table('House', function($table) {
                $table->index('fullHouseID');
                $table->foreign('houseOwnerID')->references('houseOwnerID')->on('HouseOwner')->onDelete('cascade');
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
        Schema::dropIfExists('House');
    }
}
