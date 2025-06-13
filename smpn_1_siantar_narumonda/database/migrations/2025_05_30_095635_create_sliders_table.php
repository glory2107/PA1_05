<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('image', 255); // Kolom image, bisa menampung lebih dari 1 gambar, misal pakai JSON string
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete(); // Kolom created_by, relasi ke tabel admin
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete(); // Kolom modified_by, relasi ke tabel admin
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders'); // Menghapus tabel sliders jika migrasi di-rollback
    }
};
