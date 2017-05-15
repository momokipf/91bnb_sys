<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateInquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->increments('inquiryID')->comment('iquery ID');
            $table->integer('repID')->nullable()->comment('representative ID');
            $table->date('inquiryDate')->nullable();
            $table->string('inquirySource', 20)->nullable();
            $table->string('inquirySourceOther', 20)->nullable();
            $table->integer('inquirerID')->nullable()->comment('guest ID');
            $table->string('purpose', 30)->nullable();
            $table->string('purposeOther', 50)->nullable();
            $table->date('checkIn')->nullable()->comment('checkInDate');
            $table->date('checkOut')->nullable()->comment('checkOutDate');
            $table->string('country', 30)->nullable();
            $table->string('state', 20)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('cityOther', 50)->nullable();
            $table->string('fullHouseID', 50)->nullable();
            $table->string('rooms', 20)->nullable();
            $table->tinyInteger('share')->nullable();
            $table->string('houseType', 20)->nullable();
            $table->string('houseTypeOther', 20)->nullable();
            $table->string('room1Type', 20)->nullable();
            $table->string('room1TypeOther', 20)->nullable();
            $table->string('room2Type', 20)->nullable();
            $table->string('room2TypeOther', 20)->nullable();
            $table->string('room3Type', 20)->nullable();
            $table->string('room3TypeOther', 20)->nullable();
            $table->string('numOfAdult', 11)->nullable();
            $table->string('numOfChildren', 11)->nullable();
            $table->string('childAge', 30)->nullable();
            $table->tinyInteger('pregnancy')->nullable();
            $table->string('budgetLower', 11)->nullable();
            $table->string('budgetUpper', 11)->nullable();
            $table->string('budgetUnit', 8)->nullable();
            $table->tinyInteger('pet')->nullable();
            $table->string('petType', 10)->nullable();
            $table->string('specialNote', 400)->nullable();
            $table->integer('inquiryPriorityLevel')->nullable();
            $table->string('status', 10)->nullable()->comment('complete/decline/pending');
            $table->string('reasonOfDecline', 50)->nullable();
            $table->string('note', 250)->nullable();
            $table->string('comment', 400)->nullable();
            $table->integer('hasBaby')->nullable();

            

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry');
    }
}
