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
        --text-primary: #e5e7eb;
        --text-secondary: #9ca3af;
        --surface: #1e293b;
        --border-color: rgba(245, 158, 11, 0.1);
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
        color: var(--text-primary);
        line-height: 1.6;
    }

    /* Hero Section */
    .hero-section {
        background: var(--primary-gradient);
        border-bottom: 1px solid rgba(245, 158, 11, 0.1);
        color: white;
        padding: 6rem 0 4rem;
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
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: clamp(1.1rem, 2.5vw, 1.5rem);
        font-weight: 400;
        margin-bottom: 2rem;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Profile Cards */
    .profile-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        position: relative;
    }

    .profile-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .profile-image {
        height: 300px;
        background: var(--primary-gradient);
        position: relative;
        overflow: hidden;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-card:hover .profile-image img {
        transform: scale(1.05);
    }

    .profile-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .profile-content {
        padding: 2rem;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .profile-role {
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .profile-stats {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-item {
        text-align: center;
        flex: 1;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .profile-achievements {
        margin-bottom: 1.5rem;
    }

    .achievement-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .achievement-item i {
        color: #667eea;
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
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

    /* Tabs */
    .nav-tabs {
        border: none;
        justify-content: center;
        margin-bottom: 3rem;
    }

    .nav-tabs .nav-link {
        border: none;
        background: white;
        color: var(--text-secondary);
        font-weight: 600;
        padding: 1rem 2rem;
        border-radius: 50px;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .nav-tabs .nav-link.active {
        background: var(--primary-gradient);
        color: white;
        box-shadow: var(--shadow-lg);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 2rem;
        }

        .profile-stats {
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-tabs .nav-link {
            padding: 0.75rem 1.5rem;
            margin: 0.25rem;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <h1 class="hero-title">Atlet & Pelatih</h1>
            <p class="hero-subtitle">Profil lengkap atlet dan pelatih tenis meja terbaik Sumatera Barat yang berprestasi di tingkat nasional dan internasional</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="atlet-tab" data-bs-toggle="tab" data-bs-target="#atlet" type="button" role="tab">
                    <i class="bx bx-run"></i> Atlet
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pelatih-tab" data-bs-toggle="tab" data-bs-target="#pelatih" type="button" role="tab">
                    <i class="bx bx-user-voice"></i> Pelatih
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="profileTabsContent">
            <!-- Atlet Tab -->
            <div class="tab-pane fade show active" id="atlet" role="tabpanel">
                <div class="section-header fade-in">
                    <h2 class="section-title">Atlet Berprestasi</h2>
                    <p class="section-subtitle">Para atlet tenis meja Sumatera Barat yang telah mengharumkan nama daerah</p>
                </div>

                <div class="row g-4">
                    <!-- Atlet Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card fade-in">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Ahmad Rizki" onerror="this.style.display='none'; this.parentElement.style.background='var(--primary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-user\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Ahmad Rizki</h4></div>'">
                                <div class="profile-badge">Atlet</div>
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-name">Ahmad Rizki Pratama</h3>
                                <p class="profile-role">Atlet Tunggal Putra Senior</p>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">15</div>
                                        <div class="stat-label">Medali</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">8</div>
                                        <div class="stat-label">Tahun</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">1850</div>
                                        <div class="stat-label">Rating</div>
                                    </div>
                                </div>
                                <div class="profile-achievements">
                                    <div class="achievement-item">
                                        <i class="bx bx-trophy"></i>
                                        <span>Juara 1 Kejurnas 2024</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-medal"></i>
                                        <span>Medali Emas PON XX Papua</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-star"></i>
                                        <span>Atlet Terbaik Sumbar 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Atlet Card 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card fade-in">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Sari Dewi" onerror="this.style.display='none'; this.parentElement.style.background='var(--secondary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-user\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Sari Dewi</h4></div>'">
                                <div class="profile-badge">Atlet</div>
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-name">Sari Dewi Maharani</h3>
                                <p class="profile-role">Atlet Tunggal Putri Senior</p>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">12</div>
                                        <div class="stat-label">Medali</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">6</div>
                                        <div class="stat-label">Tahun</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">1720</div>
                                        <div class="stat-label">Rating</div>
                                    </div>
                                </div>
                                <div class="profile-achievements">
                                    <div class="achievement-item">
                                        <i class="bx bx-trophy"></i>
                                        <span>Juara 2 Kejurnas 2024</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-medal"></i>
                                        <span>Medali Perak SEA Games</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-star"></i>
                                        <span>Atlet Putri Terbaik 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Atlet Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card fade-in">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Budi Santoso" onerror="this.style.display='none'; this.parentElement.style.background='var(--success-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-user\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Budi Santoso</h4></div>'">
                                <div class="profile-badge">Atlet</div>
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-name">Budi Santoso</h3>
                                <p class="profile-role">Atlet Ganda Putra</p>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">10</div>
                                        <div class="stat-label">Medali</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">5</div>
                                        <div class="stat-label">Tahun</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">1650</div>
                                        <div class="stat-label">Rating</div>
                                    </div>
                                </div>
                                <div class="profile-achievements">
                                    <div class="achievement-item">
                                        <i class="bx bx-trophy"></i>
                                        <span>Juara 1 Ganda Putra 2024</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-medal"></i>
                                        <span>Medali Emas Kejurda</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-star"></i>
                                        <span>Pasangan Ganda Terbaik</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelatih Tab -->
            <div class="tab-pane fade" id="pelatih" role="tabpanel">
                <div class="section-header fade-in">
                    <h2 class="section-title">Pelatih Berpengalaman</h2>
                    <p class="section-subtitle">Para pelatih profesional yang membina atlet-atlet berprestasi</p>
                </div>

                <div class="row g-4">
                    <!-- Pelatih Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card fade-in">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Pak Hendra" onerror="this.style.display='none'; this.parentElement.style.background='var(--dark-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-user-voice\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Hendra Wijaya</h4></div>'">
                                <div class="profile-badge">Pelatih</div>
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-name">Hendra Wijaya, S.Pd</h3>
                                <p class="profile-role">Pelatih Kepala PTMSI Sumbar</p>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">20</div>
                                        <div class="stat-label">Tahun</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">50+</div>
                                        <div class="stat-label">Atlet</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">A</div>
                                        <div class="stat-label">Lisensi</div>
                                    </div>
                                </div>
                                <div class="profile-achievements">
                                    <div class="achievement-item">
                                        <i class="bx bx-trophy"></i>
                                        <span>Pelatih Terbaik Nasional 2023</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-medal"></i>
                                        <span>Lisensi Pelatih Level A</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-star"></i>
                                        <span>20 Tahun Pengalaman</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pelatih Card 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card fade-in">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Bu Rina" onerror="this.style.display='none'; this.parentElement.style.background='var(--secondary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-user-voice\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Rina Sari</h4></div>'">
                                <div class="profile-badge">Pelatih</div>
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-name">Rina Sari, M.Pd</h3>
                                <p class="profile-role">Pelatih Atlet Putri</p>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">15</div>
                                        <div class="stat-label">Tahun</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">30+</div>
                                        <div class="stat-label">Atlet</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">B</div>
                                        <div class="stat-label">Lisensi</div>
                                    </div>
                                </div>
                                <div class="profile-achievements">
                                    <div class="achievement-item">
                                        <i class="bx bx-trophy"></i>
                                        <span>Pelatih Putri Terbaik 2024</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-medal"></i>
                                        <span>Lisensi Pelatih Level B</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-star"></i>
                                        <span>Spesialis Atlet Putri</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pelatih Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card fade-in">
                            <div class="profile-image">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Pak Dedi" onerror="this.style.display='none'; this.parentElement.style.background='var(--success-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-user-voice\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Dedi Kurniawan</h4></div>'">
                                <div class="profile-badge">Pelatih</div>
                            </div>
                            <div class="profile-content">
                                <h3 class="profile-name">Dedi Kurniawan</h3>
                                <p class="profile-role">Pelatih Junior & Yunior</p>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">12</div>
                                        <div class="stat-label">Tahun</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">40+</div>
                                        <div class="stat-label">Atlet</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">C</div>
                                        <div class="stat-label">Lisensi</div>
                                    </div>
                                </div>
                                <div class="profile-achievements">
                                    <div class="achievement-item">
                                        <i class="bx bx-trophy"></i>
                                        <span>Pelatih Junior Terbaik 2023</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-medal"></i>
                                        <span>Lisensi Pelatih Level C</span>
                                    </div>
                                    <div class="achievement-item">
                                        <i class="bx bx-star"></i>
                                        <span>Spesialis Pembinaan Usia Dini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
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

        // Tab switching animation
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function() {
                const targetPane = document.querySelector(this.getAttribute('data-bs-target'));
                const cards = targetPane.querySelectorAll('.profile-card');

                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';

                    setTimeout(() => {
                        card.style.transition = 'all 0.5s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        });
    });
</script>

<?= $this->endSection() ?>