<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('states', function (Blueprint $table) {
           $table->increments('id');
           $table->string('code', 20)->default('OTR');
           $table->string('descp', 200);
           $table->boolean('status')->default(true);
           $table->integer('id_country')->unsigned();
           $table->foreign('id_country')->references('id')->on('country');
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
        Schema::dropIfExists('states');    
    }
}
