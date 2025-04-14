<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('fasilitas_sekolah', function (Blueprint $table) {
            $table->id(); // ID untuk fasilitas_sekolah
            $table->string('title', 255); // Title untuk fasilitas
            $table->text('description')->nullable(); // Deskripsi fasilitas
            $table->string('image', 255)->nullable(); // Gambar fasilitas
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete(); // ID dari admin yang membuat
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete(); // ID dari admin yang mengubah
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down() {
        Schema::dropIfExists('fasilitas_sekolah');
    }
};
