<?php $title = isset($title) ? $title : 'Profil PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        overflow-x: hidden;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.5;
        }

        50% {
            opacity: 0.8;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-profil {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
        position: relative;
        min-height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 140px 20px;
        overflow: hidden;
    }

    .hero-profil::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        animation: pulse 8s ease-in-out infinite;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        text-align: center;
        max-width: 900px;
        margin: 0 auto;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-weight: 900;
        letter-spacing: 1px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        text-transform: uppercase;
        margin-bottom: 24px;
        line-height: 1.2;
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-content p {
        font-size: 1.3rem;
        margin-bottom: 40px;
        font-weight: 400;
        opacity: 0.95;
        line-height: 1.6;
        animation: fadeInUp 1s ease-out;
    }

    /* Sub Menu Navigation */
    .submenu-nav {
        background: #fff;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.1);
        position: sticky;
        top: 76px;
        z-index: 100;
        margin-top: -80px;
        border-bottom: 3px solid #1E90FF;
    }

    .submenu-nav .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        padding: 16px 20px;
    }

    .submenu-nav a {
        padding: 12px 24px;
        color: #003366;
        text-decoration: none;
        font-weight: 600;
        border-radius: 25px;
        transition: all 0.3s;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 2px solid transparent;
    }

    .submenu-nav a:hover,
    .submenu-nav a.active {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 144, 255, 0.3);
    }

    .submenu-nav a i {
        font-size: 1.1rem;
    }

    /* Section Styles */
    .profil-section {
        padding: 60px 0;
        scroll-margin-top: 160px;
    }

    .profil-section:nth-child(even) {
        background: #fff;
    }

    .profil-section:nth-child(odd) {
        background: #E8F2FF;
    }

    .section-title {
        color: #003366;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 40px;
        text-align: center;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .section-title i {
        font-size: 2.2rem;
        color: #1E90FF;
    }

    /* Sejarah Section */
    .sejarah-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .sejarah-content p {
        color: #555;
        font-size: 1.1rem;
        line-height: 1.9;
        margin-bottom: 24px;
        text-align: justify;
    }

    .timeline {
        position: relative;
        padding: 20px 0;
        max-width: 800px;
        margin: 40px auto;
    }

    .timeline-item {
        display: flex;
        gap: 24px;
        margin-bottom: 32px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: -32px;
        width: 3px;
        background: linear-gradient(180deg, #1E90FF 0%, #003366 100%);
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-year {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.3);
    }

    .timeline-content {
        flex: 1;
        background: #fff;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        border-left: 4px solid #1E90FF;
    }

    .timeline-content h4 {
        color: #003366;
        font-weight: bold;
        margin-bottom: 12px;
        font-size: 1.3rem;
    }

    .timeline-content p {
        color: #555;
        margin: 0;
        line-height: 1.8;
    }

    /* Visi Misi Section */
    .visi-misi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 32px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .visi-misi-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px 32px;
        text-align: center;
        box-shadow: 0 4px 24px rgba(30, 144, 255, 0.1);
        border-top: 4px solid #1E90FF;
        transition: all 0.3s;
    }

    .visi-misi-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 48px rgba(30, 144, 255, 0.2);
    }

    .visi-misi-card i {
        font-size: 3.5rem;
        color: #1E90FF;
        margin-bottom: 24px;
    }

    .visi-misi-card h3 {
        color: #003366;
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }

    .visi-misi-card p {
        color: #555;
        font-size: 1.05rem;
        line-height: 1.8;
        margin: 0;
    }

    /* Struktur Organisasi */
    .struktur-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 28px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .struktur-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px 24px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        border: 2px solid transparent;
        transition: all 0.3s;
    }

    .struktur-card:hover {
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
        transform: translateY(-6px);
        border-color: #1E90FF;
    }

    .struktur-card img {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        object-fit: cover;
        margin-bottom: 20px;
        border: 4px solid #1E90FF;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.2);
    }

    .struktur-card h5 {
        color: #003366;
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 8px;
    }

    .struktur-card p {
        color: #1E90FF;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
    }

    /* Pengurus Kabupaten/Kota */
    .kabupaten-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .kabupaten-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        border-left: 5px solid #1E90FF;
        transition: all 0.3s;
    }

    .kabupaten-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
    }

    .kabupaten-card h4 {
        color: #003366;
        font-weight: bold;
        font-size: 1.3rem;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .kabupaten-card h4 i {
        color: #1E90FF;
        font-size: 1.5rem;
    }

    .kabupaten-card .info-item {
        display: flex;
        align-items: start;
        gap: 12px;
        margin-bottom: 12px;
        color: #555;
        font-size: 0.95rem;
    }

    .kabupaten-card .info-item i {
        color: #1E90FF;
        margin-top: 4px;
        flex-shrink: 0;
    }

    /* Tugas & Fungsi */
    .tugas-fungsi-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .tugas-list {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
    }

    .tugas-list h4 {
        color: #003366;
        font-weight: bold;
        font-size: 1.4rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .tugas-list h4 i {
        color: #1E90FF;
        font-size: 1.6rem;
    }

    .tugas-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tugas-list ul li {
        padding: 12px 0 12px 40px;
        position: relative;
        color: #555;
        font-size: 1.05rem;
        line-height: 1.8;
        border-bottom: 1px solid #E8F2FF;
    }

    .tugas-list ul li:last-child {
        border-bottom: none;
    }

    .tugas-list ul li::before {
        content: '\f00c';
        font-family: 'bootstrap-icons';
        position: absolute;
        left: 0;
        color: #1E90FF;
        font-size: 1.2rem;
        font-weight: bold;
    }

    /* Contact Section */
    .profil-contact {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
        border-radius: 20px;
        padding: 40px 36px;
        margin: 40px auto 0;
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
        color: #fff;
        text-align: left;
        max-width: 900px;
    }

    .profil-contact h6 {
        color: #fff;
        font-weight: bold;
        margin-bottom: 24px;
        letter-spacing: 1px;
        font-size: 1.3rem;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profil-contact div {
        margin-bottom: 16px;
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profil-contact i {
        color: #fff;
        font-size: 1.3rem;
    }

    @media (max-width: 991px) {
        .submenu-nav .container {
            flex-direction: column;
            gap: 8px;
        }

        .submenu-nav a {
            width: 100%;
            justify-content: center;
        }

        .visi-misi-grid,
        .struktur-grid,
        .kabupaten-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .hero-content h1 {
            font-size: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .profil-section {
            padding: 40px 0;
        }

        .timeline-item {
            flex-direction: column;
        }

        .timeline-item::before {
            display: none;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-profil">
    <div class="hero-content">
        <h1>PERSATUAN TENIS MEJA SELURUH INDONESIA – SUMATERA BARAT</h1>
        <p>Membangun atlet, klub, dan prestasi menuju level nasional dan internasional.</p>
    </div>
</section>

<!-- Sub Menu Navigation -->
<nav class="submenu-nav">
    <div class="container">
        <a href="#sejarah" class="active">
            <i class="bi bi-clock-history"></i> Sejarah
        </a>
        <a href="#visi-misi">
            <i class="bi bi-bullseye"></i> Visi & Misi
        </a>
        <a href="#struktur-provinsi">
            <i class="bi bi-diagram-3"></i> Struktur Organisasi Provinsi
        </a>
        <a href="#pengurus-kabupaten">
            <i class="bi bi-building"></i> Pengurus Kabupaten/Kota
        </a>
        <a href="#tugas-fungsi">
            <i class="bi bi-list-check"></i> Tugas & Fungsi
        </a>
    </div>
</nav>

<!-- Sejarah PTMSI Sumbar -->
<section id="sejarah" class="profil-section">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-clock-history"></i> Sejarah PTMSI Sumatera Barat
        </h2>
        <div class="sejarah-content">
            <p>
                Persatuan Tenis Meja Seluruh Indonesia (PTMSI) Provinsi Sumatera Barat didirikan pada tahun 1980 sebagai
                organisasi resmi yang membina dan mengembangkan olahraga tenis meja di wilayah Sumatera Barat.
                Organisasi
                ini merupakan bagian dari PTMSI Pusat yang berkedudukan di Jakarta.
            </p>
            <p>
                Sejak berdiri, PTMSI Sumbar telah aktif dalam mengembangkan ekosistem tenis meja di provinsi ini melalui
                berbagai program pembinaan, kompetisi, dan pelatihan. Organisasi ini berperan penting dalam
                mengidentifikasi,
                membina, dan mengembangkan bakat-bakat muda di bidang tenis meja.
            </p>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">1980</div>
                    <div class="timeline-content">
                        <h4>Pendirian PTMSI Sumbar</h4>
                        <p>PTMSI Provinsi Sumatera Barat didirikan sebagai organisasi resmi pembina tenis meja di
                            wilayah Sumatera Barat.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">1990</div>
                    <div class="timeline-content">
                        <h4>Pengembangan Program Pembinaan</h4>
                        <p>Mulai mengembangkan program pembinaan usia dini dan pelatihan untuk atlet-atlet muda.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2000</div>
                    <div class="timeline-content">
                        <h4>Ekspansi Kompetisi</h4>
                        <p>Mengadakan berbagai kompetisi tingkat provinsi dan nasional untuk meningkatkan prestasi
                            atlet.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2010</div>
                    <div class="timeline-content">
                        <h4>Modernisasi Sistem</h4>
                        <p>Memodernisasi sistem administrasi dan pembinaan dengan teknologi informasi.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-content">
                        <h4>Digitalisasi Organisasi</h4>
                        <p>Mengembangkan platform digital untuk pendaftaran, kompetisi, dan manajemen data atlet serta
                            klub.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section id="visi-misi" class="profil-section">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-bullseye"></i> Visi & Misi
        </h2>
        <div class="visi-misi-grid">
            <div class="visi-misi-card">
                <i class="bi bi-bullseye"></i>
                <h3>Visi</h3>
                <p>Mewujudkan Sumatera Barat sebagai pusat pembinaan dan prestasi tenis meja terbaik di Indonesia,
                    dengan menghasilkan atlet-atlet berprestasi di tingkat nasional dan internasional.</p>
            </div>
            <div class="visi-misi-card">
                <i class="bi bi-lightning-charge"></i>
                <h3>Misi</h3>
                <p>Meningkatkan kualitas pelatih, atlet, dan kompetisi secara berkelanjutan melalui program pembinaan
                    yang terstruktur, kompetisi yang berkualitas, dan pengembangan infrastruktur olahraga tenis meja.
                </p>
            </div>
            <div class="visi-misi-card">
                <i class="bi bi-people"></i>
                <h3>Tujuan</h3>
                <p>Mengembangkan ekosistem klub, turnamen, dan pembinaan usia dini yang sehat dan berkelanjutan,
                    serta membangun jaringan kerjasama dengan berbagai pihak untuk kemajuan tenis meja di Sumatera
                    Barat.</p>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi Provinsi -->
<section id="struktur-provinsi" class="profil-section">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-diagram-3"></i> Struktur Organisasi Provinsi
        </h2>
        <?php if (!empty($strukturProvinsi)): ?>
            <div class="struktur-grid">
                <?php foreach ($strukturProvinsi as $pengurus): ?>
                    <div class="struktur-card">
                        <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($pengurus['nama_lengkap']) ?>">
                        <h5><?= esc($pengurus['nama_lengkap']) ?></h5>
                        <p><?= esc($pengurus['nomor_lisensi'] ?? 'Pengurus') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-person-x" style="font-size: 4rem; color: #1E90FF;"></i>
                <p class="mt-3 text-muted">Data struktur organisasi sedang dalam proses pembaruan</p>
            </div>
        <?php endif; ?>

        <?php if (!empty($organisasiProvinsi)): ?>
            <div class="profil-contact">
                <h6><i class="bi bi-info-circle-fill"></i> KONTAK & SEKRETARIAT</h6>
                <div><i
                        class="bi bi-geo-alt-fill"></i><?= esc($organisasiProvinsi['alamat'] ?? 'Jl. Contoh No. 123, Padang, Sumatera Barat') ?>
                </div>
                <div><i class="bi bi-envelope-fill"></i>info@ptmsisumbar.or.id</div>
                <div><i class="bi bi-telephone-fill"></i><?= esc($organisasiProvinsi['nohp'] ?? '0812-3456-7890') ?></div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Daftar Pengurus Kabupaten/Kota -->
<section id="pengurus-kabupaten" class="profil-section">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-building"></i> Daftar Pengurus Kabupaten/Kota (PTMSI Daerah)
        </h2>
        <?php if (!empty($organisasiKabupaten)): ?>
            <div class="kabupaten-grid">
                <?php foreach ($organisasiKabupaten as $org): ?>
                    <div class="kabupaten-card">
                        <h4>
                            <i class="bi bi-building"></i>
                            <?= esc($org['nama_organisasi']) ?>
                        </h4>
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span><?= esc($org['alamat'] ?? 'Alamat belum tersedia') ?></span>
                        </div>
                        <?php if (!empty($org['nohp'])): ?>
                            <div class="info-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span><?= esc($org['nohp']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-building-x" style="font-size: 4rem; color: #1E90FF;"></i>
                <p class="mt-3 text-muted">Data pengurus kabupaten/kota sedang dalam proses pembaruan</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Tugas & Fungsi Organisasi -->
<section id="tugas-fungsi" class="profil-section">
    <div class="container">
        <h2 class="section-title">
            <i class="bi bi-list-check"></i> Tugas & Fungsi Organisasi
        </h2>
        <div class="tugas-fungsi-content">
            <div class="tugas-list">
                <h4>
                    <i class="bi bi-trophy"></i>
                    Tugas Organisasi
                </h4>
                <ul>
                    <li>Membina dan mengembangkan olahraga tenis meja di wilayah Sumatera Barat</li>
                    <li>Menyelenggarakan kompetisi dan kejuaraan tingkat provinsi</li>
                    <li>Mengidentifikasi dan membina bakat-bakat muda di bidang tenis meja</li>
                    <li>Mengkoordinasikan kegiatan klub-klub tenis meja di seluruh Sumatera Barat</li>
                    <li>Mewakili Sumatera Barat dalam kompetisi tingkat nasional dan internasional</li>
                    <li>Mengembangkan program pembinaan untuk atlet, pelatih, dan ofisial</li>
                    <li>Mengelola data dan informasi terkait atlet, klub, dan kompetisi</li>
                </ul>
            </div>

            <div class="tugas-list">
                <h4>
                    <i class="bi bi-gear"></i>
                    Fungsi Organisasi
                </h4>
                <ul>
                    <li>Sebagai wadah koordinasi dan komunikasi antar klub tenis meja di Sumatera Barat</li>
                    <li>Sebagai mediator antara klub, atlet, dan pihak terkait lainnya</li>
                    <li>Sebagai penyelenggara kompetisi resmi tingkat provinsi</li>
                    <li>Sebagai pembina dan pengawas pelaksanaan program pembinaan</li>
                    <li>Sebagai penghubung antara PTMSI Pusat dengan organisasi daerah</li>
                    <li>Sebagai pengelola sistem ranking dan statistik atlet provinsi</li>
                    <li>Sebagai penyedia layanan informasi dan dokumentasi terkait tenis meja</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
    // Smooth scroll untuk sub-menu navigation
    document.querySelectorAll('.submenu-nav a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Update active state
                document.querySelectorAll('.submenu-nav a').forEach(a => a.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // Update active state saat scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('.profil-section');
        const navLinks = document.querySelectorAll('.submenu-nav a');

        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
</script>

<?= $this->include('layouts/footer') ?>