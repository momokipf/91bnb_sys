<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('House', function (Blueprint $table) {
            if (!Schema::hasColumn('House', 'ImagePath')) {
                $table->string('ImagePath',300)->nullable();
            }
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
            if (Schema::hasColumn('House', 'ImagePath')) {
                $table->dropColumn('ImagePath');
            }
        });
    }
}
