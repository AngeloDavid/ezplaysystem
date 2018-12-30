<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyInvoiceCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->integer('id_company')->unsigned()->after('id_customer');
            $table->foreign('id_company')->references('id')->on('company');
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
            $table->dropColumn('id_company');            
        });
    }
}
