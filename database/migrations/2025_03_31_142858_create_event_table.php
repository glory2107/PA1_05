<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->date('tanggal');
            $table->foreignId('created_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->foreignId('modified_by')->nullable()->constrained('admin')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('event');
    }
};
