<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'pengirim',
        'tujuan',
        'perihal',
        'file_surat',
        'created_by'
    ];

    protected $table = 'surat_keluars'; // sesuai nama tabel
}
