<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Barang IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center mt-5">
        <h1>Selamat Datang di Sistem Inventaris Barang IT</h1>
        <p class="lead mt-3">Pusat Teknologi Informasi Sekretariat Jenderal DPR RI</p>
        <div class="mt-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>
