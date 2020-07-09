<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantCustomUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrant_custom_universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registrant_id')->nullable();
            $table->string('university_name');
            $table->string('organization_name');

            $table->index('registrant_id');

            $table->foreign('registrant_id')->references('id')->on('registrants')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrant_custom_universities');
    }
}
