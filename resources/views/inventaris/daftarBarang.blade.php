@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-dpr"><i class="bi bi-box-seam me-2"></i> Daftar Barang IT</h3>
        <p class="text-muted mb-0">Kelola semua inventaris barang IT DPR RI.</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="{{ route('inventaris.create') }}" class="btn btn-primary bg-dpr border-0 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Barang
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body bg-light">
        <form action="{{ route('inventaris.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="cari" class="form-label fw-semibold">Pencarian</label>
                <input type="text" class="form-control" id="cari" name="cari" value="{{ request('cari') }}" placeholder="Cari nama atau kode barang...">
            </div>
            <div class="col-md-3">
                <label for="kategori" class="form-label fw-semibold">Kategori</label>
                <select id="kategori" name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <option value="Laptop" {{ request('kategori') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="Komputer" {{ request('kategori') == 'Komputer' ? 'selected' : '' }}>Komputer</option>
                    <option value="Monitor" {{ request('kategori') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                    <option value="Printer" {{ request('kategori') == 'Printer' ? 'selected' : '' }}>Printer</option>
                    <option value="Scanner" {{ request('kategori') == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                    <option value="Router" {{ request('kategori') == 'Router' ? 'selected' : '' }}>Router</option>
                    <option value="Switch" {{ request('kategori') == 'Switch' ? 'selected' : '' }}>Switch</option>
                    <option value="Access Point" {{ request('kategori') == 'Access Point' ? 'selected' : '' }}>Access Point</option>
                    <option value="Server" {{ request('kategori') == 'Server' ? 'selected' : '' }}>Server</option>
                    <option value="Proyektor" {{ request('kategori') == 'Proyektor' ? 'selected' : '' }}>Proyektor</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="kondisi" class="form-label fw-semibold">Kondisi</label>
                <select id="kondisi" name="kondisi" class="form-select">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Dipinjam" {{ request('kondisi') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100 shadow-sm"><i class="bi bi-search me-1"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" width="60">Foto</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Kondisi</th>
                        <th>Tgl Masuk</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $item)
                    <tr>
                        <td class="text-center py-2">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;" alt="{{ $item->nama_barang }}">
                            @else
                                <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center mx-auto text-secondary" style="width: 45px; height: 45px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td><span class="badge bg-secondary">{{ $item->kode_barang }}</span></td>
                        <td class="fw-bold">{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td><small><i class="bi bi-geo-alt text-danger"></i> {{ $item->lokasi }}</small></td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-center">
                            @if($item->kondisi == 'Baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($item->kondisi == 'Dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-danger">Rusak</span>
                            @endif
                        </td>
                        <td><small>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</small></td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm" role="group">
                                <a href="{{ route('inventaris.show', $item->id) }}" class="btn btn-sm btn-info text-white" title="Detail"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('inventaris.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Ubah"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            
                            <!-- Delete Modal -->
                            <div class="modal fade text-start" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i> Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus <strong>{{ $item->nama_barang }}</strong> ({{ $item->kode_barang }})? Data yang sudah dihapus tidak dapat dikembalikan.
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Batal</button>
                                            <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i> Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            Tidak ada data barang yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($barang->hasPages())
    <div class="card-footer bg-white pt-3">
        {{ $barang->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
