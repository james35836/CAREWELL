<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblApprovalAddStatusColumn502pm6292018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_approval', function (Blueprint $table) 
        {
            $table->integer('member_company_id')->after('user_id');
            $table->tinyInteger('approval_status')->default(0)->after('user_id');
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
