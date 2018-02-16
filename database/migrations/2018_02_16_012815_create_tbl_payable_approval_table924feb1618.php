<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPayableApprovalTable924feb1618 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payable_approval', function (Blueprint $table) {
            $table->increments('payable_approval_id');
            $table->integer('approval_id');
            $table->integer('payable_id');
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
