<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Transaction', function (Blueprint $table) {
            if (!Schema::hasColumn('Transaction', 'amount')) {
                $table->integer('amount')->unsigned();
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
        Schema::table('Transaction', function (Blueprint $table) {
            if (Schema::hasColumn('Transaction', 'amount')) {
                $table->dropColumn('amount');
            }
        });
    }
}
