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
        //
        Schema::table('nilai_rapor', function (Blueprint $table) {
            $table->string('scan_rapor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('nilai_rapor', function (Blueprint $table) {
            $table->dropColumn('scan_rapor');
        });
    }
};
