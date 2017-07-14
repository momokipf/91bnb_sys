<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Transaction')) {
            Schema::create('Transaction', function (Blueprint $table) {
                $table->increments('transactionID');
                $table->integer('inquiryID')->unsigned();
                $table->integer('numberID')->unsigned();
                $table->tinyInteger('status');
                $table->timestamps();
            });

            Schema::table('Transaction', function(Blueprint $table) {
                $table->foreign('inquiryID')->references('inquiryID')->on('Inquiry')->onDelete('cascade');
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
        Schema::dropIfExists('Transaction');
    }
}
