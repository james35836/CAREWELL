<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberDependentTable1008jan1617 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_member_dependent', function (Blueprint $table) {
            $table->increments('member_dependent_id');
            $table->string('member_dependent_full_name');
            $table->string('member_dependent_birthdate');
            $table->string('member_dependent_relationship');
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
