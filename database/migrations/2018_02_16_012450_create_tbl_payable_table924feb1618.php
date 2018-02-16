<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPayableTable924feb1618 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payable', function (Blueprint $table) {
            $table->increments('payable_id');
            $table->string('payable_soa_number');
            $table->string('payable_recieved');
            $table->string('payable_due');
            $table->string('payable_created');
            $table->integer('provider_id');
            $table->integer('user_id');
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
