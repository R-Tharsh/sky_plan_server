<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('airport_details', function (Blueprint $table) {
            $table->id();
            $table->string('ident')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->decimal('latitude_deg', 10, 6)->nullable();
            $table->decimal('longitude_deg', 10, 6)->nullable();
            $table->integer('elevation_ft')->nullable();
            $table->string('continent')->nullable();
            $table->string('country_name')->nullable();
            $table->string('iso_country')->nullable();
            $table->string('region_name')->nullable();
            $table->string('iso_region')->nullable();
            $table->string('local_region')->nullable();
            $table->string('municipality')->nullable();
            $table->boolean('scheduled_service')->nullable();
            $table->string('gps_code')->nullable();
            $table->string('icao_code')->nullable();
            $table->string('iata_code')->nullable();
            $table->string('local_code')->nullable();
            $table->string('home_link')->nullable();
            $table->string('wikipedia_link')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('score')->nullable();
            $table->timestampTz('last_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_details');
    }
};
