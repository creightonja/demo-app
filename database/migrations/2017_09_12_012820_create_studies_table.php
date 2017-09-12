<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sponsor_id')->unsigned();
            $table->integer('cro_id')->unsigned()->nullable();

            $table->string('name');
            $table->string('protocol_number');
            $table->string('protocol_link')->nullable();
            $table->integer('study_size');
            $table->text('patient_visit_agenda')->nullable();
            $table->text('study_overview')->nullable();
            $table->boolean('set_up_complete')->default(0);
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('studies');
    }
}
