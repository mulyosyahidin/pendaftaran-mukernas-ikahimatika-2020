<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('phone_number', 16);
            $table->string('whatsapp_number', 16);
            $table->string('nim', 16);
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('university_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('region_id');
            $table->index('university_id');
            $table->index('organization_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('NO ACTION');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('SET NULL')->onUpdate('NO ACTION');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('SET NULL')->onUpdate('NO ACTION');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('SET NULL')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrants');
    }
}
