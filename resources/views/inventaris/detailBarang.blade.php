@extends('layouts.app')

@section('title', 'Detail Barang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inventaris.index') }}">Data Barang IT</a></li>
    <li class="breadcrumb-item active">{{ $barang->nama_barang }}</li>
@endsection

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h1 class="page-header-title">
            <i class="bi bi-info-square-fill me-2" style="color:var(--dpr-blue);"></i>
            Detail Barang
        </h1>
        <p class="page-header-sub">Informasi lengkap inventaris: <strong>{{ $barang->nama_barang }}</strong></p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('inventaris.index') }}" class="btn"
           style="background:#f1f5f9; color:#475569; border-radius:10px; font-weight:600; padding:0.55rem 1.25rem; font-size:0.875rem; text-decoration:none;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('inventaris.edit', $barang->id) }}" class="btn"
           style="background:#fef3c7; color:#92400e; border-radius:10px; font-weight:600; padding:0.55rem 1.25rem; font-size:0.875rem; text-decoration:none;">
            <i class="bi bi-pencil-fill me-1"></i> Ubah Data
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Left Column: Foto & File --}}
    <div class="col-md-4">
        {{-- Foto Card --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white py-3" style="border-radius:16px 16px 0 0; border-bottom:1px solid #f1f5f9;">
                <h6 class="fw-bold mb-0" style="font-size:0.875rem; color:#374151;">
                    <i class="bi bi-image me-2" style="color:#3b82f6;"></i>Foto Barang
                </h6>
            </div>
            <div class="card-body text-center p-3"
                 style="background:#f8fafc; border-radius:0 0 16px 16px; min-height:200px; display:flex; align-items:center; justify-content:center;">
                @if($barang->foto)
                    <img src="{{ route('inventaris.foto', $barang->id) }}"
                         class="img-fluid rounded-3 shadow-sm"
                         alt="{{ $barang->nama_barang }}"
                         style="max-height:250px; object-fit:contain; cursor:zoom-in;"
                         onclick="this.requestFullscreen ? this.requestFullscreen() : null"
                         title="Klik untuk fullscreen">
                @else
                    <div class="text-center py-4" style="color:#cbd5e1;">
                        <i class="bi bi-image" style="font-size:3rem; display:block; margin-bottom:0.75rem;"></i>
                        <small style="color:#9ca3af;">Tidak ada foto</small>
                    </div>
                @endif
            </div>
        </div>

        {{-- File Manual Card --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3" style="font-size:0.875rem; color:#374151;">
                    <i class="bi bi-file-earmark-pdf-fill me-2" style="color:#ef4444;"></i>File Manual
                </h6>
                @if($barang->file_manual)
                    <a href="{{ route('inventaris.manual', $barang->id) }}" target="_blank"
                       class="btn w-100"
                       style="background:rgba(239,68,68,0.08); color:#dc2626; border:1.5px solid rgba(239,68,68,0.2); border-radius:10px; font-weight:600; font-size:0.875rem; padding:0.75rem; text-decoration:none;">
                        <i class="bi bi-file-earmark-pdf me-2"></i>
                        Buka File PDF
                        <i class="bi bi-box-arrow-up-right ms-2" style="font-size:0.75rem;"></i>
                    </a>
                    <small class="d-block text-center mt-2" style="color:#9ca3af; font-size:0.75rem;">
                        <i class="bi bi-shield-check me-1" style="color:#10b981;"></i>
                        File terenkripsi dan dilindungi
                    </small>
                @else
                    <div class="text-center py-3" style="color:#9ca3af; font-size:0.875rem;">
                        <i class="bi bi-file-earmark-x" style="font-size:2rem; display:block; margin-bottom:0.5rem; color:#cbd5e1;"></i>
                        Tidak ada file manual
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Right Column: Info Barang --}}
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between" style="border-radius:16px 16px 0 0; border-bottom:1px solid #f1f5f9;">
                <h6 class="fw-bold mb-0" style="font-size:0.875rem; color:#374151;">
                    <i class="bi bi-clipboard-data me-2" style="color:var(--dpr-blue);"></i>Informasi Barang
                </h6>
                <span class="badge" style="background:#f1f5f9; color:#64748b; font-family:monospace; font-size:0.8rem; border-radius:8px; padding:0.35rem 0.75rem;">
                    {{ $barang->kode_barang }}
                </span>
            </div>
            <div class="card-body p-0">
                <div class="p-4">
                    {{-- Nama & Merk --}}
                    <div class="mb-4 pb-4" style="border-bottom:1px solid #f1f5f9;">
                        <h4 style="font-family:'Plus Jakarta Sans', sans-serif; font-weight:800; color:#0f172a; margin-bottom:0.25rem;">
                            {{ $barang->nama_barang }}
                        </h4>
                        <span style="color:#64748b; font-size:0.9rem;">{{ $barang->merk }}</span>
                    </div>

                    {{-- Info Grid --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Kategori</div>
                                <div style="font-weight:600; color:#1e293b;">{{ $barang->kategori }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Nomor Seri</div>
                                <div style="font-weight:600; color:#1e293b; font-family:monospace; font-size:0.95rem;">{{ $barang->nomor_seri }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Kondisi</div>
                                @if($barang->kondisi == 'Baik')
                                    <span class="badge" style="background:rgba(16,185,129,0.12); color:#059669; border:1px solid rgba(16,185,129,0.25); border-radius:20px; padding:0.3rem 0.8rem; font-size:0.8rem; font-weight:600;">
                                        <i class="bi bi-check-circle-fill me-1" style="font-size:0.65rem;"></i>Baik
                                    </span>
                                @elseif($barang->kondisi == 'Dipinjam')
                                    <span class="badge" style="background:rgba(245,158,11,0.12); color:#d97706; border:1px solid rgba(245,158,11,0.25); border-radius:20px; padding:0.3rem 0.8rem; font-size:0.8rem; font-weight:600;">
                                        <i class="bi bi-arrow-left-right me-1" style="font-size:0.65rem;"></i>Dipinjam
                                    </span>
                                @else
                                    <span class="badge" style="background:rgba(239,68,68,0.12); color:#dc2626; border:1px solid rgba(239,68,68,0.25); border-radius:20px; padding:0.3rem 0.8rem; font-size:0.8rem; font-weight:600;">
                                        <i class="bi bi-tools me-1" style="font-size:0.65rem;"></i>Rusak
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Jumlah Unit</div>
                                <div style="font-weight:800; color:#1e293b; font-size:1.4rem; font-family:'Plus Jakarta Sans', sans-serif; line-height:1;">
                                    {{ $barang->jumlah }}
                                    <span style="font-size:0.75rem; color:#64748b; font-weight:500; font-family:'Inter', sans-serif;">unit</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Lokasi Penyimpanan</div>
                                <div style="font-weight:600; color:#1e293b;">
                                    <i class="bi bi-geo-alt-fill me-1" style="color:#ef4444;"></i>
                                    {{ $barang->lokasi }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Tanggal Masuk</div>
                                <div style="font-weight:600; color:#1e293b;">
                                    {{ \Carbon\Carbon::parse($barang->tanggal_masuk)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background:#f8fafc;">
                                <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.35rem;">Jam Input</div>
                                <div style="font-weight:600; color:#1e293b;">
                                    <i class="bi bi-clock me-1" style="color:#3b82f6;"></i>
                                    {{ date('H:i', strtotime($barang->jam_input)) }} WIB
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    @if($barang->keterangan)
                    <div>
                        <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:0.75rem;">
                            Keterangan / Spesifikasi
                        </div>
                        <div class="p-4 rounded-3"
                             style="background:#f8fafc; border-left:3px solid var(--dpr-blue); font-size:0.875rem; color:#374151; line-height:1.8; white-space:pre-wrap; word-break:break-word;">{{ $barang->keterangan }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Meta info --}}
        <div class="mt-3 d-flex gap-2 flex-wrap">
            <small style="color:#94a3b8; background:#f8fafc; padding:0.3rem 0.75rem; border-radius:6px; font-size:0.75rem;">
                <i class="bi bi-calendar-plus me-1"></i>Ditambahkan: {{ $barang->created_at->format('d M Y, H:i') }}
            </small>
            @if($barang->updated_at != $barang->created_at)
            <small style="color:#94a3b8; background:#f8fafc; padding:0.3rem 0.75rem; border-radius:6px; font-size:0.75rem;">
                <i class="bi bi-pencil me-1"></i>Diubah: {{ $barang->updated_at->format('d M Y, H:i') }}
            </small>
            @endif
        </div>
    </div>
</div>

@endsection
