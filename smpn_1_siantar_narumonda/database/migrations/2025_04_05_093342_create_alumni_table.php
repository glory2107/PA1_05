<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('name', 255); // Kolom nama alumni
            $table->text('description')->nullable(); // Kolom deskripsi alumni
            $table->string('image')->nullable(); // Kolom image (opsional)
            
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete(); // relasi ke admin
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete(); // relasi ke admin
            
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
