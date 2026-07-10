@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inventaris.index') }}">Data Barang IT</a></li>
    <li class="breadcrumb-item active">Tambah Barang</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-header-title"><i class="bi bi-plus-circle-fill me-2" style="color:var(--dpr-blue);"></i>Tambah Barang Baru</h1>
        <p class="page-header-sub">Isi formulir di bawah untuk mendaftarkan aset IT baru ke sistem inventaris.</p>
    </div>
    <a href="{{ route('inventaris.index') }}" class="btn" style="background:#f1f5f9; color:#475569; border-radius:10px; font-weight:600; padding:0.55rem 1.25rem; font-size:0.875rem; text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h5 class="mb-0 text-muted">Form Data Inventaris</h5>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data" onsubmit="this.querySelector('button[type=submit]').disabled = true; this.querySelector('button[type=submit]').innerHTML = '<i class=\'bi bi-hourglass-split me-1\'></i> Menyimpan...';">
            @csrf
            
            <div class="row">
                <!-- Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required placeholder="Contoh: Laptop ThinkPad T14">
                        @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Laptop" {{ old('kategori') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="Komputer" {{ old('kategori') == 'Komputer' ? 'selected' : '' }}>Komputer</option>
                            <option value="Monitor" {{ old('kategori') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="Printer" {{ old('kategori') == 'Printer' ? 'selected' : '' }}>Printer</option>
                            <option value="Scanner" {{ old('kategori') == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                            <option value="Router" {{ old('kategori') == 'Router' ? 'selected' : '' }}>Router</option>
                            <option value="Switch" {{ old('kategori') == 'Switch' ? 'selected' : '' }}>Switch</option>
                            <option value="Access Point" {{ old('kategori') == 'Access Point' ? 'selected' : '' }}>Access Point</option>
                            <option value="Server" {{ old('kategori') == 'Server' ? 'selected' : '' }}>Server</option>
                            <option value="Proyektor" {{ old('kategori') == 'Proyektor' ? 'selected' : '' }}>Proyektor</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="merk" class="form-label fw-semibold">Merk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ old('merk') }}" required placeholder="Contoh: Lenovo, HP, Dell">
                        @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nomor_seri" class="form-label fw-semibold">Nomor Seri (SN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror" id="nomor_seri" name="nomor_seri" value="{{ old('nomor_seri') }}" required placeholder="Contoh: PF3QW12X">
                        @error('nomor_seri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kondisi" class="form-label fw-semibold">Kondisi <span class="text-danger">*</span></label>
                        <select class="form-select @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Dipinjam" {{ old('kondisi') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="jumlah" class="form-label fw-semibold">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required>
                        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <!-- Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-semibold">Lokasi Penyimpanan <span class="text-danger">*</span></label>
                        <input class="form-control @error('lokasi') is-invalid @enderror" list="datalistLokasi" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required placeholder="Pilih atau ketik lokasi baru...">
                        <datalist id="datalistLokasi">
                            <option value="Ruang Server PUSTEKINFO">
                            <option value="Gudang IT Nusantara I">
                            <option value="Gudang IT Nusantara II">
                            <option value="Ruang Rapat Paripurna">
                            <option value="Ruang Komisi I">
                            <option value="Ruang Fraksi">
                        </datalist>
                        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_masuk" class="form-label fw-semibold">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                            @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jam_input" class="form-label fw-semibold">Jam Input <span class="text-danger">*</span></label>
                            <input type="time" class="form-control @error('jam_input') is-invalid @enderror" id="jam_input" name="jam_input" value="{{ old('jam_input', date('H:i')) }}" required>
                            @error('jam_input') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Foto Barang (Image) <span class="text-danger">*</span></label>
                        <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" accept="image/*" required>
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="file_manual" class="form-label fw-semibold">File Manual (PDF)</label>
                        <input class="form-control @error('file_manual') is-invalid @enderror" type="file" id="file_manual" name="file_manual" accept=".pdf">
                        <small class="text-muted">Opsional. Maksimal 5MB.</small>
                        @error('file_manual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan / Spesifikasi</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="4" placeholder="Opsional. Tambahkan spesifikasi seperti RAM, Storage, dll.">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-secondary me-2 shadow-sm"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset</button>
                <button type="submit" class="btn btn-primary bg-dpr border-0 shadow-sm"><i class="bi bi-save me-1"></i> Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
