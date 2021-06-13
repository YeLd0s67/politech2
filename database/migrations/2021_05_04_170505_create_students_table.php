<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('iin');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('date_birth');
            $table->string('gender');
            $table->string('citizen');
            $table->string('other_citizen');
            $table->string('nation');
            $table->string('other_nation');
            $table->string('spec');
            $table->string('group');
            $table->string('passport');
            $table->string('passport_given');
            $table->string('address');
            $table->string('phone');
            $table->string('school');
            $table->string('lang');
            $table->string('family_children');
            $table->string('clubs');
            $table->string('parent_names');
            $table->string('work');
            $table->string('parent_passport');
            $table->string('parent_iin');
            $table->string('status');
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
        Schema::dropIfExists('teachers');
    }
}
