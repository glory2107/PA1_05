<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('file', 255)->nullable();
            $table->date('tanggal');
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pengumuman');
    }
};
