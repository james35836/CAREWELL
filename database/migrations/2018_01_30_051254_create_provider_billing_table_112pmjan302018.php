<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderBillingTable112pmjan302018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_provider_billing', function (Blueprint $table) {
            $table->increments('provider_billing_id');
            $table->string('provider_billing_name');
            $table->string('provider_billing_email');
            $table->string('provider_billing_telephone');
            $table->string('provider_billing_mobile');
            $table->string('provider_billing_zipcode');
            $table->string('provider_billing_street');
            $table->string('provider_billing_city');
            $table->string('provider_billing_country');
            $table->integer('provider_id');
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
