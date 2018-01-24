<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDoctorTable1022amjan2418 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_doctor', function (Blueprint $table) {
            $table->increments('doctor_id');
            $table->string('doctor_number');
            $table->string('doctor_first_name');
            $table->string('doctor_middle_name');
            $table->string('doctor_last_name');
            $table->string('doctor_gender');
            $table->string('doctor_birthdate');
            $table->string('doctor_contact_number');
            $table->string('doctor_email_address');
            $table->text('doctor_address');
            $table->string('doctor_created');
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
