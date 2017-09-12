<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_id')->unsigned();
            $table->boolean('accomodation_hotel')->nullable();
            $table->boolean('accomodation_relocation')->nullable();
            $table->boolean('air_ambulance')->nullable();
            $table->boolean('air_commercial')->nullable();
            $table->boolean('ground_ambulance')->nullable();
            $table->boolean('ground_sedan')->nullable();
            $table->boolean('ground_shared')->nullable();
            $table->boolean('ground_wav')->nullable();
            $table->boolean('international_health_insurance')->nullable();
            $table->boolean('payments_reimbursement')->nullable();
            $table->boolean('payments_stipend')->nullable();
            $table->boolean('visa_passport')->nullable();
            $table->boolean('traveling_nurse')->nullable();
            $table->boolean('travel_companion')->nullable();
            $table->integer('ground_default')->unsigned()->nullable();
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_services');
    }
}
