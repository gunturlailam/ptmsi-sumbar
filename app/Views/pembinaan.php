<?= $this->extend('layouts/public_main') ?>

<?= $this->section('css') ?>
<style>
    :root {
        --primary: #f59e0b;
        --secondary: #d97706;
        --primary-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-gradient: linear-gradient(135deg, #111827 0%, #0f172a 100%);
        --text-primary: #e5e7eb;
        --text-secondary: #9ca3af;
        --border-color: rgba(245, 158, 11, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
    }

    .hero-section {
        background: var(--primary-gradient);
        color: white;
        padding: 6rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(245, 158, 11, 0.1);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="200" cy="200" r="100" fill="rgba(255,255,255,0.1)"/><circle cx="800" cy="300" r="150" fill="rgba(255,255,255,0.1)"/></svg>');
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .nav-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        text-decoration: none;
        display: block;
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
    }

    .nav-card:hover {
        background: var(--primary-gradient);
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
        border-color: transparent;
    }

    .nav-card:hover .nav-icon {
        background: white;
    }

    .nav-card:hover .nav-icon i {
        color: #667eea;
    }

    .nav-card:hover h6,
    .nav-card:hover p {
        color: white;
    }

    .nav-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .nav-icon i {
        font-size: 2rem;
        color: white;
    }

    .nav-card h6 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .nav-card p {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin: 0;
    }

    .section-card {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: var(--shadow-lg);
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: #667eea;
        font-size: 2rem;
    }

    .program-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border-left: 4px solid #667eea;
        height: 100%;
    }

    .program-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .program-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .program-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .program-info {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        color: var(--text-secondary);
    }

    .program-info i {
        color: #667eea;
        margin-right: 0.75rem;
    }

    .activity-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        border: 2px solid var(--border-color);
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .activity-card:hover {
        border-color: #667eea;
        transform: translateX(5px);
    }

    .activity-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        background: var(--success-gradient);
        color: white;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .info-box {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: #667eea;
    }

    .info-box i {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 1rem;
        display: block;
    }

    .info-box h5 {
        color: var(--text-primary);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .alert-modern {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border: none;
        border-radius: 15px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .alert-modern i {
        font-size: 1.5rem;
        color: #0284c7;
    }

    .list-modern {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .list-modern li {
        padding: 0.75rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    .list-modern li:last-child {
        border-bottom: none;
    }

    .list-modern li i {
        color: #10b981;
        font-size: 1.25rem;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 2rem;
        }

        .section-card {
            padding: 1.5rem;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <h1 class="hero-title"><i class="bx bx-target-lock"></i> Program Pembinaan</h1>
            <p class="hero-subtitle">Membangun Atlet Tenis Meja Berprestasi dari Sumatera Barat</p>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-3 mb-5 fade-in">
        <div class="col-md-3 col-6">
            <a href="#puslatda" class="nav-card">
                <div class="nav-icon"><i class="bx bx-buildings"></i></div>
                <h6>Puslatda</h6>
                <p>Pemusatan latihan</p>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="#usia-dini" class="nav-card">
                <div class="nav-icon"><i class="bx bx-group"></i></div>
                <h6>Usia Dini</h6>
                <p>Pembinaan U-12</p>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="#talent" class="nav-card">
                <div class="nav-icon"><i class="bx bx-star"></i></div>
                <h6>Talent Scouting</h6>
                <p>Pencarian bakat</p>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="#coaching" class="nav-card">
                <div class="nav-icon"><i class="bx bx-book-reader"></i></div>
                <h6>Coaching Clinic</h6>
                <p>Pelatihan pelatih</p>
            </a>
        </div>
    </div>

    <div id="puslatda" class="section-card fade-in">
        <h2 class="section-title"><i class="bx bx-buildings"></i> Puslatda</h2>
        <div class="alert-modern">
            <i class="bx bx-info-circle"></i>
            <div><strong>Puslatda</strong> adalah program pemusatan latihan untuk atlet-atlet terbaik Sumatera Barat.</div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="program-card">
                    <div class="program-icon"><i class="bx bx-calendar"></i></div>
                    <h4 class="program-title">Puslatda Reguler</h4>
                    <div class="program-info"><i class="bx bx-time"></i><span>Senin - Jumat, 16:00 - 19:00</span></div>
                    <div class="program-info"><i class="bx bx-map"></i><span>GOR Haji Agus Salim</span></div>
                    <div class="program-info"><i class="bx bx-group"></i><span>25 Atlet Terpilih</span></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="program-card">
                    <div class="program-icon" style="background: var(--secondary-gradient);"><i class="bx bx-trophy"></i></div>
                    <h4 class="program-title">Puslatda Intensif</h4>
                    <div class="program-info"><i class="bx bx-time"></i><span>2 Bulan Sebelum Event</span></div>
                    <div class="program-info"><i class="bx bx-map"></i><span>Lokasi Disesuaikan</span></div>
                    <div class="program-info"><i class="bx bx-group"></i><span>15-20 Atlet</span></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="program-card">
                    <div class="program-icon" style="background: var(--success-gradient);"><i class="bx bx-run"></i></div>
                    <h4 class="program-title">Puslatda Junior</h4>
                    <div class="program-info"><i class="bx bx-time"></i><span>Sabtu - Minggu, 08:00 - 12:00</span></div>
                    <div class="program-info"><i class="bx bx-map"></i><span>GOR Haji Agus Salim</span></div>
                    <div class="program-info"><i class="bx bx-group"></i><span>30 Atlet U-12 & U-15</span></div>
                </div>
            </div>
        </div>
    </div>

    <div id="usia-dini" class="section-card fade-in">
        <h2 class="section-title"><i class="bx bx-group"></i> Pembinaan Usia Dini</h2>
        <div class="activity-card">
            <div class="d-flex align-items-start gap-3">
                <div class="activity-icon"><i class="bx bx-joystick"></i></div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold text-primary mb-2">Kelas Fun Table Tennis</h5>
                    <span class="badge-status me-2">Aktif</span>
                    <span class="text-muted">Setiap Sabtu | 09:00 - 11:00 WIB | Usia 6-9 tahun</span>
                </div>
            </div>
        </div>
        <div class="activity-card">
            <div class="d-flex align-items-start gap-3">
                <div class="activity-icon" style="background: var(--secondary-gradient);"><i class="bx bx-trophy"></i></div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold text-primary mb-2">Kelas Teknik Dasar U-12</h5>
                    <span class="badge-status me-2">Berlangsung</span>
                    <span class="text-muted">Senin, Rabu, Jumat | 15:00 - 17:00 WIB</span>
                </div>
            </div>
        </div>
    </div>

    <div id="talent" class="section-card fade-in">
        <h2 class="section-title"><i class="bx bx-star"></i> Talent Scouting</h2>
        <div class="info-grid">
            <div class="info-box">
                <i class="bx bx-search-alt"></i>
                <h5>Seleksi Terbuka</h5>
                <p>Seleksi untuk atlet muda berbakat dari seluruh Sumbar</p>
            </div>
            <div class="info-box">
                <i class="bx bx-clipboard"></i>
                <h5>Tes Kemampuan</h5>
                <p>Tes fisik, teknik, dan mental untuk menilai potensi</p>
            </div>
            <div class="info-box">
                <i class="bx bx-trending-up"></i>
                <h5>Pembinaan Lanjut</h5>
                <p>Program pembinaan khusus untuk atlet terpilih</p>
            </div>
        </div>
    </div>

    <div id="coaching" class="section-card fade-in">
        <h2 class="section-title"><i class="bx bx-award"></i> Coaching Clinic</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="program-card">
                    <div class="program-icon"><i class="bx bx-book-reader"></i></div>
                    <h4 class="program-title">Pelatihan Pelatih</h4>
                    <ul class="list-modern">
                        <li><i class="bx bx-check-circle"></i> Pelatihan Teknik Modern</li>
                        <li><i class="bx bx-check-circle"></i> Strategic Coaching</li>
                        <li><i class="bx bx-check-circle"></i> Sport Psychology</li>
                        <li><i class="bx bx-check-circle"></i> Sertifikasi Pelatih</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="program-card">
                    <div class="program-icon" style="background: var(--dark-gradient);"><i class="bx bx-flag"></i></div>
                    <h4 class="program-title">Pelatihan Wasit</h4>
                    <ul class="list-modern">
                        <li><i class="bx bx-check-circle"></i> Peraturan Pertandingan</li>
                        <li><i class="bx bx-check-circle"></i> Teknik Perwasitan</li>
                        <li><i class="bx bx-check-circle"></i> Praktik Lapangan</li>
                        <li><i class="bx bx-check-circle"></i> Sertifikasi Wasit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector(a.getAttribute('href'))?.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
<?= $this->endSection() ?>