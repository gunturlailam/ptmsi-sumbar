<style>
    footer {
        background: #02162B;
        color: #FAFAFA;
        padding: 40px 0 0 0;
        margin-top: 48px;
        border-top: 4px solid #003366;
    }

    .footer-logo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 2px solid #fff;
        background: #fff;
        box-shadow: 0 2px 12px #222;
        object-fit: cover;
        margin-bottom: 16px;
    }

    .footer-title {
        color: #1E90FF;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 8px;
        font-size: 1.2rem;
    }

    .footer-subtitle {
        font-size: 0.97rem;
        color: #E8F2FF;
        line-height: 1.6;
    }

    .footer-section-title {
        color: #1E90FF;
        font-weight: 700;
        margin-bottom: 16px;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        margin: 0 8px;
        transition: color 0.2s, transform 0.2s;
        display: inline-block;
    }

    .footer-link:hover {
        color: #fff;
        transform: translateX(4px);
        text-decoration: underline;
    }

    .footer-contact-item {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-contact-item i {
        color: #1E90FF;
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .footer-social {
        margin-top: 16px;
    }

    .footer-social a {
        color: #fff;
        font-size: 1.5rem;
        margin: 0 12px;
        transition: transform 0.2s, color 0.2s;
        display: inline-block;
    }

    .footer-social a:hover {
        transform: translateY(-4px) scale(1.1);
        color: #1E90FF;
    }

    .footer-divider {
        border-color: rgba(255, 255, 255, 0.2);
        margin: 32px 0 16px 0;
    }

    .footer-copyright {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.97rem;
        padding-bottom: 24px;
    }

    @media (max-width: 767px) {
        .footer-contact-item {
            justify-content: flex-start;
        }

        .footer-link {
            display: block;
            margin: 8px 0;
        }
    }
</style>

<footer>
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI Sumbar" class="footer-logo">
                <h5 class="footer-title">PTMSI Sumatera Barat</h5>
                <div class="footer-subtitle">Persatuan Tenis Meja Seluruh Indonesia Provinsi Sumbar</div>
            </div>
            <div class="col-md-4 text-center">
                <div class="footer-section-title">
                    <i class="bi bi-compass"></i> Navigasi
                </div>
                <div>
                    <a href="<?= base_url('/') ?>" class="footer-link">Beranda</a>
                    <a href="<?= base_url('profil') ?>" class="footer-link">Profil</a>
                    <a href="<?= base_url('atlet-pelatih') ?>" class="footer-link">Atlet & Pelatih</a>
                    <a href="<?= base_url('kejuaraan-event') ?>" class="footer-link">Kejuaraan & Event</a>
                    <a href="<?= base_url('pembinaan') ?>" class="footer-link">Program Pembinaan</a>
                    <a href="<?= base_url('klub') ?>" class="footer-link">Klub & Pengurus</a>
                    <a href="<?= base_url('berita') ?>" class="footer-link">Berita</a>
                    <a href="<?= base_url('galeri') ?>" class="footer-link">Galeri</a>
                    <a href="<?= base_url('dokumen') ?>" class="footer-link">Dokumen & Regulasi</a>
                    <a href="<?= base_url('ranking') ?>" class="footer-link">Ranking & Statistik</a>
                    <a href="<?= base_url('layanan') ?>" class="footer-link">Layanan Online</a>
                    <a href="<?= base_url('kontak') ?>" class="footer-link">Hubungi Kami</a>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="footer-section-title">
                    <i class="bi bi-telephone-fill"></i> Kontak Kami
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Jl. Contoh No. 123, Padang</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span>info@ptmsisumbar.or.id</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>0812-3456-7890</span>
                </div>
                <div class="footer-social">
                    <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" title="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="text-center footer-copyright">
            &copy; <?= date('Y') ?> PTMSI Sumatera Barat. All rights reserved.
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</footer>