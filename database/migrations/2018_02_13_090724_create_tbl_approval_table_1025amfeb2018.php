<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalTable1025amfeb2018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_approval', function (Blueprint $table) {
            $table->increments('approval_id');
            $table->string('approval_number');
            $table->text('approval_complaint');
            $table->string('approval_created');
            $table->integer('availment_id');
            $table->integer('provider_id');
            $table->integer('member_id');
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
