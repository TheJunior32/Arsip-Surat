<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Surat Masuk - PLN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* PLN Color Palette */
        :root {
            --pln-blue: #0071BC;
            --pln-dark-blue: #004D8C;
            --pln-light-blue: #00A3E0;
            --pln-yellow: #FFD100;
            --pln-dark: #1A1A1A;
            --pln-gray: #F5F5F5;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--pln-dark-blue) 0%, var(--pln-blue) 100%);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 0;
            z-index: 1020;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            background: var(--pln-dark-blue);
            padding: 25px 20px;
            border-bottom: 3px solid var(--pln-yellow);
        }

        .sidebar-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header .pln-icon {
            width: 35px;
            height: 35px;
            background: var(--pln-yellow);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: var(--pln-dark-blue);
            font-size: 1.2rem;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.9);
            padding: 15px 25px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--pln-yellow);
            padding-left: 30px;
        }

        .sidebar a.active {
            background: rgba(255, 209, 0, 0.15);
            border-left-color: var(--pln-yellow);
            color: var(--pln-yellow);
        }

        /* Navbar */
        nav.navbar {
            z-index: 1030;
            height: 70px;
            position: fixed;
            top: 0;
            left: 260px;
            width: calc(100% - 260px);
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0 1.5rem;
            border-bottom: 3px solid var(--pln-yellow);
        }

        .search-box-pln {
            border: 2px solid var(--pln-light-blue);
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .search-box-pln:focus {
            border-color: var(--pln-blue);
            box-shadow: 0 0 0 3px rgba(0, 113, 188, 0.1);
        }

        .btn-reset-pln {
            background: var(--pln-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-reset-pln:hover {
            background: var(--pln-dark-blue);
        }

        /* Main content */
        main.main-content {
            margin-left: 260px;
            padding: 90px 30px 30px 30px;
            background-color: var(--pln-gray);
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 2rem;
            padding: 25px;
            background: linear-gradient(135deg, var(--pln-blue) 0%, var(--pln-light-blue) 100%);
            border-radius: 15px;
            color: white;
            box-shadow: 0 5px 20px rgba(0, 113, 188, 0.2);
        }

        .page-header h2 {
            color: white;
            font-weight: 800;
            margin: 0;
            font-size: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Card */
        .card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: none;
            background-color: white;
            overflow: hidden;
        }

        .card-body {
            padding: 2rem;
        }

        .form-card-header {
            background: linear-gradient(135deg, var(--pln-blue), var(--pln-light-blue));
            color: white;
            padding: 20px 30px;
            margin: -2rem -2rem 2rem -2rem;
            border-radius: 15px 15px 0 0;
        }

        .form-card-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
        }

        /* Form Styling */
        .form-label {
            color: var(--pln-dark-blue);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--pln-blue);
            box-shadow: 0 0 0 3px rgba(0, 113, 188, 0.1);
        }

        /* Table */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        thead.table-light {
            background: linear-gradient(135deg, var(--pln-blue), var(--pln-light-blue));
        }

        thead.table-light th {
            color: white !important;
            font-weight: 700;
            border: none;
            padding: 15px 20px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 113, 188, 0.05);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Buttons */
        .btn-pln-primary {
            background: var(--pln-blue);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-pln-primary:hover {
            background: var(--pln-dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 113, 188, 0.3);
        }

        .btn-outline-pln {
            color: var(--pln-blue);
            border: 2px solid var(--pln-blue);
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-pln:hover {
            background: var(--pln-blue);
            color: white;
        }

        .btn-pln-warning {
            background: var(--pln-yellow);
            color: var(--pln-dark-blue);
            border: none;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-pln-warning:hover {
            background: #E6BC00;
            transform: translateY(-2px);
        }

        .dropdown-toggle {
            background: var(--pln-blue);
            color: white;
            border: 2px solid var(--pln-blue);
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
        }

        .dropdown-toggle:hover {
            background: var(--pln-dark-blue);
            border-color: var(--pln-dark-blue);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            nav.navbar {
                left: 0;
                width: 100%;
            }
            main.main-content {
                margin-left: 0;
                padding-top: 100px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>
                <div class="pln-icon">⚡</div>
                <span>Arsip Surat</span>
            </h4>
        </div>
        <a href="{{ route('dashboard') }}"> Dashboard</a>
        <a href="{{ route('surat-masuk.index') }}" class="active"> Surat Masuk</a>
        <a href="{{ route('surat-keluar.index') }}"> Surat Keluar</a>
    </aside>

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-light shadow-sm">
        <div class="d-flex align-items-center w-100">
            <!-- Toggle sidebar button for mobile -->
            <button class="btn btn-pln-primary d-md-none me-3" id="menu-toggle">☰</button>

            <!-- Search box -->
            <form action="{{ route('surat-masuk.index') }}" method="GET" class="d-flex flex-grow-1" style="max-width: 450px;">
                <input type="search"
                    name="search"
                    placeholder="Cari surat masuk..."
                    class="form-control search-box-pln"
                    value="{{ request('search') }}">

                @if(request('search'))
                    <a href="{{ route('surat-masuk.index') }}" class="btn btn-reset-pln ms-2">
                        Reset
                    </a>
                @endif
            </form>

            <!-- User dropdown -->
            <div class="dropdown ms-auto">
                <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <div class="page-header">
            <h2> Surat Masuk</h2>
        </div>

        <!-- FORM TAMBAH SURAT -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-card-header">
                    <h5> Tambah Surat Masuk Baru</h5>
                </div>

                <form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control" required placeholder="Contoh: 001/SM/2024">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Pengirim</label>
                            <input type="text" name="pengirim" class="form-control" required placeholder="Nama pengirim">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Perihal</label>
                            <input type="text" name="perihal" class="form-control" required placeholder="Perihal surat">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">File Surat (PDF/JPG)</label>
                            <input type="file" name="file_surat" class="form-control">

                            @if ($errors->has('file_surat'))
                             <div class="text-danger small mt-1">
                                 {{ $errors->first('file_surat') }}
                             </div>
                            @endif
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-pln-primary w-100">
                                 Simpan Surat
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  

        <!-- TABLE SURAT MASUK -->
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover mb-0">
                    <thead class="form-card-header">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nomor Surat</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Tanggal</th>
                            <th>File</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($suratMasuk as $i => $surat)
                        <tr>
                            <td class="ps-4"><strong>{{ $i + 1 }}</strong></td>
                            <td><strong>{{ $surat->nomor_surat }}</strong></td>
                            <td>{{ $surat->pengirim }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                            <td>
                                @if($surat->file_surat)
                                    <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank" class="btn btn-sm btn-outline-pln"> Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ asset('storage/' . $surat->file_surat) }}" 
                                   target="_blank" 
                                   class="btn btn-pln-warning btn-sm me-1">
                                    PDF
                                </a>

                                <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus surat ini?')"> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted fst-italic">
                                Belum ada surat masuk.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle on mobile
        const toggleBtn = document.getElementById("menu-toggle");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener('click', ()=> {
            sidebar.classList.toggle('show');
        });

        document.getElementById('file_surat').addEventListener('change', function () {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB

            if (file && file.size > maxSize) {
                alert('Ukuran file terlalu besar! Maksimal 2 MB.');
                this.value = "";
            }
        });
    </script>

</body>
</html>