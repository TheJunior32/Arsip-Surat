<?php


namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index(Request $request)
{
    $totalSuratMasuk = SuratMasuk::count();
    $totalSuratKeluar = SuratKeluar::count();

    $keyword = $request->q;

    // Query surat masuk
    $suratMasukQuery = SuratMasuk::select(
        'nomor_surat',
        'pengirim',
        'perihal',
        'tanggal_surat as tanggal',
        'file_surat as file',
        'created_at'
    );

    if ($keyword) {
        $suratMasukQuery->where(function ($q) use ($keyword) {
            $q->where('nomor_surat', 'LIKE', "%{$keyword}%")
              ->orWhere('pengirim', 'LIKE', "%{$keyword}%")
              ->orWhere('perihal', 'LIKE', "%{$keyword}%");
        });
    }

    // Query surat keluar
    $suratKeluarQuery = SuratKeluar::select(
        'nomor_surat',
        'pengirim',
        'perihal',
        'tanggal_surat as tanggal',
        'file_surat as file',
        'created_at'
    );

    if ($keyword) {
        $suratKeluarQuery->where(function ($q) use ($keyword) {
            $q->where('nomor_surat', 'LIKE', "%{$keyword}%")
              ->orWhere('pengirim', 'LIKE', "%{$keyword}%")
              ->orWhere('perihal', 'LIKE', "%{$keyword}%");
        });
    }

    // Gabungkan dua tabel
    $recent = $suratMasukQuery
                ->union($suratKeluarQuery)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

    return view('dashboard', compact('totalSuratMasuk', 'totalSuratKeluar', 'recent'));
}




}
