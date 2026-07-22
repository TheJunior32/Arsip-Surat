<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $suratKeluars = SuratKeluar::when($search, function ($query) use ($search) {
                $query->where('nomor_surat', 'like', "%$search%")
                      ->orWhere('pengirim', 'like', "%$search%")
                      ->orWhere('perihal', 'like', "%$search%");
            })
            ->latest()
            ->get();

        return view('surat_keluar.index', compact('suratKeluars'));
    }

    public function create()
    {
        return view('surat_keluar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_keluars',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required',
            'perihal' => 'required',
            'file_surat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = $request->file('file_surat')->store('surat_keluar', 'public');

        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'file_surat' => $filePath,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil disimpan!');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        if ($surat->file_surat && file_exists(storage_path('app/public/' . $surat->file_surat))) {
            unlink(storage_path('app/public/' . $surat->file_surat));
        }

        $surat->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil dihapus!');
    }
}
