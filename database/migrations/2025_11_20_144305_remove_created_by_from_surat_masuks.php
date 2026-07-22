<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            // 1. Hapus foreign key
            $table->dropForeign(['created_by']);

            // 2. Hapus kolom
            $table->dropColumn('created_by');
        });
    }

    public function down()
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable();

            // (opsional)
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
