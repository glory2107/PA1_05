<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tenaga_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('jabatan', 255);
            $table->string('image', 255)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tenaga_kerja');
    }
};
