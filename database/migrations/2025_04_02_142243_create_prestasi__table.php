<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('title', 255); // Kolom title
            $table->text('description')->nullable(); // Kolom description
            $table->string('image', 255)->nullable(); // Kolom image (dapat kosong)
            $table->date('tanggal'); // Kolom tanggal
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete(); // Kolom created_by, relasi dengan tabel admin
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete(); // Kolom modified_by, relasi dengan tabel admin
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasi'); // Menghapus tabel prestasi jika migrasi di-rollback
    }
};
