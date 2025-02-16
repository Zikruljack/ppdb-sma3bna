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
        Schema::table('sertifikat', function (Blueprint $table) {
            //change column institusi penerbit ke juara
            $table->renameColumn('institusi_penerbit', 'juara');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            //
            $table->renameColumn('juara', 'institusi_penerbit');
        });
    }
};
