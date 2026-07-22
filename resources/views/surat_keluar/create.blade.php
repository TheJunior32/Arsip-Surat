@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Surat Keluar</h1>

    <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label class="block mb-2 font-semibold">Nomor Surat</label>
            <input type="text" name="nomor_surat" class="w-full border rounded-lg p-2" required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="w-full border rounded-lg p-2" required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Tujuan</label>
            <input type="text" name="tujuan" class="w-full border rounded-lg p-2" required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Perihal</label>
            <input type="text" name="perihal" class="w-full border rounded-lg p-2" required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">File Surat</label>
            <input type="file" name="file_surat" class="w-full border rounded-lg p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
    </form>
</div>
@endsection
