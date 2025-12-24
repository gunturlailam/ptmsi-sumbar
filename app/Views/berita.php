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

    /* News Cards */
    .news-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        position: relative;
        height: 100%;
    }

    .news-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .news-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .news-image {
        height: 250px;
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

    .news-card:hover .news-image img {
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
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-excerpt {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .news-meta i {
        color: #667eea;
    }

    .btn-read-more {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-read-more:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
        text-decoration: none;
    }

    /* Featured News */
    .featured-news {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-xl);
        border: 1px solid var(--border-color);
        position: relative;
    }

    .featured-news::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: var(--primary-gradient);
    }

    .featured-image {
        height: 400px;
        background: var(--primary-gradient);
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
        top: 2rem;
        left: 2rem;
        background: var(--primary-gradient);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
    }

    .featured-content {
        padding: 3rem;
    }

    .featured-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .featured-excerpt {
        font-size: 1.1rem;
        color: var(--text-secondary);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    /* Category Filter */
    .category-filter {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
        justify-content: center;
    }

    .category-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .category-btn:hover,
    .category-btn.active {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        text-decoration: none;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 2rem;
        }

        .featured-image {
            height: 250px;
        }

        .featured-content {
            padding: 2rem;
        }

        .featured-title {
            font-size: 1.5rem;
        }

        .category-filter {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .category-btn {
            flex-shrink: 0;
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
                <i class="bx bx-news"></i> Berita & Informasi
            </h1>
            <p class="hero-subtitle">Update terbaru seputar kegiatan dan prestasi PTMSI Sumatera Barat</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container py-5">
    <!-- Category Filter -->
    <div class="category-filter fade-in">
        <a href="#" class="category-btn active" data-category="all">
            <i class="bx bx-grid-alt"></i> Semua Berita
        </a>
        <a href="#" class="category-btn" data-category="prestasi">
            <i class="bx bx-trophy"></i> Prestasi
        </a>
        <a href="#" class="category-btn" data-category="kegiatan">
            <i class="bx bx-calendar-event"></i> Kegiatan
        </a>
        <a href="#" class="category-btn" data-category="pengumuman">
            <i class="bx bx-megaphone"></i> Pengumuman
        </a>
        <a href="#" class="category-btn" data-category="turnamen">
            <i class="bx bx-medal"></i> Turnamen
        </a>
    </div>

    <!-- Featured News -->
    <?php if (!empty($featuredNews)): ?>
        <div class="featured-news fade-in mb-5">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="featured-image">
                        <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($featuredNews['judul']) ?>" onerror="this.style.display='none'; this.parentElement.style.background='var(--primary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-news\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h4>Berita Utama</h4></div>'">
                        <div class="featured-badge">BERITA UTAMA</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="featured-content">
                        <h2 class="featured-title"><?= esc($featuredNews['judul']) ?></h2>
                        <div class="news-meta mb-3">
                            <span><i class="bx bx-calendar"></i> <?= date('d M Y', strtotime($featuredNews['tanggal_publikasi'])) ?></span>
                            <span><i class="bx bx-user"></i> Admin PTMSI</span>
                        </div>
                        <p class="featured-excerpt"><?= esc(substr($featuredNews['konten'], 0, 200)) ?>...</p>
                        <a href="<?= base_url('berita/detail/' . $featuredNews['slug']) ?>" class="btn-read-more">
                            <i class="bx bx-right-arrow-alt"></i> Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- News Grid -->
    <div class="section-header fade-in">
        <h2 class="section-title">Berita Terbaru</h2>
        <p class="section-subtitle">Informasi dan update terkini dari PTMSI Sumatera Barat</p>
    </div>

    <?php if (!empty($berita)): ?>
        <div class="row g-4">
            <?php foreach ($berita as $news): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card fade-in" data-category="<?= strtolower($news['kategori'] ?? 'umum') ?>">
                        <div class="news-image">
                            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($news['judul']) ?>" onerror="this.style.display='none'; this.parentElement.style.background='var(--primary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-news\' style=\'font-size:3rem;margin-bottom:1rem;\'></i><h5><?= esc(substr($news['judul'], 0, 30)) ?>...</h5></div>'">
                            <div class="news-badge"><?= esc($news['kategori'] ?? 'Berita') ?></div>
                        </div>
                        <div class="news-content">
                            <h5 class="news-title"><?= esc($news['judul']) ?></h5>
                            <div class="news-meta">
                                <span><i class="bx bx-calendar"></i> <?= date('d M Y', strtotime($news['tanggal_publikasi'])) ?></span>
                                <span><i class="bx bx-show"></i> <?= $news['views'] ?? '0' ?> views</span>
                            </div>
                            <p class="news-excerpt"><?= esc(substr($news['konten'], 0, 150)) ?>...</p>
                            <a href="<?= base_url('berita/detail/' . $news['slug']) ?>" class="btn-read-more">
                                <i class="bx bx-right-arrow-alt"></i> Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if (isset($pager)): ?>
            <div class="d-flex justify-content-center mt-5">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="empty-state fade-in">
            <i class="bx bx-news"></i>
            <h5>Belum Ada Berita</h5>
            <p>Berita dan informasi akan ditampilkan di sini</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Category filter functionality
        const categoryBtns = document.querySelectorAll('.category-btn');
        const newsCards = document.querySelectorAll('.news-card');

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all buttons
                categoryBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                const category = this.getAttribute('data-category');

                newsCards.forEach(card => {
                    if (category === 'all') {
                        card.style.display = 'block';
                    } else {
                        const cardCategory = card.getAttribute('data-category');
                        card.style.display = cardCategory === category ? 'block' : 'none';
                    }
                });
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
    });
</script>

<?= $this->endSection() ?>