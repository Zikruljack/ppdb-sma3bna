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
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('slug');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->unsignedInteger('created_by')->constrained('users');
            $table->unsignedInteger('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('kategori_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeries');
    }
};
