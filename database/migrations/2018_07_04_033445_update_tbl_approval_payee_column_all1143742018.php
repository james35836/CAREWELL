<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblApprovalPayeeColumnAll1143742018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_approval_payee', function (Blueprint $table) 
        {
     
            $table->integer('provider_id')->after('approval_payee_id');
            $table->integer('doctor_id')->after('approval_payee_id');
            $table->dropColumn('payee_id');
            $table->dropColumn('payee_name');
            $table->dropColumn('type');

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
