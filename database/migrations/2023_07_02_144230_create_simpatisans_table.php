<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simpatisans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nik');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->enum('sex', ['Laki-Laki', 'Perempuan']);
            $table->foreignId('regency_id');
            $table->foreignId('district_id');
            $table->foreignId('subdistrict_id');
            $table->string('ktp')->nullable();
            $table->foreignId('user_id')->nullable();
        });
    }

/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpatisans');
    }
};
