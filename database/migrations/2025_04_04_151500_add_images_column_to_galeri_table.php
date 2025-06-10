<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->json('images')->nullable()->after('image'); // Tambahkan kolom images
        });
    }

    public function down()
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
