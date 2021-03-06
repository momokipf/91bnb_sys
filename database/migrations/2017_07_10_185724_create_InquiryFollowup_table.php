<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiryFollowupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('InquiryFollowup')){
            Schema::create('InquiryFollowup', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('inquiryID')->unsigned();
                $table->integer('followupID')->nusigned();
                $table->primary(['inquiryID','followupID']);
                
                $table->date('followupDate')->nullable();
                $table->string('followupStatus', 50)->nullable();
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
        Schema::dropIfExists('InquiryFollowup');
    }
}
