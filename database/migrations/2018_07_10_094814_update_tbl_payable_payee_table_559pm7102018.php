<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblPayablePayeeTable559pm7102018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_payable_payee', function (Blueprint $table) 
        {
            $table->renameColumn('approval_id','doctor_id');
            $table->dropColumn('doctor_approval_id');
            $table->string('payable_payee_type')->after('payable_bank_name');
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
