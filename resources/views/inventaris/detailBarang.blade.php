@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="mb-3">
    <a href="{{ route('inventaris.index') }}" class="text-decoration-none text-muted fw-semibold" style="transition: color 0.2s;" onmouseover="this.classList.replace('text-muted', 'text-primary')" onmouseout="this.classList.replace('text-primary', 'text-muted')">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Barang
    </a>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="fw-bold text-dpr mb-0"><i class="bi bi-info-square me-2"></i> Detail Barang</h3>
            <a href="{{ route('inventaris.edit', $barang->id) }}" class="btn btn-warning shadow-sm"><i class="bi bi-pencil-square me-1"></i> Ubah Data</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom-0 text-center">
                <h5 class="fw-bold text-muted mb-0">Preview Foto</h5>
            </div>
            <div class="card-body text-center d-flex align-items-center justify-content-center bg-light">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}" class="img-fluid rounded shadow-sm" alt="{{ $barang->nama_barang }}">
                @else
                    <div class="text-muted">
                        <i class="bi bi-image fs-1 d-block mb-2"></i>
                        Tidak ada foto
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h5 class="fw-bold text-dpr mb-0">Informasi Barang</h5>
            </div>
            <div class="card-body bg-light">
                <table class="table table-borderless table-sm mb-0">
                    <tbody>
                        <tr>
                            <td width="200" class="text-muted fw-semibold">Kode Barang</td>
                            <td>: <span class="badge bg-secondary fs-6">{{ $barang->kode_barang }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Nama Barang</td>
                            <td>: <span class="fw-bold fs-5">{{ $barang->nama_barang }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Kategori</td>
                            <td>: {{ $barang->kategori }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Merk</td>
                            <td>: {{ $barang->merk }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Nomor Seri</td>
                            <td>: <span class="text-primary font-monospace">{{ $barang->nomor_seri }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Kondisi</td>
                            <td>: 
                                @if($barang->kondisi == 'Baik')
                                    <span class="badge bg-success">Baik</span>
                                @elseif($barang->kondisi == 'Dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @else
                                    <span class="badge bg-danger">Rusak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Jumlah</td>
                            <td>: {{ $barang->jumlah }} Unit</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Lokasi Penyimpanan</td>
                            <td>: <i class="bi bi-geo-alt text-danger"></i> {{ $barang->lokasi }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Tanggal Masuk</td>
                            <td>: {{ \Carbon\Carbon::parse($barang->tanggal_masuk)->format('d F Y') }} <small class="text-muted">({{ date('H:i', strtotime($barang->jam_input)) }})</small></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">File Manual (PDF)</td>
                            <td>: 
                                @if($barang->file_manual)
                                    <a href="{{ asset('storage/' . $barang->file_manual) }}" target="_blank" class="btn btn-sm btn-danger shadow-sm"><i class="bi bi-file-earmark-pdf me-1"></i> Buka PDF</a>
                                @else
                                    <span class="text-muted fst-italic">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold align-top pt-2">Keterangan / Spesifikasi</td>
                            <td class="pt-2">: 
                                <div class="p-3 bg-white border rounded mt-1 shadow-sm text-break">
                                    {{ $barang->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
