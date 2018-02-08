<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMemberDependentTable1150amfeb72018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_member_dependent', function (Blueprint $table) {
            $table->increments('dependent_id');
            $table->string('dependent_full_name');
            $table->string('dependent_birthdate');
            $table->string('dependent_relationship');
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
