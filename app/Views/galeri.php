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

    /* Gallery Cards */
    .gallery-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        position: relative;
        cursor: pointer;
    }

    .gallery-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .gallery-image {
        height: 250px;
        background: var(--primary-gradient);
        position: relative;
        overflow: hidden;
    }

    .gallery-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-card:hover .gallery-image img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay i {
        font-size: 3rem;
        color: white;
    }

    .gallery-content {
        padding: 1.5rem;
    }

    .gallery-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .gallery-description {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    /* Filter Tabs */
    .filter-tabs {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
        justify-content: center;
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

    /* Modal Styles */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border: none;
    }

    .modal-body {
        padding: 0;
    }

    .modal-image {
        width: 100%;
        height: auto;
        max-height: 70vh;
        object-fit: contain;
    }

    .modal-info {
        padding: 2rem;
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

        .gallery-image {
            height: 200px;
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
                <i class="bx bx-images"></i> Galeri Foto
            </h1>
            <p class="hero-subtitle">Dokumentasi kegiatan dan momen berharga PTMSI Sumatera Barat</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container py-5">
    <!-- Filter Tabs -->
    <div class="filter-tabs fade-in">
        <button class="filter-tab active" data-filter="all">
            <i class="bx bx-grid-alt"></i> Semua Media
        </button>
        <button class="filter-tab" data-filter="gambar">
            <i class="bx bx-image"></i> Foto
        </button>
        <button class="filter-tab" data-filter="video">
            <i class="bx bx-video"></i> Video
        </button>
    </div>

    <!-- Gallery Grid -->
    <?php if (!empty($galeri)): ?>
        <div class="row g-4">
            <?php foreach ($galeri as $index => $foto): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card fade-in" data-category="<?= strtolower($foto['jenis_media'] ?? 'gambar') ?>" data-bs-toggle="modal" data-bs-target="#galleryModal" onclick="showImage(<?= $index ?>)">
                        <div class="gallery-image">
                            <?php
                            // Check if url already contains full path or just filename
                            $imageUrl = $foto['url'];
                            if (strpos($imageUrl, 'uploads/') !== 0) {
                                $imageUrl = 'uploads/galeri/' . $imageUrl;
                            }
                            ?>
                            <img src="<?= base_url($imageUrl) ?>" alt="<?= esc($foto['judul']) ?>" onerror="this.style.display='none'; this.parentElement.style.background='var(--primary-gradient)'; this.parentElement.innerHTML+='<div style=\'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;\'><i class=\'bx bx-image\' style=\'font-size:4rem;margin-bottom:1rem;\'></i><h5><?= esc(substr($foto['judul'], 0, 20)) ?>...</h5></div>'">
                            <div class="gallery-overlay">
                                <i class="bx bx-search-alt"></i>
                            </div>
                        </div>
                        <div class="gallery-content">
                            <h5 class="gallery-title"><?= esc($foto['judul']) ?></h5>
                            <p class="gallery-description"><?= esc($foto['nama_event'] ?? 'Dokumentasi kegiatan PTMSI Sumbar') ?></p>
                            <div class="gallery-meta">
                                <span><i class="bx bx-calendar"></i> <?= isset($foto['diunggah_pada']) ? date('d M Y', strtotime($foto['diunggah_pada'])) : '-' ?></span>
                                <span><i class="bx bx-tag"></i> <?= esc(ucfirst($foto['jenis_media'] ?? 'Gambar')) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state fade-in">
            <i class="bx bx-images"></i>
            <h5>Belum Ada Foto</h5>
            <p>Galeri foto akan ditampilkan di sini</p>
        </div>
    <?php endif; ?>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Detail Foto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="modal-image" id="modalImage">
                <div class="modal-info">
                    <h5 id="modalTitle"></h5>
                    <p id="modalDescription" class="text-muted"></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span id="modalDate" class="text-muted"></span>
                        <span id="modalCategory" class="badge" style="background: var(--primary-gradient);"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Gallery data for modal
    const galleryData = <?= json_encode($galeri ?? []) ?>;

    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterTabs = document.querySelectorAll('.filter-tab');
        const galleryCards = document.querySelectorAll('.gallery-card');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                galleryCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        const category = card.getAttribute('data-category');
                        card.style.display = category === filter ? 'block' : 'none';
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

    // Show image in modal
    function showImage(index) {
        if (galleryData[index]) {
            const foto = galleryData[index];
            // Check if url already contains full path
            let imageUrl = foto.url;
            if (!imageUrl.startsWith('uploads/')) {
                imageUrl = 'uploads/galeri/' + imageUrl;
            }
            document.getElementById('modalImage').src = '<?= base_url() ?>' + imageUrl;
            document.getElementById('modalTitle').textContent = foto.judul;
            document.getElementById('modalDescription').textContent = foto.nama_event || 'Dokumentasi kegiatan PTMSI Sumbar';
            document.getElementById('modalDate').innerHTML = '<i class="bx bx-calendar"></i> ' + (foto.diunggah_pada ? new Date(foto.diunggah_pada).toLocaleDateString('id-ID') : '-');
            document.getElementById('modalCategory').textContent = foto.jenis_media ? foto.jenis_media.charAt(0).toUpperCase() + foto.jenis_media.slice(1) : 'Gambar';
        }
    }
</script>

<?= $this->endSection() ?>