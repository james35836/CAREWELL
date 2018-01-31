<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProviderTable127pmjan302018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_provider', function (Blueprint $table) {
            $table->renameColumn('provider_address', 'provider_zip');
            $table->string('provider_street')->before('provider_created');
            $table->string('provider_city')->before('provider_created');
            $table->string('provider_country')->before('provider_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
