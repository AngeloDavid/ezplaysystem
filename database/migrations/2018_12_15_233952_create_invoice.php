<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /***
         * 1 .- Enviada -- ingresada
         * 2 .- Procesada -- Enviada al cliente         
         * 3 .- Pagada por cliente
         * 4 .- Depositado o transferencia completada -- archivo de pago
         * 0 .- Anulado
         */

        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->dateTimeTz('date');
            $table->string('desp',150)->nullable();
            $table->enum('type',['FACT','NCE']);
            $table->enum('IVA',['0%','12%']);
            $table->enum('wayToPay',['transfer','check']);
            $table->string('file')->nullable();
            $table->unsignedDecimal('amount', 8, 2);
            $table->boolean('ivaincluded');  
            $table->smallInteger('status'); 
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
        Schema::dropIfExists('invoice');
    }
}
