@extends('layouts.app')

@section('content')

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

    /* Main content */
    .main-content {
        margin-left: 260px;
        padding: 20px;
        position: relative;
        background: var(--pln-gray);
        min-height: 100vh;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .sidebar {
            position: absolute;
            transform: translateX(-100%);
            transition: 0.3s ease;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0 !important;
        }
    }

    /* Navbar adjustments */
    nav.navbar {
        z-index: 1030;
        height: 70px;
        background: #fff;
        border-bottom: 3px solid var(--pln-yellow);
    }

    @media (min-width: 769px) {
        nav.navbar {
            left: 260px;
            width: calc(100% - 260px);
        }
    }

    .btn-toggle-pln {
        background: var(--pln-blue);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-toggle-pln:hover {
        background: var(--pln-dark-blue);
        transform: scale(1.05);
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

    /* Blue section background */
    .bg-blue-section {
        background: linear-gradient(135deg, var(--pln-blue) 0%, var(--pln-light-blue) 100%);
        height: 280px;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1;
        border-radius: 0 0 30px 30px;
    }

    /* Cards to overlap the blue section */
    .stat-cards {
        position: relative;
        z-index: 2;
        margin-top: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 113, 188, 0.2);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--pln-blue), var(--pln-yellow));
    }

    .stat-card .card-body {
        padding: 30px;
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-light-blue));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Activity Card */
    .activity-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .activity-card .card-header {
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-light-blue));
        color: white;
        padding: 20px 30px;
        border: none;
    }

    .activity-card .card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    /* Table Styling */
    .table thead {
        background: var(--pln-gray);
    }

    .table thead th {
        color: var(--pln-dark-blue);
        font-weight: 700;
        border: none;
        padding: 15px 20px;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: rgba(0, 113, 188, 0.05);
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 15px 20px;
        vertical-align: middle;
    }

    /* Buttons */
    .btn-pln-primary {
        background: var(--pln-blue);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-pln-primary:hover {
        background: var(--pln-dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 113, 188, 0.3);
    }

    .btn-pln-info {
        background: var(--pln-light-blue);
        color: white;
        border: none;
    }

    .btn-pln-info:hover {
        background: var(--pln-blue);
    }

    .btn-pln-warning {
        background: var(--pln-yellow);
        color: var(--pln-dark-blue);
        border: none;
        font-weight: 700;
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
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover {
        background: var(--pln-dark-blue);
        border-color: var(--pln-dark-blue);
    }

    /* Page Title */
    .page-title-pln {
        color: white;
        font-weight: 800;
        font-size: 2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- TOP NAVBAR -->
<nav class="navbar navbar-light bg-white shadow-sm px-3 fixed-top">
    <div class="d-flex align-items-center w-100">
        <!-- Tombol Toggle (Mobile Only) -->
        <button class="btn-toggle-pln d-md-none me-3" id="menu-toggle">
            ☰
        </button>

        <!-- Search (Desktop) -->
        <form action="{{ route('dashboard') }}" method="GET" class="d-none d-md-block flex-grow-1" style="max-width: 400px;">
            <input 
                class="form-control search-box-pln" 
                type="search" 
                name="q"
                placeholder="Cari surat..."
                value="{{ request('q') }}"
            />
        </form>

        <!-- Avatar + Dropdown Menu -->
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

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4>
            <div class="pln-icon">⚡</div>
            <span>Arsip Surat</span>
        </h4>
    </div>
    <a href="{{ route('dashboard') }}" class="active"> Dashboard</a>
    <a href="{{ route('surat-masuk.index') }}"> Surat Masuk</a>
    <a href="{{ route('surat-keluar.index') }}"> Surat Keluar</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid mt-4">
        <h3 class="page-title-pln mb-4">Dashboard Arsip Surat</h3>

        <!-- Blue section background -->
        <div class="bg-blue-section"></div>

        <!-- STAT CARDS -->
        <div class="row justify-content-center g-4 stat-cards">
            <div class="col-lg-5 col-md-6">
                <a href="{{ route('surat-masuk.index') }}" class="text-decoration-none">
                    <div class="card stat-card" style="height: 220px;">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h6 class="text-muted mb-2 fw-bold text-uppercase" style="font-size: 0.9rem;">Surat Masuk</h6>
                            <h1 class="stat-number">{{ $totalSuratMasuk }}</h1>
                            <small class="text-muted fw-semibold">Total Surat Masuk</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-5 col-md-6">
                <a href="{{ route('surat-keluar.index') }}" class="text-decoration-none">
                    <div class="card stat-card" style="height: 220px;">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h6 class="text-muted mb-2 fw-bold text-uppercase" style="font-size: 0.9rem;">Surat Keluar</h6>
                            <h1 class="stat-number">{{ $totalSuratKeluar }}</h1>
                            <small class="text-muted fw-semibold">Total Surat Keluar</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- AKTIVITAS TERBARU -->
        <div class="card activity-card mt-5">
            <div class="card-header">
                <h5>⚡ Aktivitas Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Nomor Surat</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>
                                <th>Tanggal</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent as $item)
                                <tr>
                                    <td class="ps-4"><strong>{{ $item->nomor_surat }}</strong></td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        @if($item->file)
                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-sm btn-pln-primary">
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->jenis == 'Masuk')
                                            <a href="{{ route('surat-masuk.show', $item->id) }}" 
                                            class="btn btn-sm btn-pln-info">Detail</a>

                                            <a href="{{ route('surat-masuk.pdf', $item->id) }}" 
                                            class="btn btn-sm btn-pln-warning">PDF</a>

                                            <form action="{{ route('surat-masuk.destroy', $item->id) }}" 
                                                method="POST" 
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin ingin menghapus?')" 
                                                        class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <em>Belum ada aktivitas terbaru</em>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Toggle sidebar
    const toggleBtn = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("show");
    });
</script>

@endsection