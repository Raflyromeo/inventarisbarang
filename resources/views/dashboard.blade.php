@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('content')

<style>
    /* Styling khusus Dashboard Shadcn */
    .stat-card-new {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: box-shadow 0.2s, transform 0.2s;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }
    .stat-card-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
    }
    .stat-icon-new {
        width: 48px; height: 48px;
        border-radius: var(--radius);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }
    .stat-num {
        font-size: 1.75rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 0.15rem;
        letter-spacing: -0.02em;
    }
    .stat-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--muted-foreground);
    }
    .item-thumbnail {
        width: 44px; height: 44px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid var(--border);
        background: var(--muted);
    }
    .item-thumbnail-placeholder {
        width: 44px; height: 44px;
        border-radius: 6px;
        background: var(--muted);
        display: flex; align-items: center; justify-content: center;
        color: var(--muted-foreground);
        border: 1px solid var(--border);
        font-size: 1.2rem;
    }
</style>

{{-- Page Header --}}
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h1 class="page-title mb-1">
            👋 Selamat Datang, {{ explode(' ', Auth::user()->name ?? 'Admin')[0] }}!
        </h1>
        <p class="text-muted" style="font-size: 0.875rem; margin-bottom: 0;">
            <i class="bi bi-calendar3 me-1"></i>
            {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }} &mdash; Ringkasan Inventaris
        </p>
    </div>
    <a href="{{ route('inventaris.create') }}" class="btn btn-dark" style="background: var(--foreground); color: var(--background); border-radius: var(--radius); font-weight: 500; font-size: 0.875rem;">
        <i class="bi bi-plus-circle me-1"></i> Tambah Barang
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('inventaris.index') }}" class="stat-card-new">
            <div class="stat-icon-new" style="background: #f1f5f9; color: #0f172a;">
                <i class="bi bi-boxes"></i>
            </div>
            <div>
                <div class="stat-num" style="color: var(--foreground);">{{ $totalBarang }}</div>
                <div class="stat-label">Total Barang</div>
            </div>
            <i class="bi bi-arrow-right-short ms-auto align-self-center fs-4" style="color: var(--muted-foreground);"></i>
        </a>
    </div>

    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('inventaris.index', ['kondisi' => 'Baik']) }}" class="stat-card-new">
            <div class="stat-icon-new" style="background: #ecfdf5; color: #10b981;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="stat-num" style="color: #10b981;">{{ $barangBaik }}</div>
                <div class="stat-label">Kondisi Baik</div>
            </div>
            <i class="bi bi-arrow-right-short ms-auto align-self-center fs-4" style="color: #6ee7b7;"></i>
        </a>
    </div>

    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('inventaris.index', ['kondisi' => 'Dipinjam']) }}" class="stat-card-new">
            <div class="stat-icon-new" style="background: #fffbeb; color: #f59e0b;">
                <i class="bi bi-arrow-left-right"></i>
            </div>
            <div>
                <div class="stat-num" style="color: #f59e0b;">{{ $barangDipinjam }}</div>
                <div class="stat-label">Dipinjam</div>
            </div>
            <i class="bi bi-arrow-right-short ms-auto align-self-center fs-4" style="color: #fcd34d;"></i>
        </a>
    </div>

    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('inventaris.index', ['kondisi' => 'Rusak']) }}" class="stat-card-new">
            <div class="stat-icon-new" style="background: #fef2f2; color: #ef4444;">
                <i class="bi bi-tools"></i>
            </div>
            <div>
                <div class="stat-num" style="color: #ef4444;">{{ $barangRusak }}</div>
                <div class="stat-label">Rusak</div>
            </div>
            <i class="bi bi-arrow-right-short ms-auto align-self-center fs-4" style="color: #fca5a5;"></i>
        </a>
    </div>
</div>

{{-- Trash alert if any --}}
@if($barangDihapus > 0)
<div class="alert mb-4 d-flex align-items-center gap-3 border-0 shadow-sm"
     style="background: #fffbeb; border-left: 4px solid #f59e0b !important; border-radius: var(--radius);">
    <i class="bi bi-trash3-fill text-warning fs-4"></i>
    <div class="flex-grow-1">
        <strong style="color: #92400e; font-size: 0.9rem;">{{ $barangDihapus }} data</strong>
        <span style="color: #78350f; font-size: 0.85rem;"> barang berada di Tong Sampah dan belum dihapus permanen.</span>
    </div>
    <a href="{{ route('inventaris.trash') }}" class="btn btn-sm btn-warning fw-semibold"
       style="border-radius: 6px; font-size: 0.8rem; white-space: nowrap;">
        <i class="bi bi-trash3 me-1"></i> Kelola Tong Sampah
    </a>
</div>
@endif

{{-- Progress Bar Kondisi --}}
@if($totalBarang > 0)
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-semibold mb-0" style="color: var(--foreground); font-size: 0.95rem;">Distribusi Kondisi Barang</h6>
            <span class="badge" style="background: var(--muted); color: var(--muted-foreground); font-size: 0.75rem;">{{ $totalBarang }} Total</span>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between mb-1" style="font-size: 0.8rem;">
                <span style="color: #10b981; font-weight: 500;"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Baik</span>
                <span style="color: var(--muted-foreground);">{{ $barangBaik }} ({{ $totalBarang > 0 ? round($barangBaik/$totalBarang*100) : 0 }}%)</span>
            </div>
            <div class="progress" style="height: 6px; border-radius: 6px; background: var(--muted);">
                <div class="progress-bar" style="width: {{ $totalBarang > 0 ? ($barangBaik/$totalBarang*100) : 0 }}%; background: #10b981;"></div>
            </div>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between mb-1" style="font-size: 0.8rem;">
                <span style="color: #f59e0b; font-weight: 500;"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Dipinjam</span>
                <span style="color: var(--muted-foreground);">{{ $barangDipinjam }} ({{ $totalBarang > 0 ? round($barangDipinjam/$totalBarang*100) : 0 }}%)</span>
            </div>
            <div class="progress" style="height: 6px; border-radius: 6px; background: var(--muted);">
                <div class="progress-bar" style="width: {{ $totalBarang > 0 ? ($barangDipinjam/$totalBarang*100) : 0 }}%; background: #f59e0b;"></div>
            </div>
        </div>
        <div>
            <div class="d-flex justify-content-between mb-1" style="font-size: 0.8rem;">
                <span style="color: #ef4444; font-weight: 500;"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Rusak</span>
                <span style="color: var(--muted-foreground);">{{ $barangRusak }} ({{ $totalBarang > 0 ? round($barangRusak/$totalBarang*100) : 0 }}%)</span>
            </div>
            <div class="progress" style="height: 6px; border-radius: 6px; background: var(--muted);">
                <div class="progress-bar" style="width: {{ $totalBarang > 0 ? ($barangRusak/$totalBarang*100) : 0 }}%; background: #ef4444;"></div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Recent Barang --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-semibold mb-0" style="color: var(--foreground); font-size: 0.95rem;">
                <i class="bi bi-clock-history me-2 text-muted"></i>
                Barang Masuk Terbaru
            </h6>
        </div>
        <a href="{{ route('inventaris.index') }}" class="btn btn-sm btn-light border"
           style="border-radius: 6px; font-size: 0.75rem; font-weight: 500;">
            Lihat Semua <i class="bi bi-chevron-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0" style="font-size: 0.875rem;">
                <thead style="background: var(--muted);">
                    <tr>
                        <th class="px-4 py-3 border-bottom-0" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted-foreground); font-weight: 600;">Barang</th>
                        <th class="py-3 border-bottom-0" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted-foreground); font-weight: 600;">Kategori</th>
                        <th class="py-3 border-bottom-0 text-center" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted-foreground); font-weight: 600;">Jumlah</th>
                        <th class="py-3 border-bottom-0 text-center" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted-foreground); font-weight: 600;">Kondisi</th>
                        <th class="px-4 py-3 border-bottom-0 text-end" style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted-foreground); font-weight: 600;">Tgl Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangTerbaru as $item)
                    <tr>
                        <td class="px-4 py-3 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                @if($item->foto)
                                    <img src="{{ route('inventaris.foto', $item->id) }}" alt="Foto" class="item-thumbnail shadow-sm">
                                @else
                                    <div class="item-thumbnail-placeholder shadow-sm"><i class="bi bi-image text-black-50"></i></div>
                                @endif
                                <div>
                                    <div style="font-weight: 600; color: var(--foreground);">{{ $item->nama_barang }}</div>
                                    <small style="color: var(--muted-foreground); font-family: monospace;">{{ $item->kode_barang }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 border-bottom">
                            <span class="badge" style="background: var(--muted); color: var(--muted-foreground); font-weight: 500; border-radius: 6px;">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="py-3 text-center border-bottom fw-medium">{{ $item->jumlah }}</td>
                        <td class="py-3 text-center border-bottom">
                            @if($item->kondisi == 'Baik')
                                <span class="badge text-success" style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 20px; padding: 0.25rem 0.6rem;">
                                    <i class="bi bi-check-circle-fill me-1" style="font-size: 0.6rem;"></i>Baik
                                </span>
                            @elseif($item->kondisi == 'Dipinjam')
                                <span class="badge text-warning" style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 20px; padding: 0.25rem 0.6rem;">
                                    <i class="bi bi-arrow-left-right me-1" style="font-size: 0.6rem;"></i>Dipinjam
                                </span>
                            @else
                                <span class="badge text-danger" style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 20px; padding: 0.25rem 0.6rem;">
                                    <i class="bi bi-tools me-1" style="font-size: 0.6rem;"></i>Rusak
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end border-bottom">
                            <small style="color: var(--muted-foreground);">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}</small>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 border-bottom-0">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                            <p class="text-muted mb-2">Belum ada data barang.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
