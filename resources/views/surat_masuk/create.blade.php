<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Surat Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>📥 Tambah Surat Masuk</h2>

<form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Nomor Surat</label>
        <input type="text" name="nomor_surat" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tanggal Surat</label>
        <input type="date" name="tanggal_surat" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Pengirim</label>
        <input type="text" name="pengirim" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Perihal</label>
        <input type="text" name="perihal" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>File Surat (PDF/JPG/PNG)</label>
        <input type="file" name="file_surat" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>
