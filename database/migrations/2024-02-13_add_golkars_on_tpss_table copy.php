<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tps', function (Blueprint $table) {
            $table->string('golkars'); // Kolom 'golkars' yang wajib diisi
            $table->string('check')->unique(); // Kolom 'check' yang unik dan harus berisi nilai numerik
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tps', function (Blueprint $table) {
            $table->dropColumn('tps');
        });
    }
};
