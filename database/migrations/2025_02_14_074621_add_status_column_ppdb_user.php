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
        Schema::table('ppdb_user', function (Blueprint $table) {
            $table->enum('status', ['Pendaftar', 'Valid', 'Tidak Valid' , 'Final'])->default('Pendaftar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('ppdb_user', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
