<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('HouseAvailability', function (Blueprint $table) {
            //
            $table->string('source',20)->nullable();
            $table->string('idInSource',200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('HouseAvailability', function (Blueprint $table) {
            //
             $table->dropColumn('source');
             $table->dropColumn('idInSource');
        });
    }
}
