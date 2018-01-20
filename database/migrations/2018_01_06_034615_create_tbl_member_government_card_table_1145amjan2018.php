<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberGovernmentCardTable1145amjan2018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_member_government_card', function (Blueprint $table) {
            $table->increments('member_government_card_id');
            $table->string('member_government_card_philhealth');
            $table->string('member_government_card_sss');
            $table->string('member_government_card_tin');
            $table->string('member_government_card_hdmf');
            $table->integer('member_id');
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
