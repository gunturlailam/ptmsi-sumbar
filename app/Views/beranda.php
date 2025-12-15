<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        body {
            background: linear-gradient(120deg, #E8F2FF 0%, #F0F8FF 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        .hero-modern {
            background: linear-gradient(120deg, #1E90FF 0%, #00BFFF 100%);
            color: #fff;
            padding: 60px 0 40px 0;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.10);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .hero-modern::before {
            content: '';
            position: absolute;
            top: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #fff 0%, transparent 70%);
            opacity: 0.25;
            z-index: 0;
        }

        .hero-modern .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-modern .hero-title {
            font-size: 3.2rem;
            font-weight: 900;
            letter-spacing: 1px;
            margin-bottom: 10px;
            color: #fff;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
        }

        .hero-modern .hero-subtitle {
            font-size: 1.4rem;
            color: #e0f2ff;
            margin-bottom: 30px;
        }

        .btn-modern-primary {
            background: linear-gradient(90deg, #1E90FF 60%, #36a2ff 100%);
            color: #fff;
            font-weight: 700;
            padding: 16px 36px;
            border-radius: 22px;
            font-size: 1.1rem;
            border: none;
            box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }

        .btn-modern-primary:hover {
            background: #1565c0;
            color: #fff;
            box-shadow: 0 4px 16px rgba(30, 144, 255, 0.13);
        }

        .btn-secondary-modern {
            background: #fff;
            color: #1E90FF;
            font-weight: 700;
            padding: 16px 36px;
            border-radius: 22px;
            font-size: 1.1rem;
            border: 2px solid #1E90FF;
            box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }

        .btn-secondary-modern:hover {
            background: #1E90FF;
            color: #fff;
            box-shadow: 0 4px 16px rgba(30, 144, 255, 0.13);
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-18px);
            }
        }

        /* Timeline Section */
        .timeline-section {
            background: #fff;
            border-radius: 30px;
            padding: 40px;
            margin: 40px 0;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.1);
            border: 2px solid #E8F2FF;
        }

        .timeline-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .timeline-header h2 {
            color: #003366;
            font-weight: 900;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .timeline-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
            scroll-behavior: smooth;
        }

        .timeline-card {
            min-width: 300px;
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .timeline-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #003366, #1E90FF, #00BFFF);
        }

        .timeline-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .timeline-date {
            background: linear-gradient(135deg, #003366, #1E90FF);
            color: white;
            padding: 8px 16px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 15px;
        }

        .timeline-title {
            color: #003366;
            font-weight: 900;
            font-size: 1.2rem;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .timeline-desc {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Featured Content Grid */
        .featured-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin: 40px 0;
        }

        .featured-main {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.1);
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
        }

        .featured-main:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(30, 144, 255, 0.2);
        }

        .featured-image {
            height: 300px;
            background: linear-gradient(135deg, #003366, #1E90FF, #00BFFF);
            position: relative;
            overflow: hidden;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            color: #003366;
            padding: 8px 16px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .featured-content {
            padding: 30px;
        }

        .featured-title {
            color: #003366;
            font-weight: 900;
            font-size: 1.8rem;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .featured-desc {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .featured-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #1E90FF;
            font-weight: 600;
        }

        /* Sidebar */
        .sidebar-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-card {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
        }

        .sidebar-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(30, 144, 255, 0.15);
            border-color: #1E90FF;
        }

        .sidebar-title {
            color: #003366;
            font-weight: 900;
            font-size: 1.3rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item {
            padding: 15px 0;
            border-bottom: 1px solid #E8F2FF;
            transition: all 0.3s ease;
        }

        .sidebar-item:last-child {
            border-bottom: none;
        }

        .sidebar-item:hover {
            padding-left: 10px;
            background: linear-gradient(135deg, #E8F2FF, transparent);
            border-radius: 10px;
        }

        .sidebar-item-title {
            color: #003366;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .sidebar-item-meta {
            color: #666;
            font-size: 0.9rem;
        }

        /* Article Grid */
        .article-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        .article-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .article-image {
            height: 200px;
            background: linear-gradient(135deg, #003366, #1E90FF);
            position: relative;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-content {
            padding: 25px;
        }

        .article-category {
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 15px;
        }

        .article-title {
            color: #003366;
            font-weight: 900;
            font-size: 1.3rem;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .article-excerpt {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .article-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #1E90FF;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Social Media Section */
        .social-section {
            background: linear-gradient(135deg, #003366, #1E90FF, #00BFFF);
            color: white;
            border-radius: 30px;
            padding: 40px;
            margin: 40px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .social-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }

        .social-title {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .social-link {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            transition: all 0.4s ease;
            text-decoration: none;
        }

        .social-link:hover {
            background: white;
            color: #1E90FF;
            transform: translateY(-5px) scale(1.1);
        }

        @media (max-width: 768px) {
            .featured-grid {
                grid-template-columns: 1fr;
            }

            .timeline-card {
                min-width: 280px;
            }

            .article-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <!-- Hero Section -->
    <div class="hero-modern">
        <div class="container">
            <div class="hero-content text-center">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="Logo PTMSI"
                    style="width:130px; height:130px; border-radius:50%; border:6px solid #fff; background:#fff; margin-bottom:30px; box-shadow: 0 15px 40px rgba(0,0,0,0.18); animation: bounce 2s ease-in-out infinite;">
                <h1 class="hero-title">PTMSI Sumatera Barat</h1>
                <p class="hero-subtitle">Membangun Prestasi Tenis Meja Indonesia dari Ranah Minang</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap mt-4">
                    <a href="<?= base_url('layanan-online') ?>" class="btn-modern-primary">
                        <i class="bi bi-person-plus"></i> Daftar Atlet & Pelatih
                    </a>
                    <a href="<?= base_url('event') ?>" class="btn-secondary-modern">
                        <i class="bi bi-calendar-event"></i> Event & Kejuaraan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Timeline Section -->
        <div class="timeline-section">
            <div class="timeline-header">
                <h2><i class="bi bi-clock-history"></i> Sejarah Hari Ini</h2>
                <p>Peristiwa penting dalam dunia tenis meja Indonesia</p>
            </div>
            <div class="timeline-container">
                <div class="timeline-slider">
                    <div class="timeline-card">
                        <div class="timeline-date">1963</div>
                        <div class="timeline-title">Berdirinya PTMSI</div>
                        <div class="timeline-desc">Persatuan Tenis Meja Seluruh Indonesia didirikan sebagai induk organisasi tenis meja nasional</div>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-date">1972</div>
                        <div class="timeline-title">Bergabung dengan ITTF</div>
                        <div class="timeline-desc">Indonesia resmi menjadi anggota International Table Tennis Federation</div>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-date">1985</div>
                        <div class="timeline-title">PTMSI Sumbar Berdiri</div>
                        <div class="timeline-desc">Pengurus Daerah PTMSI Sumatera Barat resmi dibentuk untuk mengembangkan tenis meja di wilayah Sumbar</div>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-date">2020</div>
                        <div class="timeline-title">Era Digital</div>
                        <div class="timeline-desc">Peluncuran sistem digital untuk pendaftaran atlet dan manajemen turnamen modern</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Content -->
        <div class="featured-grid">
            <div class="featured-main">
                <div class="featured-image">
                    <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Pelatihan Wasit PTMSI">
                    <div class="featured-badge">FEATURED</div>
                </div>
                <div class="featured-content">
                    <div class="featured-title">Pelatihan Wasit & Ofisial Tenis Meja Tingkat Provinsi</div>
                    <div class="featured-desc">Program pelatihan komprehensif untuk meningkatkan kualitas wasit dan ofisial tenis meja di Sumatera Barat. Kegiatan ini melibatkan instruktur bersertifikat nasional.</div>
                    <div class="featured-meta">
                        <span><i class="bi bi-calendar"></i> 15 November 2024</span>
                        <span><i class="bi bi-geo-alt"></i> Bintan Center</span>
                    </div>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-card">
                    <div class="sidebar-title">
                        <i class="bi bi-trophy"></i> Prestasi Terbaru
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Juara 1 Kejurnas Junior</div>
                        <div class="sidebar-item-meta">Atlet Sumbar meraih emas</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Best Organizer Award</div>
                        <div class="sidebar-item-meta">PTMSI Cup 2024</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Peringkat 3 Nasional</div>
                        <div class="sidebar-item-meta">Kategori pembinaan atlet</div>
                    </div>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-title">
                        <i class="bi bi-graph-up"></i> Statistik
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">150+ Atlet Aktif</div>
                        <div class="sidebar-item-meta">Terdaftar resmi</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">30+ Klub</div>
                        <div class="sidebar-item-meta">Se-Sumatera Barat</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">25+ Event/Tahun</div>
                        <div class="sidebar-item-meta">Turnamen rutin</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Grid -->
        <div class="article-grid">
            <div class="article-card">
                <div class="article-image">
                    <img src="<?= base_url('assets/img/PTMSI Cup.jpg') ?>" alt="PTMSI Cup"
                        onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg, #1E90FF, #00BFFF)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bi bi-trophy\' style=\'font-size:3rem;margin-bottom:10px;\'></i><h5>PTMSI Cup</h5></div>'">
                </div>
                <div class="article-content">
                    <div class="article-category">TURNAMEN</div>
                    <div class="article-title">PTMSI Cup 2024 Sukses Digelar</div>
                    <div class="article-excerpt">Turnamen tenis meja terbesar di Sumatera Barat berhasil mempertandingkan 200+ atlet dari berbagai klub...</div>
                    <div class="article-meta">
                        <span><i class="bi bi-calendar"></i> 20 Nov 2024</span>
                        <span><i class="bi bi-eye"></i> 1.2k views</span>
                    </div>
                </div>
            </div>

            <div class="article-card">
                <div class="article-image" style="background:linear-gradient(135deg, #00BFFF, #1E90FF);position:relative;min-height:180px;display:flex;align-items:center;justify-content:center;">
                    <div style="text-align:center;color:white;">
                        <i class="bi bi-people" style="font-size:3rem;margin-bottom:10px;"></i>
                        <h5>Pembinaan</h5>
                    </div>
                </div>
                <div class="article-content">
                    <div class="article-category">PEMBINAAN</div>
                    <div class="article-title">Program Talent Scouting Atlet Muda</div>
                    <div class="article-excerpt">PTMSI Sumbar meluncurkan program pencarian bakat untuk mengidentifikasi atlet muda berbakat...</div>
                    <div class="article-meta">
                        <span><i class="bi bi-calendar"></i> 18 Nov 2024</span>
                        <span><i class="bi bi-eye"></i> 890 views</span>
                    </div>
                </div>
            </div>

            <div class="article-card">
                <div class="article-image">
                    <img src="<?= base_url('assets/img/pengurus-ptmsi.jpg') ?>" alt="Pengurus PTMSI"
                        onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg, #003366, #1E90FF)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bi bi-people-fill\' style=\'font-size:3rem;margin-bottom:10px;\'></i><h5>Pengurus</h5></div>'">
                </div>
                <div class="article-content">
                    <div class="article-category">ORGANISASI</div>
                    <div class="article-title">Rapat Koordinasi Pengurus Daerah</div>
                    <div class="article-excerpt">Evaluasi program kerja 2024 dan penyusunan rencana strategis untuk tahun mendatang...</div>
                    <div class="article-meta">
                        <span><i class="bi bi-calendar"></i> 15 Nov 2024</span>
                        <span><i class="bi bi-eye"></i> 650 views</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="social-section">
            <div class="social-title">
                <i class="bi bi-share"></i> Ikuti Media Sosial Kami
            </div>
            <p style="font-size: 1.1rem; margin-bottom: 30px; position: relative; z-index: 1;">
                Dapatkan update terbaru tentang kegiatan dan prestasi PTMSI Sumbar
            </p>
            <div class="social-links">
                <a href="#" class="social-link" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="social-link" title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="social-link" title="YouTube">
                    <i class="bi bi-youtube"></i>
                </a>
                <a href="#" class="social-link" title="Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="social-link" title="WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </div>
        </div>

    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Smooth scroll untuk link internal
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>