<style>
    footer {
        background: linear-gradient(135deg, #02162B 0%, #003366 100%);
        color: #FAFAFA;
        padding: 40px 0 0 0;
        margin-top: 50px;
        position: relative;
        overflow: hidden;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 50%, #1E90FF 100%);
    }

    .footer-content {
        position: relative;
        z-index: 1;
    }

    .footer-logo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #1E90FF;
        background: #fff;
        box-shadow: 0 4px 15px rgba(30, 144, 255, 0.3);
        object-fit: cover;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .footer-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(30, 144, 255, 0.4);
    }

    .footer-title {
        color: #1E90FF;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .footer-subtitle {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.4;
    }

    .footer-section-title {
        color: #1E90FF;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-section-title i {
        font-size: 1.1rem;
        color: #00BFFF;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        display: block;
        padding: 5px 0;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .footer-link:hover {
        color: #1E90FF;
        transform: translateX(5px);
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
        margin-top: 15px;
        display: flex;
        gap: 15px;
    }

    .footer-social a {
        color: #fff;
        font-size: 1.3rem;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(30, 144, 255, 0.2);
        transition: all 0.3s ease;
    }

    .footer-social a:hover {
        background: #1E90FF;
        transform: translateY(-3px);
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
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" title="Instagram" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" title="YouTube" target="_blank">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="#" title="WhatsApp" target="_blank">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-section-title">
                        <i class="bi bi-compass"></i> Menu Utama
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
                        <i class="bi bi-grid"></i> Layanan
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
                        <i class="bi bi-telephone"></i> Kontak
                    </h6>
                    <div class="footer-contact-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Prof. Dr. Hamka No. 10, Padang</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <span>info@ptmsisumbar.or.id</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <span>(0751) 123-4567</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-whatsapp"></i>
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
                        Developed with <i class="bi bi-heart-fill" style="color: #ff6b6b;"></i> for Indonesian Table Tennis
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</footer>