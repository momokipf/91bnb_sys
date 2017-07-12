<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousingConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('HousingCondition')){
            Schema::create('HousingCondition', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('numberID')->unsigned();
            $table->primary('numberID');

            $table->string('additionalNote', 50)->nullable();
            $table->tinyInteger('offerToothbrush')->nullable();
            $table->tinyInteger('offerToothpaste')->nullable();
            $table->tinyInteger('offerFacialWash')->nullable();
            $table->tinyInteger('offerBodyWash')->nullable();
            $table->tinyInteger('offerSoap')->nullable();
            $table->tinyInteger('offerShampoo')->nullable();
            $table->tinyInteger('offerConditioner')->nullable();
            $table->tinyInteger('offerTowel')->nullable();
            $table->tinyInteger('offerBathTowel')->nullable();
            $table->tinyInteger('offerHairDryer')->nullable();
            $table->tinyInteger('offerIron')->nullable();
            $table->tinyInteger('offerHangers')->nullable();
            $table->tinyInteger('offerSlippers')->nullable();
            $table->tinyInteger('offerWorkSpace')->nullable();
            $table->tinyInteger('offerWifi')->nullable();
            $table->tinyInteger('offerTV')->nullable();
            $table->tinyInteger('offerChineseTV')->nullable();
            $table->tinyInteger('offerCable')->nullable();
            $table->tinyInteger('offerAC')->nullable();
            $table->tinyInteger('offerHeater')->nullable();
            $table->tinyInteger('offerHotWaterkettle')->nullable();
            $table->tinyInteger('offerRiceCooker')->nullable();
            $table->tinyInteger('offerCookware')->nullable();
            $table->tinyInteger('offerCookingPan')->nullable();
            $table->tinyInteger('offerCookingKnife')->nullable();
            $table->tinyInteger('offerUtensils')->nullable();
            $table->tinyInteger('offerCookingPot')->nullable();
            $table->tinyInteger('havePet')->nullable();
            $table->string('havePetType', 20)->nullable();
            $table->tinyInteger('haveSmokeDetector')->nullable();
            $table->tinyInteger('haveFirstAidKit')->nullable();
            $table->tinyInteger('haveFireExt')->nullable();
            $table->tinyInteger('haveCCTV')->nullable();
            $table->tinyInteger('haveCODetector')->nullable();
            $table->tinyInteger('haveSafetyGuard')->nullable();
            $table->tinyInteger('haveBedroomLock')->nullable();
            $table->tinyInteger('haveSecurityAlarm')->nullable();
            $table->tinyInteger('allowPregnant')->nullable();
            $table->tinyInteger('allowBaby')->nullable();
            $table->tinyInteger('allowKid')->nullable();
            $table->tinyInteger('allowKidAge')->nullable();
            $table->tinyInteger('allowPets')->nullable();
            $table->string('allowPetType', 20)->nullable();
            $table->tinyInteger('allowKitchen')->nullable();
            $table->tinyInteger('allowParking')->nullable();
            $table->tinyInteger('allowSwimmingPool')->nullable();
            $table->tinyInteger('allowBBQ')->nullable();
            $table->tinyInteger('allowFrontYard')->nullable();
            $table->tinyInteger('allowBackYard')->nullable();
            $table->tinyInteger('allowLaundryWasher')->nullable();
            $table->tinyInteger('allowLandryDryer')->nullable();
            $table->tinyInteger('allowGym')->nullable();
            $table->tinyInteger('allowElevator')->nullable();
            $table->tinyInteger('allowHotTub')->nullable();   
        });
        Schema::table('HousingCondition', function($table) {
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
        Schema::dropIfExists('HousingCondition');
        //
    }
}
