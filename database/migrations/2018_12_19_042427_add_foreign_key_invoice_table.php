<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Foreign key invoice to clients
        Schema::table('invoice', function (Blueprint $table) {
            $table->integer('id_customer')->unsigned()->after('status');
            $table->foreign('id_customer')->references('id')->on('costumer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->dropColumn('id_customer');            
        });
    }
}
