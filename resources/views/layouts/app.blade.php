<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PUSTEKINFO DPR RI</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
            <img src="{{ asset('gambar/logopustekinfo.webp') }}" alt="Logo" width="40" class="me-3 bg-white p-1 rounded">
            <div>
                <h6 class="mb-0 fw-bold">PUSTEKINFO</h6>
                <small style="font-size:0.7em; opacity:0.8;">Sekretariat Jenderal DPR RI</small>
            </div>
        </div>

        <ul class="list-unstyled components">
            <li class="px-4 mb-2 text-uppercase text-white-50" style="font-size: 0.75em; letter-spacing: 1px;">Menu Utama</li>
            
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            
            <li class="{{ request()->routeIs('inventaris.*') ? 'active' : '' }}">
                <a href="{{ route('inventaris.index') }}">
                    <i class="bi bi-box-seam-fill"></i> Data Barang IT
                </a>
            </li>
        </ul>

        <div class="mt-auto w-100">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="logout-btn w-100 text-start border-0">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="page-title d-flex align-items-center mb-0">
                <i class="bi bi-list d-inline d-md-none me-2" id="sidebarCollapse" style="cursor:pointer; font-size:1.5rem;"></i>
                @yield('title')
            </h5>
            
            <div class="user-profile dropdown">
                <div class="d-none d-md-block text-end me-2">
                    <div class="fw-bold" style="font-size: 0.9em; color:#2c3e50;">{{ Auth::user()->name ?? 'Admin PUSTEKINFO' }}</div>
                    <div class="text-muted" style="font-size: 0.75em;">Administrator</div>
                </div>
                
                <a href="#" class="d-flex align-items-center text-decoration-none" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar shadow-sm bg-primary text-white d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; font-weight: bold;">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                    <li class="px-3 py-2 d-md-none border-bottom mb-2">
                        <div class="fw-bold" style="font-size: 0.9em; color:#2c3e50;">{{ Auth::user()->name ?? 'Admin PUSTEKINFO' }}</div>
                        <div class="text-muted" style="font-size: 0.75em;">Administrator</div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                <i class="bi bi-box-arrow-right me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('js/script.js') }}"></script>
<script>
    document.getElementById('sidebarCollapse')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>
@yield('scripts')
</body>
</html>
