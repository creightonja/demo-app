<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_id')->unsigned()->default(0)->nullable();
            $table->integer('airfare')->unsigned()->default(0)->nullable();
            $table->integer('home_to_airport')->unsigned()->default(0)->nullable();
            $table->integer('airport_to_site')->unsigned()->default(0)->nullable();
            $table->integer('site_to_airport')->unsigned()->default(0)->nullable();
            $table->integer('hotel')->unsigned()->default(0)->nullable();
            $table->integer('meal_per_diem')->unsigned()->default(0)->nullable();
            $table->integer('stipend')->unsigned()->default(0)->nullable();
            $table->integer('expense_reimbursement')->unsigned()->default(0)->nullable();
            $table->integer('local_home_to_site')->unsigned()->default(0)->nullable();
            $table->integer('local_meal_per_diem')->unsigned()->default(0)->nullable();
            $table->integer('local_stipend')->unsigned()->default(0)->nullable();
            $table->integer('local_expense_reimbursement')->unsigned()->default(0)->nullable();

            $table->integer('airfare_qty')->unsigned()->default(0)->nullable();
            $table->integer('home_to_airport_qty')->unsigned()->default(0)->nullable();
            $table->integer('airport_to_site_qty')->unsigned()->default(0)->nullable();
            $table->integer('site_to_airport_qty')->unsigned()->default(0)->nullable();
            $table->integer('hotel_qty')->unsigned()->default(0)->nullable();
            $table->integer('meal_per_diem_qty')->unsigned()->default(0)->nullable();
            $table->integer('stipend_qty')->unsigned()->default(0)->nullable();
            $table->integer('expense_reimbursement_qty')->unsigned()->default(0)->nullable();
            $table->integer('local_home_to_site_qty')->unsigned()->default(0)->nullable();
            $table->integer('local_meal_per_diem_qty')->unsigned()->default(0)->nullable();
            $table->integer('local_stipend_qty')->unsigned()->default(0)->nullable();
            $table->integer('local_expense_reimbursement_qty')->unsigned()->default(0)->nullable();


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
        Schema::dropIfExists('study_costs');
    }
}
