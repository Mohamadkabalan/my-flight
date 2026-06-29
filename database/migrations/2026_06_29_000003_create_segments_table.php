<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('leg_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('position');
            $table->char('origin', 3);
            $table->char('destination', 3);
            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');
            $table->string('cabin_class');
            $table->string('airline');
            $table->string('flight_number');
            $table->timestamps();

            $table->unique(['leg_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segments');
    }
};