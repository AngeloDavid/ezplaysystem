<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLegalRepresentCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->string('documentNom')->nullable()->after('contact');
            $table->string('documentID')->nullable()->after('documentNom');
            $table->string('legalRepre')->nullable()->after('contact'); 
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
            $table->dropColumn('documentNom');
            $table->dropColumn('documentID');
            $table->dropColumn('legalRepre');
        });
    }
}
