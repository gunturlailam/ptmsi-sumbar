<?= $this->extend('layouts/public_main') ?>

<?= $this->section('css') ?>
<style>
    :root {
        --primary: #f59e0b;
        --secondary: #d97706;
        --primary-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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

    .contact-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .contact-icon {
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

    .form-control {
        border: 2px solid var(--border-color);
        border-radius: 15px;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .btn-send {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
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
            <h1 class="hero-title"><i class="bx bx-envelope"></i> Hubungi Kami</h1>
            <p class="hero-subtitle">Silakan hubungi kami untuk informasi lebih lanjut</p>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="contact-card fade-in">
                <div class="contact-icon">
                    <i class="bx bx-phone"></i>
                </div>
                <h5 class="text-center mb-3">Telepon</h5>
                <p class="text-center text-muted">+62 751 123456</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="contact-card fade-in">
                <div class="contact-icon">
                    <i class="bx bx-envelope"></i>
                </div>
                <h5 class="text-center mb-3">Email</h5>
                <p class="text-center text-muted">info@ptmsi-sumbar.org</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="contact-card fade-in">
                <div class="contact-icon">
                    <i class="bx bx-map"></i>
                </div>
                <h5 class="text-center mb-3">Alamat</h5>
                <p class="text-center text-muted">Jl. Sudirman No. 123, Padang</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="contact-card fade-in">
                <h3 class="text-center mb-4">Kirim Pesan</h3>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Subjek" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" rows="5" placeholder="Pesan Anda" required></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn-send">
                                <i class="bx bx-send"></i> Kirim Pesan
                            </button>
                        </div>
                    </div>
                </form>
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