<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->integer('user')->nullable();
            $table->string( 'firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->date('date_of_birth');
            $table->bigInteger('phone');
            $table->string('streetname');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->boolean('active');
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
        Schema::dropIfExists('guests');
    }
}
