<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('end_year');
            $table->string('job');
            $table->string('business');
            $table->string('study');
            $table->string('tech');
            $table->string('army');
            $table->string('abroad');
            $table->string('child');
            $table->string('work');
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
        Schema::dropIfExists('bests');
    }
}
