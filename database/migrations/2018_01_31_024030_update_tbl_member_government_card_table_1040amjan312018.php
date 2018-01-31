<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblMemberGovernmentCardTable1040amjan312018 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_member_government_card', function (Blueprint $table) {
            $table->string('member_government_card_philhealth')->nullable()->change();
            $table->string('member_government_card_sss')->nullable()->change();
            $table->string('member_government_card_tin')->nullable()->change();
            $table->string('member_government_card_hdmf')->nullable()->change();
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
