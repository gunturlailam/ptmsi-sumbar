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
        --warning-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
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
        border-bottom: 1px solid rgba(245, 158, 11, 0.1);
        background: var(--primary-gradient);
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

    /* Document Cards */
    .document-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: block;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .document-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .document-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        transition: left 0.3s ease;
        z-index: 0;
    }

    .document-card:hover::after {
        left: 0;
    }

    .document-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
        color: white;
        text-decoration: none;
    }

    .document-card>* {
        position: relative;
        z-index: 1;
    }

    .document-card:hover * {
        color: white !important;
    }

    .document-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }

    .document-card:hover .document-icon {
        background: white;
        transform: scale(1.1);
    }

    .document-icon i {
        font-size: 2rem;
        color: white;
        transition: all 0.3s ease;
    }

    .document-card:hover .document-icon i {
        color: #667eea;
    }

    .document-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        text-align: center;
    }

    .document-description {
        color: var(--text-secondary);
        text-align: center;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .document-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 1rem;
    }

    .document-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .download-btn,
    .view-btn {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        flex: 1;
        cursor: pointer;
    }

    .view-btn {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .download-btn:hover,
    .view-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
        text-decoration: none;
    }

    /* Category Sections */
    .category-section {
        margin-bottom: 4rem;
    }

    .category-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .category-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .category-subtitle {
        font-size: 1.1rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Search Box */
    .search-box {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 3rem;
    }

    .search-input {
        border: 2px solid var(--border-color);
        border-radius: 50px;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    /* Stats Cards */
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 900;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 2rem;
        }

        .search-box {
            padding: 1.5rem;
        }

        .document-card {
            padding: 1.5rem;
        }

        .category-title {
            font-size: 1.5rem;
            flex-direction: column;
            gap: 0.5rem;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <h1 class="hero-title">
                <i class="bx bx-file-blank"></i> Dokumen & Regulasi
            </h1>
            <p class="hero-subtitle">Akses mudah ke berbagai dokumen resmi, formulir, dan regulasi PTMSI Sumatera Barat</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container py-5">
    <!-- Search Box -->
    <div class="search-box fade-in">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <input type="text" class="search-input" placeholder="Cari dokumen..." id="searchInput">
            </div>
            <div class="col-lg-4 mt-3 mt-lg-0">
                <button class="download-btn w-100" onclick="searchDocuments()">
                    <i class="bx bx-search"></i> Cari Dokumen
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card fade-in">
                <div class="stats-icon" style="background: var(--primary-gradient);">
                    <i class="bx bx-file"></i>
                </div>
                <div class="stats-number">25+</div>
                <div class="stats-label">Total Dokumen</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card fade-in">
                <div class="stats-icon" style="background: var(--success-gradient);">
                    <i class="bx bx-download"></i>
                </div>
                <div class="stats-number">500+</div>
                <div class="stats-label">Total Download</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card fade-in">
                <div class="stats-icon" style="background: var(--warning-gradient);">
                    <i class="bx bx-category"></i>
                </div>
                <div class="stats-number">5</div>
                <div class="stats-label">Kategori</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card fade-in">
                <div class="stats-icon" style="background: var(--secondary-gradient);">
                    <i class="bx bx-time"></i>
                </div>
                <div class="stats-number">24/7</div>
                <div class="stats-label">Akses Online</div>
            </div>
        </div>
    </div>

    <!-- Peraturan & Regulasi -->
    <div class="category-section">
        <div class="category-header fade-in">
            <h2 class="category-title">
                <i class="bx bx-book"></i> Peraturan & Regulasi
            </h2>
            <p class="category-subtitle">Dokumen peraturan resmi dan regulasi tenis meja</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($peraturan)): ?>
                <?php foreach ($peraturan as $doc): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="document-card fade-in">
                            <div class="document-icon">
                                <i class="bx bx-book"></i>
                            </div>
                            <h5 class="document-title"><?= esc($doc['judul']) ?></h5>
                            <p class="document-description"><?= esc($doc['kategori']) ?></p>
                            <div class="document-meta">
                                <span><i class="bx bx-file-pdf"></i> PDF</span>
                                <span><i class="bx bx-download"></i> File</span>
                            </div>
                            <div class="document-actions">
                                <a href="<?= base_url('dokumen/download/' . $doc['id_dokumen']) ?>" class="download-btn">
                                    <i class="bx bx-download"></i> Download
                                </a>
                                <a href="<?= base_url($doc['file_url']) ?>" class="view-btn" target="_blank">
                                    <i class="bx bx-show"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bx bx-file"></i>
                        <h5>Tidak ada dokumen</h5>
                        <p>Belum ada dokumen peraturan yang tersedia</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Formulir Pendaftaran -->
    <div class="category-section">
        <div class="category-header fade-in">
            <h2 class="category-title">
                <i class="bx bx-clipboard"></i> Formulir Pendaftaran
            </h2>
            <p class="category-subtitle">Formulir untuk pendaftaran atlet, pelatih, dan klub</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($formulir)): ?>
                <?php foreach ($formulir as $doc): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="document-card fade-in">
                            <div class="document-icon">
                                <i class="bx bx-clipboard"></i>
                            </div>
                            <h5 class="document-title"><?= esc($doc['judul']) ?></h5>
                            <p class="document-description"><?= esc($doc['kategori']) ?></p>
                            <div class="document-meta">
                                <span><i class="bx bx-file-pdf"></i> PDF</span>
                                <span><i class="bx bx-download"></i> File</span>
                            </div>
                            <div class="document-actions">
                                <a href="<?= base_url('dokumen/download/' . $doc['id_dokumen']) ?>" class="download-btn">
                                    <i class="bx bx-download"></i> Download
                                </a>
                                <a href="<?= base_url($doc['file_url']) ?>" class="view-btn" target="_blank">
                                    <i class="bx bx-show"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bx bx-file"></i>
                        <h5>Tidak ada dokumen</h5>
                        <p>Belum ada formulir yang tersedia</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Panduan & Tutorial -->
    <div class="category-section">
        <div class="category-header fade-in">
            <h2 class="category-title">
                <i class="bx bx-book-open"></i> Panduan & Tutorial
            </h2>
            <p class="category-subtitle">Panduan lengkap dan tutorial untuk berbagai keperluan</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($panduan)): ?>
                <?php foreach ($panduan as $doc): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="document-card fade-in">
                            <div class="document-icon">
                                <i class="bx bx-book-open"></i>
                            </div>
                            <h5 class="document-title"><?= esc($doc['judul']) ?></h5>
                            <p class="document-description"><?= esc($doc['kategori']) ?></p>
                            <div class="document-meta">
                                <span><i class="bx bx-file-pdf"></i> PDF</span>
                                <span><i class="bx bx-download"></i> File</span>
                            </div>
                            <div class="document-actions">
                                <a href="<?= base_url('dokumen/download/' . $doc['id_dokumen']) ?>" class="download-btn">
                                    <i class="bx bx-download"></i> Download
                                </a>
                                <a href="<?= base_url($doc['file_url']) ?>" class="view-btn" target="_blank">
                                    <i class="bx bx-show"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bx bx-file"></i>
                        <h5>Tidak ada dokumen</h5>
                        <p>Belum ada panduan yang tersedia</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Laporan -->
    <div class="category-section">
        <div class="category-header fade-in">
            <h2 class="category-title">
                <i class="bx bx-file-blank"></i> Laporan
            </h2>
            <p class="category-subtitle">Laporan kegiatan dan keuangan PTMSI Sumbar</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($laporan)): ?>
                <?php foreach ($laporan as $doc): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="document-card fade-in">
                            <div class="document-icon">
                                <i class="bx bx-file-blank"></i>
                            </div>
                            <h5 class="document-title"><?= esc($doc['judul']) ?></h5>
                            <p class="document-description"><?= esc($doc['kategori']) ?></p>
                            <div class="document-meta">
                                <span><i class="bx bx-file-pdf"></i> PDF</span>
                                <span><i class="bx bx-download"></i> File</span>
                            </div>
                            <div class="document-actions">
                                <a href="<?= base_url('dokumen/download/' . $doc['id_dokumen']) ?>" class="download-btn">
                                    <i class="bx bx-download"></i> Download
                                </a>
                                <a href="<?= base_url($doc['file_url']) ?>" class="view-btn" target="_blank">
                                    <i class="bx bx-show"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bx bx-file"></i>
                        <h5>Tidak ada dokumen</h5>
                        <p>Belum ada laporan yang tersedia</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const documentCards = document.querySelectorAll('.document-card');

        function searchDocuments() {
            const searchTerm = searchInput.value.toLowerCase();

            documentCards.forEach(card => {
                const title = card.querySelector('.document-title').textContent.toLowerCase();
                const description = card.querySelector('.document-description').textContent.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = searchTerm === '' ? 'block' : 'none';
                }
            });
        }

        // Search on input
        searchInput.addEventListener('input', searchDocuments);

        // Search on button click
        window.searchDocuments = searchDocuments;

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
    });
</script>

<?= $this->endSection() ?>