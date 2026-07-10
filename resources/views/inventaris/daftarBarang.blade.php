@extends('layouts.app')

@section('title', 'Data Barang IT')

@section('breadcrumb')
    <li class="breadcrumb-item active">Data Barang IT</li>
@endsection

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h1 class="page-header-title"><i class="bi bi-box-seam-fill me-2" style="color:var(--dpr-blue);"></i>Data Barang IT</h1>
        <p class="page-header-sub">Kelola dan pantau seluruh inventaris perangkat IT PUSTEKINFO DPR RI.</p>
    </div>
    <a href="{{ route('inventaris.create') }}" class="btn"
       style="background: var(--dpr-blue); color:white; border-radius:10px; font-weight:600; padding:0.55rem 1.25rem; font-size:0.875rem;">
        <i class="bi bi-plus-circle me-1"></i> Tambah Barang
    </a>
</div>

{{-- Filter Card --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form action="{{ route('inventaris.index') }}" method="GET" id="filterForm">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="cari" class="form-label fw-semibold mb-1" style="font-size:0.825rem; color:#475569;">
                        <i class="bi bi-search me-1"></i>Cari Barang
                    </label>
                    <div class="position-relative">
                        <input type="text" class="form-control" id="cari" name="cari"
                               value="{{ request('cari') }}"
                               placeholder="Ketik nama, kode, merk barang..."
                               autocomplete="off"
                               style="border-radius:10px; font-size:0.875rem; padding-right:2.5rem;">
                        <div id="autocompleteDropdown"
                             class="position-absolute w-100 bg-white shadow border-0 rounded-3 d-none"
                             style="top:calc(100% + 4px); z-index:1000; max-height:280px; overflow-y:auto; border:1px solid #e2e8f0 !important;">
                        </div>
                        <div id="autocompleteLoading"
                             class="position-absolute d-none"
                             style="right:10px; top:50%; transform:translateY(-50%);">
                            <div class="spinner-border spinner-border-sm text-secondary" style="width:14px; height:14px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="kategori" class="form-label fw-semibold mb-1" style="font-size:0.825rem; color:#475569;">Kategori</label>
                    <select id="kategori" name="kategori" class="form-select" style="border-radius:10px; font-size:0.875rem;">
                        <option value="">Semua</option>
                        @foreach(['Laptop','Komputer','Monitor','Printer','Scanner','Router','Switch','Access Point','Server','Proyektor'] as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="kondisi" class="form-label fw-semibold mb-1" style="font-size:0.825rem; color:#475569;">Kondisi</label>
                    <select id="kondisi" name="kondisi" class="form-select" style="border-radius:10px; font-size:0.875rem;">
                        <option value="">Semua</option>
                        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Dipinjam" {{ request('kondisi') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold mb-1" style="font-size:0.825rem; color:#475569;">Per Halaman</label>
                    <select name="per_page" class="form-select" style="border-radius:10px; font-size:0.875rem;"
                            onchange="this.form.submit()">
                        @foreach([10, 25, 50] as $pp)
                        <option value="{{ $pp }}" {{ request('per_page', 10) == $pp ? 'selected' : '' }}>{{ $pp }} data</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn w-100" title="Filter"
                                style="background:var(--dpr-blue); color:white; border-radius:10px; font-size:0.875rem; padding:0.55rem;">
                            <i class="bi bi-funnel-fill"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if(request('cari') || request('kategori') || request('kondisi'))
            <div class="mt-3 pt-3 border-top d-flex align-items-center gap-2 flex-wrap">
                <small class="text-muted fw-semibold">Filter aktif:</small>
                @if(request('cari'))
                    <span class="badge" style="background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; border-radius:6px; font-weight:500;">
                        Cari: "{{ request('cari') }}"
                    </span>
                @endif
                @if(request('kategori'))
                    <span class="badge" style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; border-radius:6px; font-weight:500;">
                        Kategori: {{ request('kategori') }}
                    </span>
                @endif
                @if(request('kondisi'))
                    <span class="badge" style="background:#fefce8; color:#854d0e; border:1px solid #fde68a; border-radius:6px; font-weight:500;">
                        Kondisi: {{ request('kondisi') }}
                    </span>
                @endif
                <a href="{{ route('inventaris.index') }}" class="btn btn-sm"
                   style="background:#fee2e2; color:#dc2626; border-radius:6px; font-size:0.75rem; font-weight:600; padding:0.25rem 0.75rem; text-decoration:none;">
                    <i class="bi bi-x-circle me-1"></i>Hapus Filter
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

{{-- Table Card --}}
<div class="card border-0 shadow-sm">
    {{-- Table Header Info --}}
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-radius:16px 16px 0 0; border-bottom:1px solid #f1f5f9;">
        <div>
            <span style="font-size:0.825rem; color:#64748b;">
                Menampilkan <strong style="color:#0f172a;">{{ $barang->firstItem() ?? 0 }}</strong>–<strong style="color:#0f172a;">{{ $barang->lastItem() ?? 0 }}</strong>
                dari <strong style="color:#0f172a;">{{ $barang->total() }}</strong> data
            </span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('inventaris.trash') }}" class="btn btn-sm"
               style="background:#fef3c7; color:#92400e; border-radius:8px; font-size:0.775rem; font-weight:600; text-decoration:none;">
                <i class="bi bi-trash3 me-1"></i>Tong Sampah
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size:0.875rem;">
                <thead style="background:#f8fafc;">
                    <tr>
                        <th class="px-3 py-3 text-center" style="width:60px; font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Foto</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Kode</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Nama Barang</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Kategori</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Lokasi</th>
                        <th class="py-3 text-center" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Jml</th>
                        <th class="py-3 text-center" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Kondisi</th>
                        <th class="py-3" style="font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Tgl Masuk</th>
                        <th class="px-3 py-3 text-center" style="width:130px; font-size:0.7rem; text-transform:uppercase; letter-spacing:1px; color:#64748b; font-weight:700; border-bottom:2px solid #e2e8f0;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $item)
                    <tr style="border-bottom:1px solid #f8fafc; transition:background 0.15s;">
                        <td class="px-3 py-2 text-center">
                            @if($item->foto)
                                <img src="{{ route('inventaris.foto', $item->id) }}"
                                     class="rounded-3 shadow-sm"
                                     style="width:44px; height:44px; object-fit:cover; cursor:pointer;"
                                     alt="{{ $item->nama_barang }}"
                                     onclick="showImageModal('{{ route('inventaris.foto', $item->id) }}', '{{ $item->nama_barang }}')"
                                     title="Klik untuk memperbesar">
                            @else
                                <div class="d-flex align-items-center justify-content-center mx-auto rounded-3"
                                     style="width:44px; height:44px; background:#f1f5f9; color:#94a3b8;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge" style="background:#f1f5f9; color:#374151; font-family:monospace; font-size:0.75rem; border-radius:6px; padding:0.3rem 0.6rem;">
                                {{ $item->kode_barang }}
                            </span>
                        </td>
                        <td style="font-weight:600; color:#0f172a; max-width:180px;">
                            <div class="text-truncate" title="{{ $item->nama_barang }}">{{ $item->nama_barang }}</div>
                            <small style="color:#94a3b8; font-weight:400;">{{ $item->merk }}</small>
                        </td>
                        <td>
                            <span style="font-size:0.8rem; color:#475569;">{{ $item->kategori }}</span>
                        </td>
                        <td>
                            <small style="color:#64748b;"><i class="bi bi-geo-alt-fill me-1" style="color:#ef4444; font-size:0.65rem;"></i>{{ Str::limit($item->lokasi, 25) }}</small>
                        </td>
                        <td class="text-center">
                            <span style="font-weight:700; color:#1e293b;">{{ $item->jumlah }}</span>
                        </td>
                        <td class="text-center">
                            @if($item->kondisi == 'Baik')
                                <span class="badge" style="background:rgba(16,185,129,0.12); color:#059669; border:1px solid rgba(16,185,129,0.25); border-radius:20px; padding:0.3rem 0.75rem; font-size:0.75rem; font-weight:600;">
                                    ✓ Baik
                                </span>
                            @elseif($item->kondisi == 'Dipinjam')
                                <span class="badge" style="background:rgba(245,158,11,0.12); color:#d97706; border:1px solid rgba(245,158,11,0.25); border-radius:20px; padding:0.3rem 0.75rem; font-size:0.75rem; font-weight:600;">
                                    ⇄ Dipinjam
                                </span>
                            @else
                                <span class="badge" style="background:rgba(239,68,68,0.12); color:#dc2626; border:1px solid rgba(239,68,68,0.25); border-radius:20px; padding:0.3rem 0.75rem; font-size:0.75rem; font-weight:600;">
                                    ✕ Rusak
                                </span>
                            @endif
                        </td>
                        <td>
                            <small style="color:#64748b;">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</small>
                        </td>
                        <td class="px-3 text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('inventaris.show', $item->id) }}"
                                   class="btn btn-sm" title="Detail"
                                   style="background:#eff6ff; color:#1d4ed8; border-radius:8px; width:32px; height:32px; display:flex; align-items:center; justify-content:center; padding:0;">
                                    <i class="bi bi-eye-fill" style="font-size:0.8rem;"></i>
                                </a>
                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                   class="btn btn-sm" title="Ubah"
                                   style="background:#fef3c7; color:#d97706; border-radius:8px; width:32px; height:32px; display:flex; align-items:center; justify-content:center; padding:0;">
                                    <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                                </a>
                                <button type="button" class="btn btn-sm" title="Hapus (Soft Delete)"
                                        onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama_barang) }}', '{{ $item->kode_barang }}')"
                                        style="background:#fee2e2; color:#dc2626; border-radius:8px; width:32px; height:32px; display:flex; align-items:center; justify-content:center; padding:0; border:none;">
                                    <i class="bi bi-trash3-fill" style="font-size:0.8rem;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div style="color:#cbd5e1; font-size:3rem; margin-bottom:0.75rem;">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <p style="color:#94a3b8; font-weight:500; margin-bottom:0.5rem;">
                                @if(request('cari') || request('kategori') || request('kondisi'))
                                    Tidak ada data yang sesuai dengan filter.
                                @else
                                    Belum ada data barang terdaftar.
                                @endif
                            </p>
                            @if(request('cari') || request('kategori') || request('kondisi'))
                                <a href="{{ route('inventaris.index') }}" class="btn btn-sm"
                                   style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                                    <i class="bi bi-x-circle me-1"></i>Hapus Filter
                                </a>
                            @else
                                <a href="{{ route('inventaris.create') }}" class="btn btn-sm"
                                   style="background:var(--dpr-blue); color:white; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah Barang Pertama
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($barang->hasPages())
    <div class="card-footer bg-white py-3" style="border-radius:0 0 16px 16px; border-top:1px solid #f1f5f9;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <small style="color:#64748b; font-size:0.8rem;">
                Halaman <strong>{{ $barang->currentPage() }}</strong> dari <strong>{{ $barang->lastPage() }}</strong>
            </small>
            <div class="d-flex align-items-center gap-1">
                {{-- Previous --}}
                @if($barang->onFirstPage())
                    <span class="btn btn-sm disabled" style="background:#f1f5f9; color:#cbd5e1; border-radius:8px; font-size:0.8rem; cursor:not-allowed;">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $barang->previousPageUrl() }}" class="btn btn-sm"
                       style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach($barang->getUrlRange(max(1, $barang->currentPage()-2), min($barang->lastPage(), $barang->currentPage()+2)) as $page => $url)
                    @if($page == $barang->currentPage())
                        <span class="btn btn-sm" style="background:var(--dpr-blue); color:white; border-radius:8px; font-size:0.8rem; font-weight:700; min-width:32px;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="btn btn-sm"
                           style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none; min-width:32px;">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($barang->hasMorePages())
                    <a href="{{ $barang->nextPageUrl() }}" class="btn btn-sm"
                       style="background:#f1f5f9; color:#475569; border-radius:8px; font-size:0.8rem; text-decoration:none;">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                @else
                    <span class="btn btn-sm disabled" style="background:#f1f5f9; color:#cbd5e1; border-radius:8px; font-size:0.8rem; cursor:not-allowed;">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius:20px; overflow:hidden;">
            <div class="modal-body p-0">
                <div class="text-center p-4" style="background:linear-gradient(135deg, #fff1f2, #fff7f7);">
                    <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:72px; height:72px; background:rgba(239,68,68,0.12); border-radius:50%; font-size:2rem; color:#dc2626;">
                        <i class="bi bi-trash3"></i>
                    </div>
                    <h5 style="font-weight:700; color:#0f172a; margin-bottom:0.5rem;">Pindahkan ke Tong Sampah?</h5>
                    <p style="color:#64748b; font-size:0.875rem; margin-bottom:0;">
                        Data <strong id="deleteItemName" style="color:#0f172a;"></strong>
                        akan dipindahkan ke tong sampah.<br>
                        <span style="color:#059669; font-size:0.8rem;"><i class="bi bi-info-circle me-1"></i>Data dapat dipulihkan kapan saja.</span>
                    </p>
                </div>
                <div class="d-flex gap-2 p-4 pt-3">
                    <button type="button" class="btn flex-fill" data-bs-dismiss="modal"
                            style="background:#f1f5f9; color:#475569; border-radius:10px; font-weight:600;">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-100"
                                style="background:#ef4444; color:white; border-radius:10px; font-weight:600;">
                            <i class="bi bi-trash3 me-1"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Image Preview Modal --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title" id="imageModalTitle" style="font-weight:600;"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-3">
                <img id="imageModalSrc" src="" class="img-fluid rounded-3" alt="" style="max-height:70vh; object-fit:contain;">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // ===== SOFT DELETE =====
    function confirmDelete(id, name, kode) {
        document.getElementById('deleteItemName').innerHTML = `<strong>${name}</strong> (${kode})`;
        document.getElementById('deleteForm').action = `/inventaris/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // ===== IMAGE MODAL =====
    function showImageModal(src, name) {
        document.getElementById('imageModalSrc').src = src;
        document.getElementById('imageModalTitle').textContent = name;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    // ===== AUTOCOMPLETE =====
    const searchInput = document.getElementById('cari');
    const dropdown = document.getElementById('autocompleteDropdown');
    const loadingIndicator = document.getElementById('autocompleteLoading');
    let debounceTimer;

    searchInput.addEventListener('input', function() {
        const term = this.value.trim();
        clearTimeout(debounceTimer);

        if (term.length < 2) {
            dropdown.classList.add('d-none');
            dropdown.innerHTML = '';
            return;
        }

        loadingIndicator.classList.remove('d-none');
        debounceTimer = setTimeout(() => {
            fetch(`/inventaris-autocomplete?term=${encodeURIComponent(term)}`)
                .then(r => r.json())
                .then(data => {
                    loadingIndicator.classList.add('d-none');
                    if (data.length === 0) {
                        dropdown.innerHTML = `
                            <div class="px-3 py-3 text-center" style="color:#94a3b8; font-size:0.8rem;">
                                <i class="bi bi-search me-1"></i>Tidak ada hasil untuk "${term}"
                            </div>`;
                    } else {
                        dropdown.innerHTML = data.map(item => `
                            <div class="autocomplete-item px-3 py-2 d-flex align-items-center gap-2"
                                 style="cursor:pointer; border-bottom:1px solid #f1f5f9; transition:background 0.15s;"
                                 onmouseenter="this.style.background='#f8fafc'"
                                 onmouseleave="this.style.background=''"
                                 onclick="selectSuggestion('${item.nama_barang.replace(/'/g, "\\'")}')">
                                <div style="width:32px; height:32px; background:#eff6ff; border-radius:8px;
                                            display:flex; align-items:center; justify-content:center;
                                            color:#3b82f6; font-size:0.8rem; flex-shrink:0;">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div>
                                    <div style="font-size:0.8rem; font-weight:600; color:#0f172a;">${item.nama_barang}</div>
                                    <div style="font-size:0.7rem; color:#94a3b8;">${item.kode_barang} &middot; ${item.kategori}</div>
                                </div>
                            </div>
                        `).join('');
                    }
                    dropdown.classList.remove('d-none');
                })
                .catch(() => { loadingIndicator.classList.add('d-none'); });
        }, 300);
    });

    function selectSuggestion(name) {
        searchInput.value = name;
        dropdown.classList.add('d-none');
        document.getElementById('filterForm').submit();
    }

    // Close dropdown on outside click
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('d-none');
        }
    });

    // Submit on Enter
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            dropdown.classList.add('d-none');
        }
    });
</script>
@endsection
