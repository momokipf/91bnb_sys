<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('HouseOwner')){
           Schema::create('HouseOwner', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('houseOwnerID');
                $table->unique('houseOwnerID', 'houseOwnerID');
                $table->string('first', 40)->nullable();
                $table->string('last', 20);
                $table->string('ownerCompanyName', 40)->nullable();
                $table->string('ownerUsPhoneNumber', 30)->nullable();
                $table->string('ownerPhone2Country', 43)->nullable();
                $table->string('ownerPhone2Number', 30)->nullable();
                $table->string('ownerEmail', 40)->nullable();
                $table->string('ownerWechatUserName', 40)->nullable();
                $table->string('ownerWechatID', 40)->nullable();
                $table->string('ownerOtherID', 20)->nullable();
                $table->string('bankAccountName', 250)->nullable();
                $table->string('bankName', 40)->nullable();
                $table->string('bankRountingNumber', 25)->nullable();
                $table->string('bankAccountNumber', 25)->nullable();
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
        Schema::dropIfExists('HouseOwner');
    }
}
