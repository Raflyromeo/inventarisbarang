@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="welcome-banner mb-4">
    <div class="row align-items-center position-relative" style="z-index: 1;">
        <div class="col-md-8">
            <h3 class="mb-2">Selamat datang, {{ Auth::user()->name ?? 'Admin PUSTEKINFO' }}!</h3>
            <p class="mb-0"><i class="bi bi-shield-check me-1"></i> Administrator Sistem Inventaris Barang IT DPR RI</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 70px; height: 70px;">
                <i class="bi bi-pc-display fs-1"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card h-100 mb-0 shadow-sm border-0 stat-blue">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-boxes"></i>
                </div>
                <div class="stat-details">
                    <h6>TOTAL BARANG</h6>
                    <h3>{{ $totalBarang }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card h-100 mb-0 shadow-sm border-0 stat-green">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-details">
                    <h6>KONDISI BAIK</h6>
                    <h3>{{ $barangBaik }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
        <div class="card h-100 mb-0 shadow-sm border-0 stat-gold">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div class="stat-details">
                    <h6>DIPINJAM</h6>
                    <h3>{{ $barangDipinjam }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100 mb-0 shadow-sm border-0 stat-red">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-wrench"></i>
                </div>
                <div class="stat-details">
                    <h6>RUSAK</h6>
                    <h3>{{ $barangRusak }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Items Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
        <h6 class="m-0 fw-bold" style="color: var(--dpr-blue)"><i class="bi bi-clock-history me-2"></i> Barang Masuk Terbaru</h6>
        <a href="{{ route('inventaris.index') }}" class="text-decoration-none text-muted small hover-primary">Lihat semua <i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                <thead class="text-muted bg-light" style="font-size: 0.8rem; text-transform:uppercase; letter-spacing:0.5px;">
                    <tr>
                        <th class="px-4 py-3 font-weight-normal border-0">NAMA BARANG & KODE</th>
                        <th class="py-3 font-weight-normal border-0">KATEGORI</th>
                        <th class="py-3 font-weight-normal border-0 text-center">JUMLAH</th>
                        <th class="py-3 font-weight-normal border-0 text-center">KONDISI</th>
                        <th class="px-4 py-3 font-weight-normal border-0 text-end">STATUS</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($barangTerbaru as $item)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold text-dark">{{ $item->nama_barang }}</div>
                            <small class="text-muted">{{ $item->kode_barang }}</small>
                        </td>
                        <td class="py-3">{{ $item->kategori }}</td>
                        <td class="py-3 text-center fw-semibold">{{ $item->jumlah }}</td>
                        <td class="py-3 text-center">
                            @if($item->kondisi == 'Baik')
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 border border-success border-opacity-25 rounded-pill">Baik</span>
                            @elseif($item->kondisi == 'Dipinjam')
                                <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 border border-warning border-opacity-25 rounded-pill text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 border border-danger border-opacity-25 rounded-pill">Rusak</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end text-success small fw-semibold">
                            <i class="bi bi-check-lg me-1"></i> Tercatat
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-black-50"></i>
                            Belum ada data barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
