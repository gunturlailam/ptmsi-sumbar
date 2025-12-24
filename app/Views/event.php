<?= $this->extend('layouts/public_main') ?>

<?= $this->section('css') ?>
<style>
    /* CSS Variables */
    :root {
        --primary: #f59e0b;
        --secondary: #d97706;
        --primary-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-gradient: linear-gradient(135deg, #111827 0%, #0f172a 100%);
        --glass-bg: rgba(245, 158, 11, 0.1);
        --glass-border: rgba(245, 158, 11, 0.2);
        --text-primary: #e5e7eb;
        --text-secondary: #9ca3af;
        --surface: #1e293b;
        --surface-hover: #334155;
        --border-color: rgba(245, 158, 11, 0.1);
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.3), 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
        color: var(--text-primary);
        line-height: 1.6;
        overflow-x: hidden;
    }

    /* Hero Section - Modern 2025 Design */
    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, #111827 0%, #0f172a 100%);
        position: relative;
        display: flex;
        align-items: center;
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
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }

    .hero-logo {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        margin: 0 auto 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-xl);
    }

    .hero-logo img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: clamp(1.1rem, 2.5vw, 1.5rem);
        font-weight: 400;
        margin-bottom: 3rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-modern {
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary-modern {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-primary-modern:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .btn-secondary-modern {
        background: white;
        color: #667eea;
        box-shadow: var(--shadow-lg);
    }

    .btn-secondary-modern:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
        color: #667eea;
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.8);
    }

    /* Glass Cards */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Stats Section */
    .stats-section {
        padding: 5rem 0;
        background: white;
        position: relative;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
        border-radius: 20px;
        background: white;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 900;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1.1rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Features Section */
    .features-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .feature-description {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .feature-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .feature-link:hover {
        color: #5a67d8;
        transform: translateX(5px);
    }

    /* Event Cards */
    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .event-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .event-header {
        background: var(--primary-gradient);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .event-date {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
    }

    .event-month {
        font-size: 1rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .event-content {
        padding: 2rem;
    }

    .event-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

    .event-meta i {
        color: #667eea;
        width: 16px;
    }

    .badge-tingkat {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-top: 1rem;
    }

    .badge-provinsi {
        background: var(--success-gradient);
        color: white;
    }

    .badge-nasional {
        background: var(--secondary-gradient);
        color: white;
    }

    .badge-open {
        background: var(--dark-gradient);
        color: white;
    }

    /* News Section */
    .news-section {
        padding: 5rem 0;
        background: white;
    }

    .news-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
        margin-top: 3rem;
    }

    .news-main {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .news-main:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .news-image {
        height: 300px;
        background: var(--primary-gradient);
        position: relative;
        overflow: hidden;
    }

    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .news-main:hover .news-image img {
        transform: scale(1.05);
    }

    .news-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .news-content {
        padding: 2rem;
    }

    .news-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .news-excerpt {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .news-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    /* Sidebar */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .sidebar-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-item {
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .sidebar-item:last-child {
        border-bottom: none;
    }

    .sidebar-item:hover {
        padding-left: 1rem;
        background: var(--surface-hover);
        border-radius: 10px;
    }

    .sidebar-item-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .sidebar-item-meta {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    /* CTA Section */
    .cta-section {
        padding: 5rem 0;
        background: var(--primary-gradient);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="b" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="100" cy="100" r="80" fill="url(%23b)"/><circle cx="900" cy="200" r="120" fill="url(%23b)"/><circle cx="300" cy="800" r="100" fill="url(%23b)"/></svg>');
    }

    .cta-content {
        position: relative;
        z-index: 2;
    }

    .cta-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .cta-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
    }

    .social-link {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .social-link:hover {
        background: white;
        color: #667eea;
        transform: translateY(-3px);
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.25rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Filter Tabs */
    .filter-tabs {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .filter-tab {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 4rem;
        color: #667eea;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state h5 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 80vh;
            padding: 2rem 0;
        }

        .news-grid {
            grid-template-columns: 1fr;
        }

        .feature-grid {
            grid-template-columns: 1fr;
        }

        .event-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-cta {
            flex-direction: column;
            align-items: center;
        }

        .btn-modern {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }

        .filter-tabs {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .filter-tab {
            flex-shrink: 0;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Loading Animation */
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

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <div class="hero-logo">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="Logo PTMSI Sumbar">
            </div>
            <h1 class="hero-title">Kejuaraan & Event</h1>
            <p class="hero-subtitle">Platform digital terdepan untuk kejuaraan, turnamen, dan event tenis meja PTMSI Sumatera Barat dengan sistem manajemen modern</p>
            <div class="hero-cta">
                <a href="<?= base_url('tournament') ?>" class="btn-modern btn-primary-modern">
                    <i class="bx bx-trophy"></i> Lihat Turnamen
                </a>
                <a href="<?= base_url('layanan-online') ?>" class="btn-modern btn-secondary-modern">
                    <i class="bx bx-user-plus"></i> Daftar Event
                </a>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <i class="bx bx-chevron-down" style="font-size: 2rem;"></i>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title">Statistik Event & Turnamen</h2>
            <p class="section-subtitle">Data terkini mengenai kegiatan kejuaraan dan turnamen tenis meja</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: var(--primary-gradient);">
                    <i class="bx bx-calendar-event"></i>
                </div>
                <div class="stat-number">25+</div>
                <div class="stat-label">Event per Tahun</div>
            </div>
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: var(--secondary-gradient);">
                    <i class="bx bx-trophy"></i>
                </div>
                <div class="stat-number">500+</div>
                <div class="stat-label">Peserta Aktif</div>
            </div>
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: var(--success-gradient);">
                    <i class="bx bx-medal"></i>
                </div>
                <div class="stat-number">15+</div>
                <div class="stat-label">Kategori Pertandingan</div>
            </div>
            <div class="stat-card fade-in">
                <div class="stat-icon" style="background: var(--dark-gradient);">
                    <i class="bx bx-buildings"></i>
                </div>
                <div class="stat-number">30+</div>
                <div class="stat-label">Klub Terdaftar</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title">Layanan Event Management</h2>
            <p class="section-subtitle">Sistem manajemen event terintegrasi untuk kemudahan pengelolaan turnamen</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card fade-in">
                <div class="feature-icon" style="background: var(--primary-gradient);">
                    <i class="bx bx-calendar-plus"></i>
                </div>
                <h3 class="feature-title">Pendaftaran Online</h3>
                <p class="feature-description">Sistem pendaftaran turnamen yang mudah dan cepat dengan verifikasi otomatis dan pembayaran digital.</p>
                <a href="<?= base_url('tournament') ?>" class="feature-link">Daftar Turnamen <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon" style="background: var(--secondary-gradient);">
                    <i class="bx bx-sitemap"></i>
                </div>
                <h3 class="feature-title">Sistem Bracket</h3>
                <p class="feature-description">Bracket otomatis dengan sistem eliminasi yang fair dan transparan untuk semua kategori pertandingan.</p>
                <a href="<?= base_url('event/bracket') ?>" class="feature-link">Lihat Bracket <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon" style="background: var(--success-gradient);">
                    <i class="bx bx-line-chart"></i>
                </div>
                <h3 class="feature-title">Live Scoring</h3>
                <p class="feature-description">Sistem skor real-time yang memungkinkan peserta dan penonton mengikuti perkembangan pertandingan.</p>
                <a href="<?= base_url('ranking') ?>" class="feature-link">Lihat Hasil <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon" style="background: var(--dark-gradient);">
                    <i class="bx bx-file-blank"></i>
                </div>
                <h3 class="feature-title">Dokumen Event</h3>
                <p class="feature-description">Akses mudah ke juklak, juknis, dan dokumen resmi untuk setiap event dan turnamen.</p>
                <a href="<?= base_url('dokumen') ?>" class="feature-link">Download Dokumen <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Event Calendar Section -->
<section class="news-section">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title">Kalender Event & Turnamen</h2>
            <p class="section-subtitle">Jadwal lengkap kejuaraan dan turnamen tenis meja terbaru</p>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs fade-in">
            <button class="filter-tab active" data-filter="all">
                <i class="bx bx-grid-alt"></i> Semua Event
            </button>
            <button class="filter-tab" data-filter="provinsi">
                <i class="bx bx-map"></i> Tingkat Provinsi
            </button>
            <button class="filter-tab" data-filter="nasional">
                <i class="bx bx-flag"></i> Tingkat Nasional
            </button>
            <button class="filter-tab" data-filter="open">
                <i class="bx bx-trophy"></i> Open Tournament
            </button>
        </div>

        <!-- Teaser Turnamen Aktif (gaya ringkas dari halaman tournament) -->
        <?php if (!empty($turnamen_tersedia)): ?>
            <div class="fade-in" style="margin-bottom: 3rem;">
                <div class="section-header">
                    <h3 class="section-title" style="font-size: 2rem;">Turnamen Aktif</h3>
                    <p class="section-subtitle">Beberapa turnamen yang sedang membuka pendaftaran</p>
                </div>
                <div class="event-grid">
                    <?php foreach (array_slice($turnamen_tersedia, 0, 3) as $turnamen): ?>
                        <?php
                        $tmDate = date('Y-m-d', strtotime($turnamen['tanggal_mulai'] . ' -1 day'));
                        $tmDateTime = $tmDate . ' 19:00:00';
                        $sisaKuota = $turnamen['sisa_kuota'] ?? 0;
                        ?>
                        <div class="event-card">
                            <div class="event-header">
                                <div class="event-date"><?= date('d', strtotime($turnamen['tanggal_mulai'])) ?></div>
                                <div class="event-month"><?= date('M Y', strtotime($turnamen['tanggal_mulai'])) ?></div>
                            </div>
                            <div class="event-content">
                                <h5 class="event-title"><?= esc($turnamen['nama_event'] ?? $turnamen['judul']) ?></h5>
                                <div class="event-meta">
                                    <i class="bx bx-calendar"></i>
                                    <span><?= date('d M Y', strtotime($turnamen['tanggal_mulai'])) ?> - <?= date('d M Y', strtotime($turnamen['tanggal_selesai'])) ?></span>
                                </div>
                                <div class="event-meta">
                                    <i class="bx bx-time-five"></i>
                                    <span>Daftar s/d <?= date('d M Y H:i', strtotime($turnamen['batas_pendaftaran'])) ?></span>
                                </div>
                                <div class="event-meta">
                                    <i class="bx bx-group"></i>
                                    <span>Technical Meeting: <?= date('d M Y H:i', strtotime($tmDateTime)) ?></span>
                                </div>
                                <div class="event-meta">
                                    <i class="bx bx-map"></i>
                                    <span><?= esc($turnamen['lokasi'] ?? 'Lokasi TBA') ?></span>
                                </div>
                                <div class="event-meta">
                                    <i class="bx bx-user"></i>
                                    <span>Sisa kuota: <?= $sisaKuota > 0 ? $sisaKuota . ' slot' : 'Kuota penuh' ?></span>
                                </div>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <span class="badge-tingkat badge-<?= strtolower($turnamen['tingkat'] ?? 'provinsi') ?>">
                                        <?= esc(ucfirst($turnamen['tingkat'] ?? 'Provinsi')) ?>
                                    </span>
                                    <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>" class="btn-modern btn-secondary-modern" style="padding: 0.5rem 1.25rem; font-size: 0.9rem;">
                                        <i class="bx bx-right-arrow-alt"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($events)): ?>
            <div class="event-grid">
                <?php foreach ($events as $event): ?>
                    <div class="event-card fade-in" data-tingkat="<?= strtolower($event['tingkat']) ?>">
                        <div class="event-header">
                            <div class="event-date"><?= date('d', strtotime($event['tanggal_mulai'])) ?></div>
                            <div class="event-month"><?= date('M Y', strtotime($event['tanggal_mulai'])) ?></div>
                        </div>
                        <div class="event-content">
                            <h5 class="event-title"><?= esc($event['judul']) ?></h5>
                            <div class="event-meta">
                                <i class="bx bx-map"></i>
                                <span><?= esc($event['lokasi'] ?? 'Lokasi TBA') ?></span>
                            </div>
                            <div class="event-meta">
                                <i class="bx bx-calendar"></i>
                                <span><?= date('d M', strtotime($event['tanggal_mulai'])) ?> - <?= date('d M Y', strtotime($event['tanggal_selesai'])) ?></span>
                            </div>
                            <div class="event-meta">
                                <i class="bx bx-buildings"></i>
                                <span><?= esc($event['nama_klub_penyelenggara'] ?? 'PTMSI Sumbar') ?></span>
                            </div>
                            <div class="text-center">
                                <span class="badge-tingkat badge-<?= strtolower($event['tingkat']) ?>">
                                    <?= esc($event['tingkat']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state fade-in">
                <i class="bx bx-calendar-x"></i>
                <h5>Belum Ada Event Terjadwal</h5>
                <p>Kalender event akan ditampilkan di sini ketika ada turnamen yang dijadwalkan</p>
            </div>
        <?php endif; ?>

        <div class="news-grid" style="margin-top: 4rem;">
            <div class="news-main fade-in">
                <div class="news-image">
                    <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Turnamen Tenis Meja" onerror="this.style.display='none'; this.parentElement.style.background='var(--primary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-trophy\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Turnamen Terbuka</h4></div>'">
                    <div class="news-badge">FEATURED</div>
                </div>
                <div class="news-content">
                    <h3 class="news-title">Turnamen Terbuka Sumatera Barat 2025</h3>
                    <p class="news-excerpt">Turnamen terbuka terbesar di Sumatera Barat dengan hadiah total Rp 100 juta. Terbuka untuk semua kategori usia dengan sistem pertandingan internasional dan wasit bersertifikat.</p>
                    <div class="news-meta">
                        <span><i class="bx bx-calendar"></i> 15-17 Februari 2025</span>
                        <span><i class="bx bx-map-pin"></i> GOR Haji Agus Salim</span>
                        <span><i class="bx bx-trophy"></i> 12 Kategori</span>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar-card fade-in">
                    <h4 class="sidebar-title"><i class="bx bx-calendar-check"></i> Event Mendatang</h4>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Kejuaraan Antar Klub</div>
                        <div class="sidebar-item-meta">25 Desember 2024</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Pelatihan Wasit Level 2</div>
                        <div class="sidebar-item-meta">5 Januari 2025</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Turnamen Junior U-15</div>
                        <div class="sidebar-item-meta">20 Januari 2025</div>
                    </div>
                </div>
                <div class="sidebar-card fade-in">
                    <h4 class="sidebar-title"><i class="bx bx-trophy"></i> Juara Terbaru</h4>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Kejurprov Senior 2024</div>
                        <div class="sidebar-item-meta">Juara: Ahmad Rizki (Padang)</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Turnamen Veteran</div>
                        <div class="sidebar-item-meta">Juara: Budi Santoso (Bukittinggi)</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Kejuaraan Junior</div>
                        <div class="sidebar-item-meta">Juara: Sari Indah (Payakumbuh)</div>
                    </div>
                </div>
                <div class="sidebar-card fade-in">
                    <h4 class="sidebar-title"><i class="bx bx-download"></i> Dokumen Event</h4>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Formulir Pendaftaran Turnamen</div>
                        <div class="sidebar-item-meta">PDF • 1.2 MB</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Peraturan Pertandingan 2025</div>
                        <div class="sidebar-item-meta">PDF • 2.8 MB</div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-title">Panduan Sistem Bracket</div>
                        <div class="sidebar-item-meta">PDF • 1.5 MB</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content fade-in">
            <h2 class="cta-title">Siap Berkompetisi di Level Tertinggi?</h2>
            <p class="cta-subtitle">Bergabunglah dengan turnamen dan event tenis meja terbaik di Sumatera Barat</p>
            <div class="hero-cta">
                <a href="<?= base_url('tournament') ?>" class="btn-modern btn-primary-modern">
                    <i class="bx bx-trophy"></i> Daftar Turnamen
                </a>
                <a href="<?= base_url('hubungi-kami') ?>" class="btn-modern btn-secondary-modern">
                    <i class="bx bx-phone"></i> Hubungi Kami
                </a>
            </div>
            <div class="social-links">
                <a href="#" class="social-link" title="Facebook">
                    <i class="bx bxl-facebook"></i>
                </a>
                <a href="#" class="social-link" title="Instagram">
                    <i class="bx bxl-instagram"></i>
                </a>
                <a href="#" class="social-link" title="YouTube">
                    <i class="bx bxl-youtube"></i>
                </a>
                <a href="#" class="social-link" title="Twitter">
                    <i class="bx bxl-twitter"></i>
                </a>
                <a href="#" class="social-link" title="WhatsApp">
                    <i class="bx bxl-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fix navbar z-index and ensure it works properly
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure navbar is properly initialized
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            navbar.style.zIndex = '1055';
            navbar.style.position = 'relative';
        }

        // Initialize all Bootstrap dropdowns
        const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
        const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));

        // Fix navbar collapse for mobile
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');

        if (navbarToggler && navbarCollapse) {
            navbarToggler.addEventListener('click', function() {
                navbarCollapse.classList.toggle('show');
            });

            // Close navbar when clicking outside
            document.addEventListener('click', function(event) {
                if (!navbar.contains(event.target)) {
                    navbarCollapse.classList.remove('show');
                }
            });

            // Close navbar when clicking on nav links
            const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navbarCollapse.classList.remove('show');
                });
            });
        }

        // Filter tabs functionality
        const filterTabs = document.querySelectorAll('.filter-tab');
        const eventCards = document.querySelectorAll('.event-card');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                eventCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        const tingkat = card.getAttribute('data-tingkat');
                        card.style.display = tingkat === filter ? 'block' : 'none';
                    }
                });
            });
        });

        // Ensure dropdown menus work properly
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');

            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close other dropdowns
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.querySelector('.dropdown-menu')?.classList.remove('show');
                        }
                    });

                    // Toggle current dropdown
                    menu.classList.toggle('show');
                });
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                dropdowns.forEach(dropdown => {
                    dropdown.querySelector('.dropdown-menu')?.classList.remove('show');
                });
            }
        });

        // Fix dropdown menu positioning and z-index
        dropdowns.forEach(dropdown => {
            const menu = dropdown.querySelector('.dropdown-menu');
            if (menu) {
                menu.style.zIndex = '1056';
                menu.style.position = 'absolute';
            }
        });
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = `${Math.random() * 0.3}s`;
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    // Observe all elements with fade-in class
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll for internal links
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

    // Add loading states to buttons
    document.querySelectorAll('.btn-modern').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('#')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Loading...';
                this.style.pointerEvents = 'none';

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.pointerEvents = 'auto';
                }, 2000);
            }
        });
    });

    // Counter animation for stats
    const animateCounters = () => {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/\D/g, ''));
            const increment = target / 100;
            let current = 0;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current) + '+';
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target + '+';
                }
            };

            updateCounter();
        });
    };

    // Trigger counter animation when stats section is visible
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        statsObserver.observe(statsSection);
    }
</script>

<?= $this->endSection() ?>