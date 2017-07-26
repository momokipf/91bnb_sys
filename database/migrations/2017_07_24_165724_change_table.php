<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('HouseAvailability');

        Schema::create('HouseAvailability',function(Blueprint $table)
        {
            $table->integer('numberID')->unsigned();
            $table->tinyInteger('rentShared');
            $table->date('rentBegin');
            $table->date('rentEnd');
            $table->string('description',200);
            // $table->integer('rentprice');
            $table->integer('inquiryID');
        });

        Schema::table('HouseAvailability',function(Blueprint $table)
        {
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
        //
        Schema::dropIfExists('HouseAvailability');
    }
}


/*

    public function up()
    {
        //
        Schema::create('HouseAvailability',function(Blueprint $table)
        {
            $table->integer('numberID');
            $table->tinyInteger('rentShared');
            $table->date('rentBegin');
            $table->date('rentEnd');
            $table->string('description',200);
            $table->integer('rentprice');
            $table->integer('inquirerID');
            $table->foreign('numberID')->references('numberID')->on('House')->onDelete('cascade');
            $table->foreign('inquirerID')->references('inquirerID')->on('Inquirer')->onDelete('cascade');
        });
    }

    public function down()
    {
        //
        Schema::dropIfExists('HouseAvailability');
    }

*/