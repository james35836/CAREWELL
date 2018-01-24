<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCoverageTagTable226pmjan2418 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_coverage_tag', function (Blueprint $table) {
            $table->increments('coverage_tag_id');
            $table->integer('benefits_id');
            $table->integer('coverage_id');
            $table->string('coverage_tag_covered');
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
