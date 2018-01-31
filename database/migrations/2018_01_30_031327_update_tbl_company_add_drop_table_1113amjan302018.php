<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblCompanyAddDropTable1113amjan302018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_company', function (Blueprint $table) {
            $table->string('company_zipcode')->after('company_phone_number');
            $table->string('company_street')->after('company_phone_number');
            $table->string('company_city')->after('company_phone_number');
            $table->string('company_country')->after('company_phone_number');
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
