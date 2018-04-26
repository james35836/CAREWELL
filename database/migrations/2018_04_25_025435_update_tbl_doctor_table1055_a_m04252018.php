<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblDoctorTable1055AM04252018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('tbl_doctor', function (Blueprint $table) {
            $table->dropColumn('doctor_middle_name');
            $table->dropColumn('doctor_last_name');
            $table->renameColumn('doctor_first_name','doctor_full_name');
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
