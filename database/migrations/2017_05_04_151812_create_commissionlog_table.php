<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateCommissionlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissionlog', function (Blueprint $table) {
            $table->increments('commissionID');
            $table->integer('vendorID')->nullable();
            $table->integer('customerID')->nullable();
            $table->date('transactionDate')->nullable();
            $table->date('dateCustomerPaid')->nullable();
            $table->string('payingMethod', 20)->nullable();
            $table->integer('sales')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('otherFee')->nullable();
            $table->integer('total')->nullable();
            $table->integer('costToVendor')->nullable();
            $table->integer('premium')->nullable();
            $table->tinyInteger('refund')->nullable();
            $table->integer('commission')->nullable();
            $table->date('dateCommissionPaid')->nullable();

            

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissionlog');
    }
}