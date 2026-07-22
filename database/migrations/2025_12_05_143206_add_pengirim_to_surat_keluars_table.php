<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        /**
         * Run the migrations.
         */
    public function up()
    {
        Schema::table('surat_keluars', function (Blueprint $table) {
            $table->string('pengirim')->nullable()->after('tanggal_surat');
        });
    }

    public function down()
    {
        Schema::table('surat_keluars', function (Blueprint $table) {
            $table->dropColumn('pengirim');
        });
    }

};
