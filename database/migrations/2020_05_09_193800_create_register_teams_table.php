<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tournament_id',10);
            $table->string('display_name',600)->nullable();
            $table->integer('trys')->default(0);
            $table->integer('conversions')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('total')->default(0);
            $table->string('created_by',10);
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
        Schema::dropIfExists('register_teams');
    }
}
