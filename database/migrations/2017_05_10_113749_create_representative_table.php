<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateRepresentativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Representative', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('repID')->comment('representative ID');
            $table->tinyInteger('active')->nullable();
            $table->string('repUserName', 20)->nullable();
            $table->string('password', 60)->nullable();
            $table->string('repPosition', 40)->nullable();
            $table->integer('repPriority')->nullable();
            $table->string('repFirstName', 20)->nullable();
            $table->string('repLastName', 20)->nullable();
            $table->string('remember_token', 100)->nullable();


            //$table->primary('repID');
            $table->unique(['repFirstName', 'repLastName']);




            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Representative');
    }
}