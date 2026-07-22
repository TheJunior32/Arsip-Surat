<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Masuk</title>
</head>
<body>
    <h2>Detail Surat Masuk</h2>

    <p>ID: {{ $surat->id }}</p>
    <p>Nomor Surat: {{ $surat->nomor_surat }}</p>
    <p>Pengirim: {{ $surat->pengirim }}</p>
    <p>Perihal: {{ $surat->perihal }}</p>
    <p>Tanggal: {{ $surat->tanggal_surat }}</p>
</body>
</html>
