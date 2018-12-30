<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyCostumerCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('costumer', function (Blueprint $table) {
            $table->integer('id_company')->unsigned()->after('status');
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
        Schema::table('costumer', function (Blueprint $table) {
            $table->dropColumn('id_company');            
        });
    }
}
