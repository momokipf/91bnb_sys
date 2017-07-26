<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('HousePrice')){
            Schema::create('HousePrice', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('numberID')->unsigned();
                $table->primary('numberID');

                $table->integer('costDayPrice')->nullable();
                $table->integer('costWeekPrice')->nullable();
                $table->integer('costMonthPrice')->nullable();
                $table->integer('costUtility')->nullable();
                $table->integer('costCleaning')->nullable();
                $table->integer('costSecurityDeposit')->nullable();
                $table->integer('retailDayPrice')->nullable();
                $table->integer('retailWeekPrice')->nullable();
                $table->integer('retailMonthPrice')->nullable();
                $table->string('retailUtility', 50)->nullable();
                $table->integer('retailCleaning')->nullable();
                $table->integer('retailSecurityDeposit')->nullable();
                $table->double('upsellPercent')->nullable();
                $table->double('totPercent')->nullable();
                $table->string('utilityNote', 500)->nullable();
                $table->string('costNote', 500)->nullable();
            });
            Schema::table('HousePrice', function($table) {
                $table->foreign('numberID')->references('numberID')->on('House')->onDelete('cascade');
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
        Schema::dropIfExists('HousePrice');
        //
    }
}
