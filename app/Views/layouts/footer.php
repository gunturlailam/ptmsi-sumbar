<style>
    footer {
        background: var(--dark-gradient);
        color: #ffffff;
        padding: 4rem 0 0 0;
        margin-top: 4rem;
        position: relative;
        overflow: hidden;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.05"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
        animation: float 30s ease-in-out infinite;
    }

    footer::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .footer-content {
        position: relative;
        z-index: 1;
    }

    .footer-logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 3px solid #667eea;
        background: white;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        object-fit: cover;
        margin-bottom: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-logo:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
    }

    .footer-title {
        color: #667eea;
        font-weight: 800;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
        letter-spacing: -0.5px;
    }

    .footer-subtitle {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .footer-section-title {
        color: #667eea;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        letter-spacing: -0.3px;
    }

    .footer-section-title i {
        font-size: 1.25rem;
        color: #667eea;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        display: block;
        padding: 0.5rem 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.9rem;
        position: relative;
    }

    .footer-link::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background: #667eea;
        transition: width 0.3s ease;
    }

    .footer-link:hover {
        color: #667eea;
        transform: translateX(8px);
    }

    .footer-link:hover::before {
        width: 30px;
    }

    .footer-contact-item {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
    }

    .footer-contact-item i {
        color: #1E90FF;
        font-size: 1rem;
        width: 16px;
        text-align: center;
    }

    .footer-social {
        display: flex;
        gap: 1rem;
    }

    .footer-social a {
        color: white;
        font-size: 1.25rem;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(102, 126, 234, 0.2);
        backdrop-filter: blur(10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(102, 126, 234, 0.3);
    }

    .footer-social a:hover {
        background: var(--primary-gradient);
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .footer-divider {
        border: none;
        height: 1px;
        background: rgba(30, 144, 255, 0.3);
        margin: 30px 0 20px 0;
    }

    .footer-bottom {
        background: rgba(0, 0, 0, 0.2);
        padding: 20px 0;
        border-top: 1px solid rgba(30, 144, 255, 0.2);
    }

    .footer-copyright {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        text-align: center;
    }

    .footer-copyright a {
        color: #1E90FF;
        text-decoration: none;
        font-weight: 600;
    }

    .footer-copyright a:hover {
        color: #00BFFF;
    }

    @media (max-width: 768px) {
        footer {
            padding: 30px 0 0 0;
        }

        .footer-social {
            justify-content: center;
        }
    }
</style>

<footer>
    <div class="footer-content">
        <div class="container">
            <div class="row gy-4">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6 text-center text-lg-start">
                    <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI Sumbar" class="footer-logo">
                    <h5 class="footer-title">PTMSI Sumatera Barat</h5>
                    <p class="footer-subtitle">Persatuan Tenis Meja Seluruh Indonesia Provinsi Sumatera Barat</p>

                    <div class="footer-social">
                        <a href="#" title="Facebook" target="_blank">
                            <i class="bx bxl-facebook"></i>
                        </a>
                        <a href="#" title="Instagram" target="_blank">
                            <i class="bx bxl-instagram"></i>
                        </a>
                        <a href="#" title="YouTube" target="_blank">
                            <i class="bx bxl-youtube"></i>
                        </a>
                        <a href="#" title="WhatsApp" target="_blank">
                            <i class="bx bxl-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-section-title">
                        <i class="bx bx-compass"></i> Menu Utama
                    </h6>
                    <a href="<?= base_url('/') ?>" class="footer-link">Beranda</a>
                    <a href="<?= base_url('profil') ?>" class="footer-link">Profil</a>
                    <a href="<?= base_url('atlet-pelatih') ?>" class="footer-link">Atlet & Pelatih</a>
                    <a href="<?= base_url('event') ?>" class="footer-link">Kejuaraan & Event</a>
                    <a href="<?= base_url('pembinaan') ?>" class="footer-link">Program Pembinaan</a>
                    <a href="<?= base_url('klub-pengurus') ?>" class="footer-link">Klub & Pengurus</a>
                </div>

                <!-- Services -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-section-title">
                        <i class="bx bx-grid-alt"></i> Layanan
                    </h6>
                    <a href="<?= base_url('berita') ?>" class="footer-link">Berita</a>
                    <a href="<?= base_url('galeri') ?>" class="footer-link">Galeri</a>
                    <a href="<?= base_url('dokumen') ?>" class="footer-link">Dokumen</a>
                    <a href="<?= base_url('ranking') ?>" class="footer-link">Ranking</a>
                    <a href="<?= base_url('layanan-online') ?>" class="footer-link">Layanan Online</a>
                    <a href="<?= base_url('tournament') ?>" class="footer-link">Pendaftaran</a>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-section-title">
                        <i class="bx bx-phone"></i> Kontak
                    </h6>
                    <div class="footer-contact-item">
                        <i class="bx bx-map"></i>
                        <span>Jl. Prof. Dr. Hamka No. 10, Padang</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bx bx-envelope"></i>
                        <span>info@ptmsisumbar.or.id</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bx bx-phone"></i>
                        <span>(0751) 123-4567</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bx bxl-whatsapp"></i>
                        <span>+62 812-3456-7890</span>
                    </div>
                </div>
            </div>

            <hr class="footer-divider">
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="footer-copyright">
                        &copy; <?= date('Y') ?> <a href="<?= base_url() ?>">PTMSI Sumatera Barat</a>. All rights reserved.
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-copyright">
                        Developed with <i class="bx bxs-heart" style="color: #ff6b6b;"></i> for Indonesian Table Tennis
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</footer>