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
        --surface: #1e293b;
        --border-color: rgba(245, 158, 11, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
        color: var(--text-primary);
    }

    .hero-section {
        background: var(--primary-gradient);
        color: white;
        padding: 6rem 0 4rem;
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
    }

    .klub-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .klub-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .klub-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .klub-logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .pengurus-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        text-align: center;
    }

    .pengurus-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .pengurus-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2.5rem;
    }

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
        box-shadow: var(--shadow-lg);
    }

    .nav-tabs .nav-link.active {
        background: var(--primary-gradient);
        color: white;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <h1 class="hero-title"><i class="bx bx-buildings"></i> Klub & Pengurus</h1>
            <p class="hero-subtitle">Informasi klub tenis meja dan struktur pengurus PTMSI Sumatera Barat</p>
        </div>
    </div>
</section>

<div class="container py-5">
    <ul class="nav nav-tabs" id="klubTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="klub-tab" data-bs-toggle="tab" data-bs-target="#klub" type="button" role="tab">
                <i class="bx bx-buildings"></i> Klub Terdaftar
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pengurus-tab" data-bs-toggle="tab" data-bs-target="#pengurus" type="button" role="tab">
                <i class="bx bx-group"></i> Struktur Pengurus
            </button>
        </li>
    </ul>

    <div class="tab-content" id="klubTabsContent">
        <div class="tab-pane fade show active" id="klub" role="tabpanel">
            <div class="row g-4">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="klub-card fade-in">
                            <div class="klub-logo">
                                <i class="bx bx-trophy"></i>
                            </div>
                            <h5 class="text-center mb-3">Klub Tenis Meja <?= $i ?></h5>
                            <div class="text-center text-muted mb-3">
                                <p><i class="bx bx-map"></i> Padang, Sumatera Barat</p>
                                <p><i class="bx bx-user"></i> 25 Anggota</p>
                                <p><i class="bx bx-calendar"></i> Didirikan 2020</p>
                            </div>
                            <div class="text-center">
                                <span class="badge px-3 py-2" style="background: var(--success-gradient); color: white;">Aktif</span>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="pengurus" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="pengurus-card fade-in">
                        <div class="pengurus-avatar">
                            <i class="bx bx-user"></i>
                        </div>
                        <h5>Drs. Ahmad Syafii</h5>
                        <p class="text-muted">Ketua Umum</p>
                        <p class="small">Memimpin organisasi PTMSI Sumbar dengan pengalaman 15 tahun</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pengurus-card fade-in">
                        <div class="pengurus-avatar">
                            <i class="bx bx-user"></i>
                        </div>
                        <h5>Ir. Budi Santoso</h5>
                        <p class="text-muted">Sekretaris Umum</p>
                        <p class="small">Mengelola administrasi dan dokumentasi organisasi</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pengurus-card fade-in">
                        <div class="pengurus-avatar">
                            <i class="bx bx-user"></i>
                        </div>
                        <h5>Dra. Siti Aminah</h5>
                        <p class="text-muted">Bendahara Umum</p>
                        <p class="small">Bertanggung jawab atas keuangan organisasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        });

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    });
</script>
<?= $this->endSection() ?>