<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblApprovalDoctorTable448mar42018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_approval_doctor', function ($table) {
            $table->renameColumn('procedure_id','doctor_procedure_id')->after('approval_doctor_charge_carewell');
            $table->dropColumn('approval_doctor_rate_rvs');
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
