<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblApprovalPayeeTable231pm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_approval_payee', function (Blueprint $table) {
            $table->renameColumn('payee_approval_id','approval_payee_id');
            $table->string('payee_name')->before('archived');
            $table->string('type')->before('archived');
            
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
