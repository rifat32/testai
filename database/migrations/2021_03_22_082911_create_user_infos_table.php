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
            $table->string('ip')->nullable();
            $table->string('continent_name')->nullable();
            $table->string('calling_code')->nullable();
            $table->string('city')->nullable();

            $table->string('country_name')->nullable();
            $table->string('district')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('isp')->nullable();
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
