<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionIdToRegistrantCustomUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrant_custom_universities', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable()->after('registrant_id');

            $table->index('region_id');

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('CASCADE')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrant_custom_universities', function (Blueprint $table) {
            //
        });
    }
}
