<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubavaidColOnHouseavatable extends Migration
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
            if(!Schema::hasColumn('HouseAvailability','avaid')){
                $table->integer('avaid');
            }
            $table->primary(['numberID','avaid']);
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
            if(Schema::hasColumn('HouseAvailability','avaid')){
                $table->dropColumn('avaid');
            }
            $table->dropPrimary(['numberID','avaid']);
        });
    }
}
