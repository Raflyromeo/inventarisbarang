@extends('layouts.app')

@section('title', 'Ubah Barang')

@section('content')
<div class="mb-3">
    <a href="{{ route('inventaris.index') }}" class="text-decoration-none text-muted fw-semibold" style="transition: color 0.2s;" onmouseover="this.classList.replace('text-muted', 'text-primary')" onmouseout="this.classList.replace('text-primary', 'text-muted')">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Barang
    </a>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <h3 class="fw-bold text-dpr mb-0"><i class="bi bi-pencil-square me-2"></i> Ubah Barang</h3>
        <p class="text-muted mb-0 mt-1">Kode Barang: <span class="badge bg-secondary">{{ $barang->kode_barang }}</span></p>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom-0">
        <h5 class="mb-0 text-muted">Form Data Inventaris</h5>
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('inventaris.update', $barang->id) }}" method="POST" enctype="multipart/form-data" onsubmit="this.querySelector('button[type=submit]').disabled = true; this.querySelector('button[type=submit]').innerHTML = '<i class=\'bi bi-hourglass-split me-1\'></i> Menyimpan...';">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                        @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Laptop" {{ old('kategori', $barang->kategori) == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="Komputer" {{ old('kategori', $barang->kategori) == 'Komputer' ? 'selected' : '' }}>Komputer</option>
                            <option value="Monitor" {{ old('kategori', $barang->kategori) == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="Printer" {{ old('kategori', $barang->kategori) == 'Printer' ? 'selected' : '' }}>Printer</option>
                            <option value="Scanner" {{ old('kategori', $barang->kategori) == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                            <option value="Router" {{ old('kategori', $barang->kategori) == 'Router' ? 'selected' : '' }}>Router</option>
                            <option value="Switch" {{ old('kategori', $barang->kategori) == 'Switch' ? 'selected' : '' }}>Switch</option>
                            <option value="Access Point" {{ old('kategori', $barang->kategori) == 'Access Point' ? 'selected' : '' }}>Access Point</option>
                            <option value="Server" {{ old('kategori', $barang->kategori) == 'Server' ? 'selected' : '' }}>Server</option>
                            <option value="Proyektor" {{ old('kategori', $barang->kategori) == 'Proyektor' ? 'selected' : '' }}>Proyektor</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="merk" class="form-label fw-semibold">Merk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ old('merk', $barang->merk) }}" required>
                        @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nomor_seri" class="form-label fw-semibold">Nomor Seri (SN) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror" id="nomor_seri" name="nomor_seri" value="{{ old('nomor_seri', $barang->nomor_seri) }}" required>
                        @error('nomor_seri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kondisi" class="form-label fw-semibold">Kondisi <span class="text-danger">*</span></label>
                        <select class="form-select @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required>
                            <option value="Baik" {{ old('kondisi', $barang->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Dipinjam" {{ old('kondisi', $barang->kondisi) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="Rusak" {{ old('kondisi', $barang->kondisi) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="jumlah" class="form-label fw-semibold">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" min="1" required>
                        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <!-- Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-semibold">Lokasi Penyimpanan <span class="text-danger">*</span></label>
                        <input class="form-control @error('lokasi') is-invalid @enderror" list="datalistLokasi" id="lokasi" name="lokasi" value="{{ old('lokasi', $barang->lokasi) }}" required>
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
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $barang->tanggal_masuk) }}" required>
                            @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jam_input" class="form-label fw-semibold">Jam Input <span class="text-danger">*</span></label>
                            <input type="time" class="form-control @error('jam_input') is-invalid @enderror" id="jam_input" name="jam_input" value="{{ old('jam_input', date('H:i', strtotime($barang->jam_input))) }}" required>
                            @error('jam_input') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Foto Barang (Ganti)</label>
                        @if($barang->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto" class="img-thumbnail" style="height: 80px;">
                            </div>
                        @endif
                        <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="file_manual" class="form-label fw-semibold">File Manual (Ganti PDF)</label>
                        @if($barang->file_manual)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $barang->file_manual) }}" target="_blank" class="badge bg-danger text-decoration-none"><i class="bi bi-file-earmark-pdf"></i> Lihat PDF saat ini</a>
                            </div>
                        @endif
                        <input class="form-control @error('file_manual') is-invalid @enderror" type="file" id="file_manual" name="file_manual" accept=".pdf">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file.</small>
                        @error('file_manual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan / Spesifikasi</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="4">{{ old('keterangan', $barang->keterangan) }}</textarea>
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary me-2 shadow-sm"><i class="bi bi-x-circle me-1"></i> Batal</a>
                <button type="submit" class="btn btn-warning shadow-sm"><i class="bi bi-save me-1"></i> Perbarui Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
