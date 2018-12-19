<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostumer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costumer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruc',15);
            $table->string('name',100);            
            $table->string('logo')->nullable();
            $table->string('email',100);
            $table->string('address',150);
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();            
            $table->enum('type',['Natural','Juridica']);
            $table->enum('origin',['Nacional','Extranjero']);
            $table->string('phone1',20)->nullable();
            $table->string('phone2',20)->nullable();
            $table->string('contact')->nullable();
            $table->string('notes',255)->nullable(); 
            $table->boolean('status'); 
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
        Schema::dropIfExists('costumer');
    }
}
