<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUserInfoTable1132jan1717 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_info', function (Blueprint $table) {
            $table->increments('user_info_id');
            $table->string('user_first_name');
            $table->string('user_middle_name');
            $table->string('user_last_name');
            $table->string('user_gender');
            $table->string('user_birthdate');
            $table->string('user_contact_number');
            $table->string('user_id_number');
            $table->string('user_address');
            $table->string('user_created');
            $table->integer('user_id');
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
