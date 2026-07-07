<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris Barang IT</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }
        .login-container {
            height: 100vh;
        }
        .bg-image {
            background-image: url('{{ asset('gambar/gedungDPR.jpg') }}');
            background-size: cover;
            /* Mengubah posisi ke top agar kubah DPR tidak terpotong */
            background-position: center top; 
            background-repeat: no-repeat;
        }
        .logo-img {
            max-width: 120px;
        }
        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(15, 59, 100, 0.25);
            border-radius: 0.375rem;
        }
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #0f3b64;
        }
    </style>
</head>
<body>

<div class="container-fluid login-container">
    <div class="row h-100">
        <!-- Kolom Kiri: Form Login -->
        <div class="col-md-4 col-lg-4 d-flex align-items-center justify-content-center bg-white shadow-lg z-index-2 position-relative">
            <div class="w-100" style="max-width: 400px; padding: 20px;">
                
                <div class="text-start mb-4">
                    <img src="{{ asset('gambar/logopustekinfo.webp') }}" alt="Logo PUSTEKINFO" class="logo-img mb-3">
                    <h3 class="fw-bold text-dark mb-1">Masuk Akun</h3>
                    <p class="text-muted small mb-3">Pusat Teknologi Informasi<br>Sekretariat Jenderal DPR RI</p>
                    <!-- Garis bawah sejajar dengan teks kiri -->
                    <div style="width: 60px; height: 3px; background-color: var(--dpr-blue);"></div>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger small shadow-sm border-0 bg-danger bg-opacity-10 text-danger rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-dark">Alamat Email</label>
                        <input type="email" class="form-control form-control-lg bg-light border-0" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh@email.com" style="font-size: 0.95rem;">
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold small text-dark">Kata Sandi</label>
                        <input type="password" class="form-control form-control-lg bg-light border-0" id="password" name="password" required placeholder="Masukkan kata sandi" style="font-size: 0.95rem;">
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input border-secondary" id="remember" name="remember">
                            <label class="form-check-label text-muted small" for="remember">Ingat Saya</label>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <!-- Diubah menjadi btn-primary (Biru DPR) -->
                        <button type="submit" class="btn btn-primary btn-lg fw-bold border-0 shadow-sm" style="border-radius: 8px; font-size: 0.95rem;">
                            Masuk Sekarang
                        </button>
                    </div>
                </form>
                
                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} PUSTEKINFO DPR RI.
                </div>
            </div>
        </div>
        
        <!-- Kolom Kanan: Gambar Background -->
        <div class="col-md-8 col-lg-8 d-none d-md-block p-0 position-relative">
            <div class="bg-image h-100 w-100 position-absolute" style="top:0; left:0;"></div>
            <div class="position-absolute w-100 h-100 d-flex flex-column justify-content-end p-5" style="background: linear-gradient(to top, rgba(15, 59, 100, 0.9) 0%, rgba(15, 59, 100, 0.4) 50%, rgba(0,0,0,0) 100%);">
                <div class="ms-md-5 mb-5 text-white" style="max-width: 600px;">
                    <!-- Garis pembatas warna biru muda sebagai aksen konsisten -->
                    <div style="width: 50px; height: 4px; background-color: #4da3ff; margin-bottom: 20px;"></div>
                    <h1 class="fw-bold display-5 mb-3" style="line-height: 1.2;">Membangun Sistem<br>Inventaris Terpadu.</h1>
                    <p class="fs-5 opacity-75">Sistem Pencatatan dan Pengelolaan Barang IT di Lingkungan Sekretariat Jenderal DPR RI secara transparan dan akuntabel.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
