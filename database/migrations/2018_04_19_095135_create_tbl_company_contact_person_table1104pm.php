<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCompanyContactPersonTable1104pm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_company_contact_person', function (Blueprint $table) 
        {
            $table->increments('contact_person_id');
            $table->string('contact_person_name');
            $table->string('contact_person_position');
            $table->string('contact_person_number');
            $table->string('contact_person_names');
            $table->string('contact_person_positions');
            $table->string('contact_person_numbers');
            $table->integer('company_id');
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
