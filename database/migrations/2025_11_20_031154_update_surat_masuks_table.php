<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_masuks', 'tanggal')) {
                $table->date('tanggal')->nullable();
            }

            if (!Schema::hasColumn('surat_masuks', 'pengirim')) {
                $table->string('pengirim')->nullable();
            }

            // pastikan kolom lain ada dan formatnya sesuai
            $table->string('nomor_surat')->nullable()->change();
            $table->string('perihal')->nullable()->change();
            $table->string('file_surat')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            // Hapus hanya jika diperlukan rollback
            // $table->dropColumn(['tanggal', 'pengirim']);
        });
    }
};