<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $suratMasuk = SuratMasuk::when($search, function ($query, $search) {
            $query->where('nomor_surat', 'like', "%{$search}%")
                ->orWhere('pengirim', 'like', "%{$search}%")
                ->orWhere('perihal', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

        return view('surat_masuk.index', compact('suratMasuk'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_masuks',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required',
            'perihal' => 'required',
            'file_surat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ],[
            'file_surat.max' => 'Ukuran file terlalu besar! Maksimal 2 MB.',
            'file_surat.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG.',
        ]);

        $filePath = $request->file('file_surat')->store('surat_masuks', 'public');

        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_diterima' => $request->tanggal_diterima,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'file_surat' => $filePath,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function pdf(SuratMasuk $suratMasuk)
    {
        $pdf = \PDF::loadView('surat_masuk.pdf', [
            'surat' => $suratMasuk
        ]);

        return $pdf->stream('surat-masuk-'.$suratMasuk->id.'.pdf');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
    // Hapus file jika ada
        if ($suratMasuk->file_surat && file_exists(storage_path('app/public/'.$suratMasuk->file_surat))) {
            unlink(storage_path('app/public/'.$suratMasuk->file_surat));
        }


    // Hapus record
        $suratMasuk->delete();

        return redirect()->back()->with('success', 'Surat berhasil dihapus');
    }

}
