<?= $this->extend('layouts/public_main') ?>

<?= $this->section('css') ?>
<style>
    :root {
        --primary: #f59e0b;
        --secondary: #d97706;
        --text-primary: #e5e7eb;
        --text-secondary: #9ca3af;
        --surface: #1e293b;
        --border-color: rgba(245, 158, 11, 0.1);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
        color: var(--text-primary);
    }

    /* Hero Section */
    .hero-section {
        min-height: 60vh;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 4rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 900;
        margin-bottom: 1rem;
        color: white;
        letter-spacing: -1px;
    }

    .hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.3rem);
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-modern {
        padding: 0.9rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: white;
        color: #d97706;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid white;
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    /* Quick Stats */
    .stats-section {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-top: 1px solid rgba(245, 158, 11, 0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .stat-card {
        text-align: center;
        padding: 1.5rem;
        background: var(--surface);
        border-radius: 15px;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: rgba(245, 158, 11, 0.3);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: #f59e0b;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.95rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Features Section */
    .features-section {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #111827 0%, #0f172a 100%);
        border-top: 1px solid rgba(245, 158, 11, 0.1);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 900;
        color: #f59e0b;
        text-align: center;
        margin-bottom: 2rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: var(--surface);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        text-align: center;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        border-color: rgba(245, 158, 11, 0.3);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.1);
    }

    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: inline-block;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .feature-description {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* CTA Section */
    .cta-section {
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        text-align: center;
        border-top: 1px solid rgba(245, 158, 11, 0.1);
    }

    .cta-title {
        font-size: 2rem;
        font-weight: 900;
        color: white;
        margin-bottom: 1rem;
    }

    .cta-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 2rem;
    }

    .cta-button {
        background: white;
        color: #d97706;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .stats-grid,
        .features-grid {
            grid-template-columns: 1fr;
        }

        .hero-cta {
            flex-direction: column;
            align-items: center;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Selamat Datang di PTMSI Sumbar</h1>
        <p class="hero-subtitle">Platform Resmi Persatuan Tenis Meja Seluruh Indonesia Sumatera Barat</p>
        <div class="hero-cta">
            <a href="<?= base_url('event') ?>" class="btn-modern btn-primary">
                <i class='bx bx-trophy'></i> Lihat Event
            </a>
            <a href="<?= base_url('ranking') ?>" class="btn-modern btn-secondary">
                <i class='bx bx-chart-line'></i> Ranking
            </a>
        </div>
    </div>
</section>

<!-- Quick Stats -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">150+</div>
            <div class="stat-label">Atlet Terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">45+</div>
            <div class="stat-label">Klub Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">25+</div>
            <div class="stat-label">Event Tahunan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">12</div>
            <div class="stat-label">Kabupaten/Kota</div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <h2 class="section-title">Fitur Utama</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class='bx bx-trophy'></i>
            </div>
            <h3 class="feature-title">Event & Turnamen</h3>
            <p class="feature-description">Ikuti berbagai event dan turnamen tenis meja di seluruh Sumatera Barat</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class='bx bx-chart-line'></i>
            </div>
            <h3 class="feature-title">Ranking Atlet</h3>
            <p class="feature-description">Lihat peringkat atlet terbaik dan statistik pertandingan secara real-time</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class='bx bx-news'></i>
            </div>
            <h3 class="feature-title">Berita & Update</h3>
            <p class="feature-description">Dapatkan informasi terbaru tentang perkembangan tenis meja di Sumbar</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class='bx bx-image'></i>
            </div>
            <h3 class="feature-title">Galeri Foto</h3>
            <p class="feature-description">Koleksi foto dan video dari berbagai event dan pertandingan</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class='bx bx-file'></i>
            </div>
            <h3 class="feature-title">Dokumen</h3>
            <p class="feature-description">Akses peraturan, panduan, dan dokumen resmi PTMSI</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class='bx bx-play-circle'></i>
            </div>
            <h3 class="feature-title">Live Scoring</h3>
            <p class="feature-description">Pantau skor pertandingan secara langsung dan real-time</p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <h2 class="cta-title">Bergabunglah dengan Komunitas Kami</h2>
    <p class="cta-subtitle">Daftarkan diri Anda sebagai atlet, pelatih, atau klub untuk mengikuti event</p>
    <a href="<?= base_url('auth/login') ?>" class="cta-button">Mulai Sekarang</a>
</section>

<?= $this->endSection() ?>