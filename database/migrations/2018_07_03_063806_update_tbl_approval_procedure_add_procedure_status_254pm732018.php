<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblApprovalProcedureAddProcedureStatus254pm732018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_approval_procedure', function (Blueprint $table) 
        {
            $table->tinyInteger('procedure_status')->default(0)->after('procedure_disapproved');
            $table->dropColumn('diagnosis_id');
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
