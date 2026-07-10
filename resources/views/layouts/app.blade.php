<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — SINBA IT | PUSTEKINFO DPR RI</title>
    <meta name="description" content="Sistem Inventaris Barang IT PUSTEKINFO DPR RI">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        /* ============================================================
           SHADCN-LIKE VARIABLES
        ============================================================ */
        :root {
            --background: #ffffff;
            --foreground: #09090b;
            --muted: #f4f4f5;
            --muted-foreground: #71717a;
            --border: #e4e4e7;
            --input: #e4e4e7;
            --primary: #18181b;
            --primary-foreground: #fafafa;
            --secondary: #f4f4f5;
            --secondary-foreground: #18181b;
            --accent: #f4f4f5;
            --accent-foreground: #18181b;
            --ring: #18181b;
            --radius: 0.5rem;
            
            --sidebar-w: 260px;
            --sidebar-w-col: 70px;
            --sidebar-bg: #fdfdfd;
            --sidebar-border: #e4e4e7;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #fbfbfc; /* Very light gray */
            color: var(--foreground);
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            display: flex;
            min-height: 100vh;
        }

        /* ============================================================
           SHADCN UI - SIDEBAR (Sidebar-07 Style)
        ============================================================ */
        #sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            z-index: 600;
            display: flex;
            flex-direction: column;
            transition: width 0.2s ease-in-out;
        }

        #sidebar.sidebar-collapsed {
            width: var(--sidebar-w-col);
        }

        /* Elements hidden in collapsed mode */
        #sidebar.sidebar-collapsed .sidebar-label,
        #sidebar.sidebar-collapsed .nav-section-label,
        #sidebar.sidebar-collapsed .brand-title,
        #sidebar.sidebar-collapsed .user-details,
        #sidebar.sidebar-collapsed .nav-badge,
        #sidebar.sidebar-collapsed .logout-text {
            display: none;
        }
        
        #sidebar.sidebar-collapsed .nav-link-custom {
            justify-content: center;
            padding: 0.5rem;
        }
        #sidebar.sidebar-collapsed .nav-link-custom i { margin-right: 0; }
        #sidebar.sidebar-collapsed .sidebar-header { justify-content: center; padding: 1rem 0; }
        #sidebar.sidebar-collapsed .sidebar-footer { padding: 0.75rem; align-items: center; }
        #sidebar.sidebar-collapsed .user-profile { padding: 0.25rem; justify-content: center; border: none; background: transparent; }

        /* ── Header ── */
        .sidebar-header {
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            gap: 0.75rem;
            border-bottom: 1px solid var(--sidebar-border);
        }
        .brand-logo {
            width: 32px; height: 32px;
            background: var(--primary);
            color: var(--primary-foreground);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .brand-title {
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: -0.01em;
            white-space: nowrap;
        }

        /* ── Nav ── */
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0.75rem;
            overflow-y: auto;
        }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

        .nav-section-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted-foreground);
            padding: 0.5rem 0.5rem;
            margin-top: 0.5rem;
            white-space: nowrap;
        }
        .nav-item-custom { list-style: none; margin-bottom: 2px; }

        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 0.45rem 0.6rem;
            border-radius: 6px;
            color: var(--muted-foreground);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            white-space: nowrap;
        }
        .nav-link-custom i {
            font-size: 1.1rem;
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        .nav-link-custom:hover {
            background: var(--accent);
            color: var(--accent-foreground);
        }
        .nav-link-custom.active {
            background: var(--accent);
            color: var(--accent-foreground);
            font-weight: 600;
        }
        .nav-badge {
            margin-left: auto;
            background: #ef4444;
            color: #fff;
            font-size: 0.65rem;
            padding: 2px 6px;
            border-radius: 99px;
            font-weight: 600;
        }

        /* ── Footer ── */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: var(--background);
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 4px;
            background: var(--secondary);
            display: flex; align-items: center; justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--foreground);
            flex-shrink: 0;
        }
        .user-details {
            flex: 1;
            min-width: 0;
        }
        .user-details h6 {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-details small {
            font-size: 0.7rem;
            color: var(--muted-foreground);
        }
        
        .logout-btn {
            background: transparent;
            border: none;
            color: var(--muted-foreground);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            padding: 0.4rem 0.5rem;
            border-radius: 6px;
            width: 100%;
            transition: all 0.2s;
        }
        .logout-btn:hover {
            background: #fee2e2;
            color: #ef4444;
        }

        /* Tooltip for collapsed */
        #sidebar.sidebar-collapsed .nav-link-custom { position: relative; }
        #sidebar.sidebar-collapsed .nav-link-custom::after {
            content: attr(data-label);
            position: absolute;
            left: 100%; top: 50%;
            transform: translateY(-50%) translateX(10px);
            background: var(--primary);
            color: var(--primary-foreground);
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 4px;
            opacity: 0;
            pointer-events: none;
            white-space: nowrap;
            transition: opacity 0.2s, transform 0.2s;
            z-index: 1000;
        }
        #sidebar.sidebar-collapsed .nav-link-custom:hover::after {
            opacity: 1;
            transform: translateY(-50%) translateX(5px);
        }

        /* ============================================================
           MAIN CONTENT WRAPPER
        ============================================================ */
        #content {
            flex: 1;
            margin-left: var(--sidebar-w);
            display: flex;
            flex-direction: column;
            transition: margin-left 0.2s ease-in-out;
            min-width: 0;
        }
        #content.content-expanded {
            margin-left: var(--sidebar-w-col);
        }

        /* ============================================================
           TOPBAR (SHADCN STYLE)
        ============================================================ */
        .topbar {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            background: var(--background);
            border-bottom: 1px solid var(--sidebar-border);
            position: sticky;
            top: 0;
            z-index: 500;
        }
        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        
        .sidebar-toggle {
            background: transparent;
            border: 1px solid var(--border);
            width: 32px; height: 32px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted-foreground);
            cursor: pointer;
            transition: background 0.15s;
        }
        .sidebar-toggle:hover { background: var(--accent); color: var(--foreground); }

        .topbar-actions { display: flex; align-items: center; gap: 0.75rem; }
        .action-icon {
            width: 32px; height: 32px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted-foreground);
            text-decoration: none;
            transition: background 0.15s;
        }
        .action-icon:hover { background: var(--accent); color: var(--foreground); }

        /* ============================================================
           PAGE CONTENT AREA (WITH BREADCRUMB INSIDE)
        ============================================================ */
        .page-content-wrapper {
            padding: 2rem;
            flex: 1;
        }

        /* Breadcrumb Inside Page */
        .page-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--muted-foreground);
            margin-bottom: 1rem;
        }
        .page-breadcrumb a {
            color: var(--muted-foreground);
            text-decoration: none;
            transition: color 0.15s;
        }
        .page-breadcrumb a:hover { color: var(--foreground); }
        .page-breadcrumb .separator {
            font-size: 0.75rem;
            color: #d4d4d8;
        }
        .page-breadcrumb .active {
            color: var(--foreground);
            font-weight: 500;
        }

        .page-title-area { margin-bottom: 1.5rem; }
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--foreground);
            margin: 0;
        }

        /* ============================================================
           SHADCN-LIKE CARDS & COMPONENTS
        ============================================================ */
        .card {
            background: var(--background);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .card-header {
            padding: 1.5rem 1.5rem 0;
            border-bottom: none;
            background: transparent;
        }
        .card-body { padding: 1.5rem; }

        /* Responsive Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(2px);
            z-index: 590;
        }
        
        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); width: var(--sidebar-w) !important; }
            #sidebar.sidebar-mobile-open { transform: translateX(0); }
            #content { margin-left: 0 !important; }
            .sidebar-overlay.active { display: block; }
            .page-content-wrapper { padding: 1.25rem; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="brand-logo"><i class="bi bi-hdd-network"></i></div>
        <div class="brand-title">SINBA IT</div>
    </div>

    <div class="sidebar-nav">
        <ul class="list-unstyled mb-0">
            <li class="nav-section-label">Overview</li>

            <li class="nav-item-custom">
                <a href="{{ route('dashboard') }}" class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-label="Dashboard">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </li>

            <li class="nav-item-custom">
                <a href="{{ route('inventaris.index') }}" class="nav-link-custom {{ request()->routeIs('inventaris.index', 'inventaris.show', 'inventaris.edit') ? 'active' : '' }}" data-label="Data Barang">
                    <i class="bi bi-box-seam"></i>
                    <span class="sidebar-label">Data Barang</span>
                </a>
            </li>

            <li class="nav-section-label">Manajemen</li>

            <li class="nav-item-custom">
                <a href="{{ route('inventaris.create') }}" class="nav-link-custom {{ request()->routeIs('inventaris.create') ? 'active' : '' }}" data-label="Tambah Barang">
                    <i class="bi bi-plus-square"></i>
                    <span class="sidebar-label">Tambah Barang</span>
                </a>
            </li>

            <li class="nav-item-custom">
                <a href="{{ route('inventaris.trash') }}" class="nav-link-custom {{ request()->routeIs('inventaris.trash') ? 'active' : '' }}" data-label="Tong Sampah">
                    <i class="bi bi-trash3"></i>
                    <span class="sidebar-label">Tong Sampah</span>
                    @php $trashCount = \App\Models\Barang::onlyTrashed()->count(); @endphp
                    @if($trashCount > 0)
                        <span class="nav-badge">{{ $trashCount }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-section-label">Eksternal</li>

            <li class="nav-item-custom">
                <a href="{{ route('landing') }}" target="_blank" class="nav-link-custom" data-label="Landing Page">
                    <i class="bi bi-globe"></i>
                    <span class="sidebar-label">Landing Page</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
            <div class="user-details">
                <h6>{{ Auth::user()->name ?? 'Admin' }}</h6>
                <small>{{ Auth::user()->email ?? 'admin@dpr.go.id' }}</small>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0; width: 100%;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-left"></i> <span class="logout-text">Log out</span>
            </button>
        </form>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div id="content">
    
    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="bi bi-layout-sidebar"></i>
            </button>
        </div>
        
        <div class="topbar-actions">
            <a href="{{ route('landing') }}" target="_blank" class="action-icon" title="View Site">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>
        </div>
    </header>

    <!-- Page Content Area -->
    <main class="page-content-wrapper">
        
        <!-- Breadcrumb (Inside Page Content) -->
        <div class="page-breadcrumb">
            <a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a>
            @hasSection('breadcrumb')
                <i class="bi bi-chevron-right separator"></i>
                @yield('breadcrumb')
            @endif
        </div>
        
        <div class="page-title-area">
            <h1 class="page-title">@yield('title', 'Dashboard')</h1>
        </div>

        <!-- Alerts -->
        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="background:#ecfdf5; color:#065f46; border-radius:8px;">
                <i class="bi bi-check-circle me-2"></i> {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="background:#fef2f2; color:#991b1b; border-radius:8px;">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Main Content -->
        @yield('content')
        
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');
    
    // Check local storage for desktop state
    if (window.innerWidth >= 992) {
        if (localStorage.getItem('shadcnSidebar') === 'collapsed') {
            sidebar.classList.add('sidebar-collapsed');
            content.classList.add('content-expanded');
        }
    }

    toggleBtn.addEventListener('click', () => {
        if (window.innerWidth >= 992) {
            sidebar.classList.toggle('sidebar-collapsed');
            content.classList.toggle('content-expanded');
            localStorage.setItem('shadcnSidebar', sidebar.classList.contains('sidebar-collapsed') ? 'collapsed' : 'expanded');
        } else {
            sidebar.classList.add('sidebar-mobile-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('sidebar-mobile-open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('sidebar-mobile-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});
</script>
@yield('scripts')
</body>
</html>
