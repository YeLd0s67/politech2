<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->string('iin');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('date_birth');
            $table->string('gender');
            $table->string('nation');
            $table->string('other_nation');
            $table->string('spec_code');
            $table->string('spec');
            $table->string('group');
            $table->string('grant');
            $table->string('company');
            $table->string('study');
            $table->string('university');
            $table->string('study_type');
            $table->string('university_year');
            $table->string('end_year');
            $table->string('work');
            $table->string('army');
            $table->string('abroad');
            $table->string('child');
            $table->string('unemployed');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('business');
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
        Schema::dropIfExists('graduates');
    }
}
