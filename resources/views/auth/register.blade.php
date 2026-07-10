<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Inventaris Barang IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }
        .register-container {
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="container register-container d-flex align-items-center justify-content-center">
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 500px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <img src="{{ asset('gambar/logopustekinfo.webp') }}" alt="Logo" width="80" class="mb-3">
                <h3 class="fw-bold">Buat Akun</h3>
                <p class="text-muted small">Pusat Teknologi Informasi DPR RI</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold small">Nama Lengkap</label>
                    <input id="name" type="text" class="form-control bg-light @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold small">Alamat Email</label>
                    <input id="email" type="email" class="form-control bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold small">Kata Sandi</label>
                    <input id="password" type="password" class="form-control bg-light @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold small">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" class="form-control bg-light" name="password_confirmation" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a class="text-decoration-none small text-muted hover-primary" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-bold">Daftar Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
