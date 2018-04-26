<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblApprovalDoctor850pmapr252018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_approval_doctor', function (Blueprint $table) {
            $table->dropColumn('specialization_id');
            $table->string('specialization_name')->after('approval_doctor_charge_carewell');
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
