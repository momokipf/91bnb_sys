<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalpriceColToTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Transaction', function (Blueprint $table) {
            //
            $table->integer('dayprice')->unsigned();
            $table->integer('discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Transaction', function (Blueprint $table) {
            //
            if (Schema::hasColumn('Transaction', 'dayprice')) {
                $table->dropColumn('dayprice');
            }
            if(Schema::hasColumn('Transaction','discount')){
                $table->dropColumn('discount');
            }
        });
    }
}
