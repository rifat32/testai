<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('isp')->nullable();
            $table->string('ip')->nullable();
            $table->string('region')->nullable();
            $table->string('timezone')->nullable();
            $table->string('zip')->nullable();
            $table->string('website');
            $table->string('visited');
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
        Schema::dropIfExists('user_infos');
    }
}
