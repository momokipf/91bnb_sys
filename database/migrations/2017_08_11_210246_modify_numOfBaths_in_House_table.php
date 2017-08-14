<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNumOfBathsInHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('House', function (Blueprint $table) {
            $table->dropColumn('numOfBaths');
        });
        Schema::table('House', function (Blueprint $table) {
            $table->float('numOfBaths', 3, 1)->after('numOfRooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('House', function (Blueprint $table) {
            
        });
    }
}
