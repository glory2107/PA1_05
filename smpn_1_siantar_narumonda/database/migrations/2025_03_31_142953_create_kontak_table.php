<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 255);
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->string('value', 255);
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('kontak');
    }
};
