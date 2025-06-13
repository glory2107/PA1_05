<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            // Menambah kolom hanya jika belum ada
            if (!Schema::hasColumn('struktur_organisasi', 'image')) {
                $table->string('image')->nullable();
            }

            if (!Schema::hasColumn('struktur_organisasi', 'created_by')) {
                $table->integer('created_by')->nullable();
            }

            if (!Schema::hasColumn('struktur_organisasi', 'modified_by')) {
                $table->integer('modified_by')->nullable();
            }

            // Menghapus kolom nama dan jabatan
            $table->dropColumn(['nama', 'jabatan']);
        });
    }

    public function down(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            // Menghapus kolom image
            $table->dropColumn('image');

            // Menghapus kolom created_by
            $table->dropColumn('created_by');

            // Menghapus kolom modified_by
            $table->dropColumn('modified_by');

            // Menambahkan kembali kolom nama dan jabatan
            $table->string('nama');
            $table->string('jabatan');
        });
    }
};
