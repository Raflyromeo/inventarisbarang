@extends('layouts.app')

@section('title', 'Tong Sampah')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inventaris.index') }}">Data Barang IT</a></li>
    <li class="breadcrumb-item active">Tong Sampah</li>
@endsection

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h1 class="page-header-title">
            <i class="bi bi-trash3-fill me-2" style="color:#ef4444;"></i>Tong Sampah
        </h1>
        <p class="page-header-sub">
            Data barang yang telah dihapus. Dapat dipulihkan atau dihapus permanen.
        </p>
    </div>
    <a href="{{ route('inventaris.index') }}" class="btn"
       style="background:#f1f5f9; color:#475569; border-radius:10px; font-weight:600; padding:0.55rem 1.25rem; font-size:0.875rem; text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Barang
    </a>
</div>

{{-- Info Alert --}}
<div class="alert border-0 mb-4 d-flex align-items-start gap-3"
     style="background: rgba(14,165,233,0.08); border-left: 4px solid #0ea5e9 !important; border-radius: 12px !important;">
    <i class="bi bi-info-circle-fill mt-1" style="color:#0ea5e9; font-size:1.1rem; flex-shrink:0;"></i>
    <div>
        <strong style="color:#0c4a6e; display:block; margin-bottom:0.25rem;">Cara kerja Tong Sampah:</strong>
        <p style="color:#075985; font-size:0.875rem; margin:0;">
            Data yang dihapus dari daftar barang <em>tidak langsung hilang</em> dari database — tersimpan di sini.
            Anda dapat <strong>memulihkan</strong> data kapan saja, atau <strong>menghapus permanen</strong> jika sudah tidak diperlukan.
            Penghapusan permanen tidak dapat dibatalkan.
        </p>
    </div>
</div>

{{-- Table Card --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-radius:16px 16px 0 0;">
        <div>
            <h6 class="fw-bold mb-0" style="color:#0f172a;">
                <i class="bi bi-archive me-2" style="color:#ef4444;"></i>
                Data Terhapus
            </h6>
            <small class="text-muted">{{ $barangDihapus->total() }} item di tong sampah</small>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size:0.875rem;">
                <thead style="background:#fef2f2;">
                    <tr>
                        <th class="px-4 py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#b91c1c; font-weight:700; border-bottom:2px solid #fecaca;">Barang</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#b91c1c; font-weight:700; border-bottom:2px solid #fecaca;">Kategori</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#b91c1c; font-weight:700; border-bottom:2px solid #fecaca;">Kondisi</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#b91c1c; font-weight:700; border-bottom:2px solid #fecaca;">Lokasi</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#b91c1c; font-weight:700; border-bottom:2px solid #fecaca;">Dihapus Pada</th>
                        <th class="px-4 py-3 text-center" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#b91c1c; font-weight:700; border-bottom:2px solid #fecaca; width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangDihapus as $item)
                    <tr style="border-bottom:1px solid #fef2f2;">
                        <td class="px-4 py-3">
                            <div style="font-weight:600; color:#374151;">{{ $item->nama_barang }}</div>
                            <div style="display:flex; gap:0.5rem; align-items:center; margin-top:2px;">
                                <span style="font-family:monospace; font-size:0.7rem; color:#9ca3af; background:#f3f4f6; padding:1px 6px; border-radius:4px;">{{ $item->kode_barang }}</span>
                                <span style="font-size:0.7rem; color:#9ca3af;">{{ $item->merk }}</span>
                            </div>
                        </td>
                        <td>
                            <span style="font-size:0.8rem; color:#6b7280;">{{ $item->kategori }}</span>
                        </td>
                        <td>
                            @if($item->kondisi == 'Baik')
                                <span class="badge" style="background:rgba(16,185,129,0.1); color:#059669; border-radius:20px; padding:0.25rem 0.7rem; font-size:0.75rem;">Baik</span>
                            @elseif($item->kondisi == 'Dipinjam')
                                <span class="badge" style="background:rgba(245,158,11,0.1); color:#d97706; border-radius:20px; padding:0.25rem 0.7rem; font-size:0.75rem;">Dipinjam</span>
                            @else
                                <span class="badge" style="background:rgba(239,68,68,0.1); color:#dc2626; border-radius:20px; padding:0.25rem 0.7rem; font-size:0.75rem;">Rusak</span>
                            @endif
                        </td>
                        <td>
                            <small style="color:#9ca3af;"><i class="bi bi-geo-alt-fill me-1" style="color:#ef4444; font-size:0.6rem;"></i>{{ Str::limit($item->lokasi, 25) }}</small>
                        </td>
                        <td>
                            <div style="font-size:0.8rem; color:#6b7280;">
                                {{ \Carbon\Carbon::parse($item->deleted_at)->format('d M Y') }}
                            </div>
                            <small style="color:#9ca3af;">{{ \Carbon\Carbon::parse($item->deleted_at)->diffForHumans() }}</small>
                        </td>
                        <td class="px-4 text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                {{-- Restore Button --}}
                                <form action="{{ route('inventaris.restore', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm" title="Pulihkan Data"
                                            style="background:rgba(16,185,129,0.12); color:#059669; border-radius:8px;
                                                   font-size:0.775rem; font-weight:600; padding:0.4rem 0.75rem; border:none;"
                                            onclick="return confirm('Pulihkan data {{ addslashes($item->nama_barang) }}?')">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i>Pulihkan
                                    </button>
                                </form>
                                {{-- Force Delete Button --}}
                                <button type="button" class="btn btn-sm" title="Hapus Permanen"
                                        onclick="confirmForceDelete({{ $item->id }}, '{{ addslashes($item->nama_barang) }}')"
                                        style="background:rgba(239,68,68,0.1); color:#dc2626; border-radius:8px;
                                               font-size:0.775rem; font-weight:600; padding:0.4rem 0.75rem; border:none;">
                                    <i class="bi bi-trash3-fill me-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div style="color:#d1fae5; font-size:3rem; margin-bottom:0.75rem;">
                                <i class="bi bi-check-circle-fill" style="color:#10b981;"></i>
                            </div>
                            <p style="color:#065f46; font-weight:600; margin-bottom:0.25rem;">Tong Sampah Kosong!</p>
                            <p style="color:#6b7280; font-size:0.875rem; margin-bottom:1rem;">Tidak ada data barang yang dihapus.</p>
                            <a href="{{ route('inventaris.index') }}" class="btn btn-sm"
                               style="background:var(--dpr-blue); color:white; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                                <i class="bi bi-box-seam me-1"></i> Lihat Data Barang
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($barangDihapus->hasPages())
    <div class="card-footer bg-white py-3" style="border-radius:0 0 16px 16px; border-top:1px solid #f1f5f9;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <small style="color:#64748b; font-size:0.8rem;">
                Halaman <strong>{{ $barangDihapus->currentPage() }}</strong> dari <strong>{{ $barangDihapus->lastPage() }}</strong>
            </small>
            <div class="d-flex align-items-center gap-1">
                @if($barangDihapus->onFirstPage())
                    <span class="btn btn-sm disabled" style="background:#f1f5f9; color:#cbd5e1; border-radius:8px; font-size:0.8rem;">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $barangDihapus->previousPageUrl() }}" class="btn btn-sm"
                       style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                @endif

                @foreach($barangDihapus->getUrlRange(max(1, $barangDihapus->currentPage()-2), min($barangDihapus->lastPage(), $barangDihapus->currentPage()+2)) as $page => $url)
                    @if($page == $barangDihapus->currentPage())
                        <span class="btn btn-sm" style="background:#ef4444; color:white; border-radius:8px; font-size:0.8rem; font-weight:700; min-width:32px;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="btn btn-sm"
                           style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none; min-width:32px;">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($barangDihapus->hasMorePages())
                    <a href="{{ $barangDihapus->nextPageUrl() }}" class="btn btn-sm"
                       style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                @else
                    <span class="btn btn-sm disabled" style="background:#f1f5f9; color:#cbd5e1; border-radius:8px; font-size:0.8rem;">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Force Delete Modal --}}
<div class="modal fade" id="forceDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius:20px; overflow:hidden;">
            <div class="modal-body p-0">
                <div class="text-center p-4" style="background:linear-gradient(135deg, #fff1f2, #fff7f7);">
                    <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:72px; height:72px; background:rgba(239,68,68,0.15); border-radius:50%; font-size:2rem; color:#dc2626;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h5 style="font-weight:700; color:#0f172a; margin-bottom:0.5rem;">Hapus Permanen?</h5>
                    <p style="color:#64748b; font-size:0.875rem; margin-bottom:0;">
                        Data <strong id="forceDeleteItemName" style="color:#dc2626;"></strong> akan <strong>dihapus permanen</strong> dari database
                        beserta semua file terkait.<br>
                        <span style="color:#dc2626; font-size:0.8rem; font-weight:600;">
                            <i class="bi bi-exclamation-circle me-1"></i>Tindakan ini tidak dapat dibatalkan!
                        </span>
                    </p>
                </div>
                <div class="d-flex gap-2 p-4 pt-3">
                    <button type="button" class="btn flex-fill" data-bs-dismiss="modal"
                            style="background:#f1f5f9; color:#475569; border-radius:10px; font-weight:600;">
                        Batal
                    </button>
                    <form id="forceDeleteForm" method="POST" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-100"
                                style="background:#dc2626; color:white; border-radius:10px; font-weight:700;">
                            <i class="bi bi-trash3-fill me-1"></i>Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function confirmForceDelete(id, name) {
        document.getElementById('forceDeleteItemName').textContent = name;
        document.getElementById('forceDeleteForm').action = `/inventaris-trash/${id}/force-delete`;
        new bootstrap.Modal(document.getElementById('forceDeleteModal')).show();
    }
</script>
@endsection
