<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateInquirerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquirer', function (Blueprint $table) {
            $table->increments('inquirerID')->comment('inquirer ID');
            $table->string('inquirerFirst', 20)->nullable()->comment('inquirer first name, 20 letters max');
            $table->string('inquirerLast', 20)->nullable()->comment('inquirer last name, 20 letters max');
            $table->string('inquirerUsPhoneNumber', 20)->nullable();
            $table->string('inquirerPhoneCountry', 30)->nullable()->comment('inquirer phone number area code');
            $table->string('inquirerPhoneNumber', 15)->nullable()->comment('inquirer phone number');
            $table->string('inquirerEmail', 40)->nullable()->comment('inquirer email');
            $table->string('inquirerTaobaoUserName', 25)->nullable();
            $table->string('inquirerWechatUserName', 25)->nullable();
            $table->string('inquirerWechatID', 35)->nullable();
            $table->string('inquirerCountry', 30)->nullable();
            $table->string('inquirerState', 30)->nullable();
            $table->string('inquirerCity', 30)->nullable();
            $table->string('inquirerCityOther', 30)->nullable();

            

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquirer');
    }
}
