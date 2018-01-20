<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProviderTable530pmjan2017 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_provider', function (Blueprint $table) {
            $table->increments('provider_id');
            $table->string('provider_name');
            $table->string('provider_contact_person');
            $table->string('provider_contact_number');
            $table->string('provider_contact_email');
            $table->text('provider_address');
            $table->string('provider_created');
            $table->tinyInteger('archived')->default(0);
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
