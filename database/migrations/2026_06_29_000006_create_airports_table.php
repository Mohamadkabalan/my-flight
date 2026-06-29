<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->char('iata_code', 3)->primary();
            $table->string('name');
            $table->string('city');
            $table->char('country', 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
