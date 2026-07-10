<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINBA IT — Sistem Inventaris Barang IT PUSTEKINFO DPR RI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        :root {
            --primary-blue: #2563eb;
            --primary-blue-dark: #1d4ed8;
            --accent-yellow: #eab308;
            --accent-yellow-hover: #ca8a04;
            --dark-section: #1e1b4b;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background: #fff;
            line-height: 1.6;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        
        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }
        .btn-yellow {
            background-color: var(--accent-yellow);
            color: #fff;
        }
        .btn-yellow:hover {
            background-color: var(--accent-yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(234, 179, 8, 0.3);
        }
        .btn-outline-white {
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .btn-outline-white:hover {
            background: rgba(255,255,255,0.1);
        }

        /* HEADER & HERO SECTION */
        .hero-section {
            background-color: var(--primary-blue);
            position: relative;
            padding-top: 20px;
            padding-bottom: 150px;
            color: #fff;
            overflow: hidden;
        }
        /* Curved bottom */
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            height: 150px;
            background: #fff;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }
        
        /* Floating shapes */
        .shape { position: absolute; opacity: 0.8; z-index: 1; }
        .shape-1 { top: 15%; left: 10%; color: var(--accent-yellow); font-size: 24px; }
        .shape-2 { top: 20%; right: 15%; color: #fff; font-size: 20px; }
        .shape-3 { bottom: 30%; left: 5%; color: #a855f7; font-size: 30px; }

        /* Navbar */
        .navbar-wrapper {
            position: absolute;
            top: 0; left: 0; width: 100%;
            z-index: 1000;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        /* Scrolled Navbar */
        .navbar.scrolled {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 12px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: var(--text-dark);
            z-index: 2000;
        }
        .navbar.scrolled .brand, .navbar.scrolled .nav-links a { color: var(--text-dark); }
        .navbar.scrolled .btn-outline-white { border-color: var(--border-color); color: var(--text-dark); }
        .navbar.scrolled .btn-outline-white:hover { background: var(--bg-light); }

        .brand {
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand i { color: var(--accent-yellow); }
        
        .nav-links {
            display: flex;
            gap: 30px;
            font-size: 14px;
            font-weight: 500;
        }
        .nav-links a { opacity: 0.9; transition: opacity 0.2s; }
        .nav-links a:hover { opacity: 1; }
        
        .nav-auth {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Hero Content */
        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 80px auto 0;
            position: relative;
            z-index: 10;
        }
        .hero-content h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .hero-content p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 600px;
            margin-inline: auto;
        }
        
        /* Dashboard Mockup in Hero */
        .hero-mockup-wrapper {
            position: relative;
            max-width: 900px;
            margin: 50px auto -100px;
            z-index: 10;
        }
        .hero-mockup {
            background: #fff;
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            border: 4px solid rgba(255,255,255,0.2);
        }
        .hero-mockup img {
            width: 100%;
            border-radius: 10px;
            display: block;
            border: 1px solid var(--border-color);
        }

        /* TRUSTED BY */
        .trusted-section {
            padding: 120px 0 60px;
            text-align: center;
            background: #fff;
            position: relative;
            z-index: 5;
        }
        .trusted-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 30px;
        }
        .trusted-title span { color: var(--primary-blue); }
        .trusted-logos img { transition: all 0.3s; }

        /* FEATURES SECTION */
        .features-section {
            padding: 80px 0;
            background: #fff;
        }
        .features-grid-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .features-left h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 40px;
            line-height: 1.2;
        }
        .feature-item {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #eff6ff;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .feature-item h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .feature-item p {
            font-size: 14px;
            color: var(--text-gray);
            line-height: 1.6;
        }
        
        /* WORKFLOW SECTION (Winding Road) */
        .workflow-section {
            padding: 100px 0;
            background: var(--bg-light);
            text-align: center;
        }
        .workflow-section h2 { font-size: 36px; font-weight: 800; margin-bottom: 10px; }
        .workflow-section > p { color: var(--text-gray); margin-bottom: 60px; max-width: 600px; margin-inline: auto; }
        
        .workflow-path {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        /* The vertical line in the middle */
        .workflow-path::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 4px; height: 100%;
            background: var(--primary-blue);
            border-radius: 4px;
            opacity: 0.2;
        }
        
        .w-step {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 60px;
            position: relative;
            width: 100%;
        }
        .w-step:last-child { margin-bottom: 0; }
        .w-step:nth-child(even) { flex-direction: row-reverse; }
        
        .w-content {
            width: 45%;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
            text-align: right;
            position: relative;
            transition: transform 0.3s;
        }
        .w-step:nth-child(even) .w-content { text-align: left; }
        .w-content:hover { transform: translateY(-5px); }
        
        .w-number {
            position: absolute;
            left: 50%; top: 50%;
            transform: translate(-50%, -50%);
            width: 60px; height: 60px;
            background: #fff; color: var(--primary-blue);
            border-radius: 50%; 
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; font-weight: 800; 
            border: 4px solid var(--primary-blue);
            z-index: 2;
            box-shadow: 0 0 0 6px var(--bg-light);
        }
        
        .w-icon-top {
            font-size: 30px; color: var(--primary-blue);
            margin-bottom: 15px; opacity: 0.5;
        }
        .w-content h4 { font-size: 20px; font-weight: 700; margin-bottom: 10px; }
        .w-content p { font-size: 14px; color: var(--text-gray); }

        /* STATUS/PRICING SECTION (Swiper) */
        .pricing-section {
            padding: 100px 0;
            background: #fff;
            text-align: center;
            overflow: hidden; /* For Swiper */
        }
        .pricing-section h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
        }
        .pricing-section > p {
            color: var(--text-gray);
            margin-bottom: 50px;
        }
        
        .price-card {
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 40px 30px;
            text-align: left;
            position: relative;
            height: 100%;
            background: #fff;
            transition: all 0.3s;
        }
        .price-card:hover { border-color: var(--primary-blue); box-shadow: 0 20px 40px rgba(37, 99, 235, 0.1); }
        .price-card.featured {
            border-color: var(--primary-blue);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.1);
        }
        .price-card .type {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .price-card .amount {
            font-size: 40px;
            font-weight: 800;
            margin: 20px 0;
        }
        .price-card .amount span { font-size: 16px; color: var(--text-gray); font-weight: 500; }
        .price-card ul { margin-top: 30px; margin-bottom: 30px; }
        .price-card li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            color: var(--text-gray);
        }
        .price-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            margin-top: auto;
            text-decoration: none;
        }
        .btn-dark { background: var(--text-dark); color: #fff; }
        .btn-light { background: #fff; border: 1px solid var(--border-color); color: var(--text-dark); }
        .btn-light:hover { background: var(--bg-light); }

        /* Swiper Controls Customization */
        .swiper-pagination-bullet-active { background: var(--primary-blue) !important; }
        .swiper-wrapper { margin-bottom: 40px; }

        /* FOOTER */
        .footer {
            background: var(--dark-section);
            color: #fff;
            padding: 60px 0 20px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer h3 { font-size: 20px; font-weight: 800; margin-bottom: 20px; }
        .footer p { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.6; max-width: 300px; }
        .footer h4 { font-size: 16px; font-weight: 700; margin-bottom: 20px; }
        .footer ul li { margin-bottom: 12px; }
        .footer ul li a { color: rgba(255,255,255,0.6); font-size: 14px; transition: color 0.2s; }
        .footer ul li a:hover { color: #fff; }
        .social-links { display: flex; gap: 10px; }
        .social-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; transition: background 0.2s;
        }
        .social-icon:hover { background: var(--primary-blue); }
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }

        @media (max-width: 992px) {
            .features-grid-main { flex-direction: column; }
            .w-step, .w-step:nth-child(even) { flex-direction: column; text-align: center; gap: 30px; }
            .w-content, .w-step:nth-child(even) .w-content { width: 100%; text-align: center; }
            .workflow-path::before { left: 20px; display: none; } /* Hide line on mobile for cleaner look */
            .w-number { position: relative; left: auto; top: auto; transform: none; margin: 0 auto; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .hero-content h1 { font-size: 36px; }
        }
    </style>
</head>
<body>

    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar" id="navbar">
                <a href="#" class="brand text-white">
                    <i class="bi bi-hdd-network-fill"></i> SINBA IT
                </a>
                <div class="nav-links d-none d-md-flex text-white">
                    <a href="#">Fitur</a>
                    <a href="#">Alur Kerja</a>
                    <a href="#">Kondisi</a>
                </div>
                <div class="nav-auth">
                    <a href="{{ route('login') }}" class="btn btn-outline-white">Login</a>
                    <a href="{{ route('login') }}" class="btn btn-yellow">Dashboard</a>
                </div>
            </nav>
        </div>
    </div>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <i class="bi bi-star-fill shape shape-1"></i>
        <i class="bi bi-circle shape shape-2"></i>
        <i class="bi bi-triangle-fill shape shape-3" style="transform: rotate(45deg);"></i>
        
        <div class="container">
            <!-- Hero Content -->
            <div class="hero-content">
                <h1>Kelola Inventaris Aset IT Secara Cerdas & Efisien!</h1>
                <p>Platform terintegrasi untuk pencatatan, pemantauan, dan manajemen seluruh perangkat IT di lingkungan PUSTEKINFO DPR RI secara real-time.</p>
                <a href="{{ route('login') }}" class="btn btn-yellow" style="padding: 16px 36px; font-size: 16px;">
                    Mulai Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Hero Mockup -->
            <div class="hero-mockup-wrapper">
                <div class="hero-mockup">
                    <img src="https://ui-avatars.com/api/?background=f8fafc&color=cbd5e1&size=800&name=Dashboard+Preview&font-size=0.1" alt="Dashboard Preview" style="height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- TRUSTED BY -->
    <section class="trusted-section">
        <div class="container">
            <h3 class="trusted-title">Dipercaya untuk mengelola lebih dari <span>{{ $totalBarang }}+</span> Aset IT</h3>
            <div class="trusted-logos d-flex justify-content-center align-items-center gap-5 flex-wrap">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Dewan_Perwakilan_Rakyat_Republik_Indonesia_logo.svg/300px-Dewan_Perwakilan_Rakyat_Republik_Indonesia_logo.svg.png" alt="DPR RI" style="height: 70px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
                <img src="{{ asset('gambar/logopustekinfo.webp') }}" alt="PUSTEKINFO" style="height: 60px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
                <img src="https://stc.co.id/wp-content/uploads/2016/01/LOGO-SETJEN-DPR-RI.jpg" alt="SETJEN" style="height: 75px; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
            </div>
        </div>
    </section>

    <!-- FEATURES MAIN -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid-main">
                <div class="features-left">
                    <h2>Pemantauan Inventaris<br>Aset Lengkap</h2>
                    
                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-laptop"></i></div>
                        <div>
                            <h4>Pencatatan Detail</h4>
                            <p>Catat perangkat beserta spesifikasi, nomor seri, dan lokasi fisik dengan sangat mendetail dalam satu sistem tersentralisasi.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-search"></i></div>
                        <div>
                            <h4>Pencarian Cerdas</h4>
                            <p>Temukan barang dalam hitungan detik menggunakan fitur pencarian autocomplete dan filter multi-kriteria canggih.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
                        <div>
                            <h4>Keamanan Berkas</h4>
                            <p>Dokumen manual dan foto barang disimpan di private storage yang aman dan hanya bisa diakses oleh pengguna terotentikasi.</p>
                        </div>
                    </div>
                </div>
                
                <div class="features-right">
                    <img src="{{ asset('gambar/gedungDPR.jpg') }}" alt="Gedung DPR RI" style="height: 500px; width: 100%; object-fit: cover; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                </div>
            </div>
        </div>
    </section>

    <!-- WORKFLOW (WINDING ROAD) -->
    <section class="workflow-section">
        <div class="container">
            <h2>Alur Kerja & Eksekusi</h2>
            <p>Proses inventarisasi yang terstruktur membuat manajemen aset menjadi lebih tertata, mudah dipantau, dan efisien.</p>
            
            <div class="workflow-path">
                <div class="w-step">
                    <div class="w-content">
                        <i class="bi bi-box-arrow-in-right w-icon-top"></i>
                        <h4>Login Sistem</h4>
                        <p>Autentikasi aman untuk masuk ke dalam dashboard administrator sistem inventaris pusat.</p>
                    </div>
                    <div class="w-number">1</div>
                    <div style="width: 45%;"></div> <!-- Empty div for layout balance -->
                </div>
                
                <div class="w-step">
                    <div class="w-content">
                        <i class="bi bi-pencil-square w-icon-top"></i>
                        <h4>Input Data Barang</h4>
                        <p>Mencatat spesifikasi lengkap, kondisi, serta mengunggah foto fisik dan dokumen pendukung.</p>
                    </div>
                    <div class="w-number">2</div>
                    <div style="width: 45%;"></div>
                </div>
                
                <div class="w-step">
                    <div class="w-content">
                        <i class="bi bi-search w-icon-top"></i>
                        <h4>Monitoring</h4>
                        <p>Memantau distribusi barang, menavigasi perangkat, dan mengubah status perangkat.</p>
                    </div>
                    <div class="w-number">3</div>
                    <div style="width: 45%;"></div>
                </div>
                
                <div class="w-step">
                    <div class="w-content">
                        <i class="bi bi-graph-up-arrow w-icon-top"></i>
                        <h4>Analisa Laporan</h4>
                        <p>Melihat ringkasan data inventaris dari dashboard untuk kebutuhan audit aset.</p>
                    </div>
                    <div class="w-number">4</div>
                    <div style="width: 45%;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATUS/PRICING SECTION (SWIPER) -->
    <section class="pricing-section">
        <div class="container">
            <h2>Distribusi Kondisi Inventaris</h2>
            <p>Pilih kategori kondisi barang untuk melihat daftar lengkap tabel datanya.</p>
            
            <!-- Swiper Container -->
            <div class="swiper conditionSwiper">
                <div class="swiper-wrapper">
                    
                    <!-- Slide 1: Baik -->
                    <div class="swiper-slide">
                        <div class="price-card">
                            <div class="type"><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Kondisi Baik</div>
                            <div class="amount">{{ $barangBaik }} <span>Unit</span></div>
                            <ul>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Perangkat berfungsi normal</li>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Siap digunakan kapan saja</li>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Terdata dengan lengkap</li>
                            </ul>
                            <!-- Link langsung ke halaman tabel dashboard -->
                            <a href="{{ route('inventaris.index', ['kondisi' => 'Baik']) }}" class="price-btn btn-light">Lihat Tabel Data</a>
                        </div>
                    </div>
                    
                    <!-- Slide 2: Dipinjam -->
                    <div class="swiper-slide">
                        <div class="price-card featured">
                            <div class="type"><i class="bi bi-arrow-left-right" style="color: var(--accent-yellow);"></i> Sedang Dipinjam</div>
                            <div class="amount">{{ $barangDipinjam }} <span>Unit</span></div>
                            <ul>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Tercatat nama peminjam</li>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Status lokasi diketahui</li>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Terpantau di sistem</li>
                            </ul>
                            <!-- Link langsung ke halaman tabel dashboard -->
                            <a href="{{ route('inventaris.index', ['kondisi' => 'Dipinjam']) }}" class="price-btn btn-dark" style="background: var(--primary-blue);">Lihat Tabel Data</a>
                        </div>
                    </div>
                    
                    <!-- Slide 3: Rusak -->
                    <div class="swiper-slide">
                        <div class="price-card">
                            <div class="type"><i class="bi bi-tools" style="color: #ef4444;"></i> Kondisi Rusak</div>
                            <div class="amount">{{ $barangRusak }} <span>Unit</span></div>
                            <ul>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Dalam proses perbaikan</li>
                                <li><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> Tercatat riwayat kerusakan</li>
                                <li><i class="bi bi-x-circle-fill" style="color: #ef4444;"></i> Tidak dapat dipinjamkan</li>
                            </ul>
                            <!-- Link langsung ke halaman tabel dashboard -->
                            <a href="{{ route('inventaris.index', ['kondisi' => 'Rusak']) }}" class="price-btn btn-light">Lihat Tabel Data</a>
                        </div>
                    </div>
                    
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3>SINBA IT</h3>
                    <p>Sistem Informasi dan Manajemen Inventaris Barang IT di lingkungan Pusat Teknologi Informasi, Sekretariat Jenderal DPR RI. Mengedepankan efisiensi, akurasi, dan keamanan data aset.</p>
                </div>
                <div>
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Alur Kerja</a></li>
                        <li><a href="#">Kondisi Inventaris</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Akses Sistem</h4>
                    <ul>
                        <li><a href="{{ route('login') }}">Dashboard Admin</a></li>
                        <li><a href="{{ route('login') }}">Manajemen Barang</a></li>
                        <li><a href="{{ route('login') }}">Tong Sampah</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Sosial Media</h4>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} PUSTEKINFO DPR RI. Hak cipta dilindungi undang-undang.
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        var swiper = new Swiper(".conditionSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
            },
        });

        // Sticky Navbar Effect
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                // Change text colors to dark on scroll since bg is white
                navbar.querySelectorAll('.text-white').forEach(el => {
                    el.classList.remove('text-white');
                    el.classList.add('text-dark');
                });
            } else {
                navbar.classList.remove('scrolled');
                // Revert to white
                navbar.querySelectorAll('.text-dark').forEach(el => {
                    el.classList.remove('text-dark');
                    el.classList.add('text-white');
                });
            }
        });
    </script>
</body>
</html>
