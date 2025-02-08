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
        Schema::create('tags_berita', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tag');
            $table->string('slug');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->unsignedInteger('created_by')->constrained('users');
            $table->unsignedInteger('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_berita');
    }
};
