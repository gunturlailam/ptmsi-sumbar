<?php $title = 'Profil PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    body {
        background: linear-gradient(135deg, #2979FF 0%, #1565c0 100%);
    }

    .hero-profil {
        background: url('<?= base_url('assets/img/hero.jpg') ?>') center/cover no-repeat;
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(17, 17, 17, 0.7) 60%, rgba(41, 121, 255, 0.3) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: #FAFAFA;
        text-align: center;
        padding: 70px 20px 60px 20px;
    }

    .hero-content h1 {
        font-size: 2.8rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-shadow: 0 2px 16px #111;
        text-transform: uppercase;
    }

    .hero-content p {
        font-size: 1.25rem;
        margin-bottom: 28px;
        text-shadow: 0 2px 8px #111;
        font-weight: 500;
    }

    .hero-content .btn {
        font-size: 1.1rem;
        border-radius: 30px;
        padding: 12px 32px;
        margin: 0 8px;
        font-weight: 600;
        box-shadow: 0 4px 16px rgba(41, 121, 255, 0.13);
        transition: 0.2s;
    }

    .btn-ptmsi {
        background: linear-gradient(90deg, #2979FF 60%, #1565c0 100%);
        color: #fff;
        border: none;
    }

    .btn-ptmsi:hover {
        background: linear-gradient(90deg, #1565c0 60%, #2979FF 100%);
        color: #fff;
        transform: scale(1.04);
    }

    .btn-outline-light {
        border: 2px solid #FAFAFA;
        color: #FAFAFA;
        background: transparent;
    }

    .btn-outline-light:hover {
        background: #2979FF;
        color: #fff;
        border-color: #2979FF;
    }

    .section-split {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        align-items: center;
        justify-content: center;
        padding: 56px 0 32px 0;
        background: linear-gradient(120deg, #2979FF 80%, #1565c0 100%);
    }

    .section-split .split-text {
        flex: 1 1 340px;
        min-width: 280px;
        max-width: 500px;
        color: #fff;
    }

    .section-split .split-text h2 {
        color: #fff;
    }

    .section-split .split-text .text-muted {
        color: #e3e3e3 !important;
    }

    .section-split .split-img {
        flex: 1 1 260px;
        min-width: 220px;
        max-width: 340px;
        text-align: center;
    }

    .split-img img {
        border-radius: 22px;
        box-shadow: 0 8px 32px rgba(17, 17, 17, 0.13);
        width: 100%;
        max-width: 320px;
        border: 4px solid #fff;
    }

    .stat-box {
        display: flex;
        gap: 32px;
        margin-top: 36px;
    }

    .stat-box .stat {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(41, 121, 255, 0.07);
        padding: 22px 28px;
        text-align: center;
        min-width: 120px;
        border-bottom: 4px solid #2979FF;
    }

    .stat h3 {
        color: #2979FF;
        font-size: 2.1rem;
        font-weight: bold;
        margin-bottom: 0;
    }

    .stat p {
        color: #1565c0;
        margin-bottom: 0;
        font-size: 1.08rem;
        font-weight: 600;
    }

    .section-title {
        color: #2979FF;
        font-weight: bold;
        font-size: 2.1rem;
        margin-bottom: 36px;
        text-align: center;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .card-grid {
        display: flex;
        gap: 28px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 36px;
    }

    .card-grid .card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(41, 121, 255, 0.09);
        padding: 36px 26px;
        min-width: 220px;
        max-width: 320px;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s;
        border: none;
        border-bottom: 4px solid #2979FF;
    }

    .card-grid .card:hover {
        box-shadow: 0 12px 48px rgba(41, 121, 255, 0.13);
        transform: translateY(-4px) scale(1.04);
        border-bottom: 4px solid #1565c0;
    }

    .card-grid .card i {
        font-size: 2.7rem;
        color: #2979FF;
        margin-bottom: 14px;
    }

    .card-grid .card h5 {
        font-weight: bold;
        margin-top: 14px;
        margin-bottom: 12px;
        color: #1565c0;
        letter-spacing: 1px;
    }

    .card-grid .card p {
        color: #222;
        font-size: 1.08rem;
    }

    .struktur-title {
        color: #fff;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 32px;
        text-align: center;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .struktur-section {
        background: linear-gradient(120deg, #2979FF 80%, #1565c0 100%);
        padding: 48px 0 32px 0;
        border-radius: 0 0 32px 32px;
    }

    .struktur-grid-wrap {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 32px;
        background: linear-gradient(120deg, #388eff 60%, #2979FF 100%);
        border-radius: 28px;
        padding: 36px 24px 24px 24px;
        margin: 0 auto 32px auto;
        max-width: 1100px;
        box-shadow: 0 6px 32px rgba(41, 121, 255, 0.13);
        flex-wrap: wrap;
    }

    .struktur-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(41, 121, 255, 0.09);
        padding: 28px 18px 18px 18px;
        min-width: 180px;
        max-width: 210px;
        text-align: center;
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .struktur-card:hover {
        box-shadow: 0 8px 32px rgba(41, 121, 255, 0.18);
        transform: translateY(-4px) scale(1.04);
    }

    .struktur-card img {
        border-radius: 50%;
        box-shadow: 0 2px 12px rgba(41, 121, 255, 0.09);
        width: 86px;
        height: 86px;
        object-fit: cover;
        margin-bottom: 14px;
        border: 3px solid #2979FF;
        background: #f5f8ff;
    }

    .struktur-card h5 {
        font-weight: bold;
        margin-bottom: 4px;
        color: #2979FF;
        font-size: 1.13rem;
        letter-spacing: 0.5px;
    }

    .struktur-card p {
        color: #1565c0;
        font-size: 1.01rem;
        margin-bottom: 0;
        font-weight: 500;
    }

    .profil-contact {
        background: linear-gradient(90deg, #2979FF 10%, #1565c0 100%);
        border-radius: 18px;
        padding: 32px 26px;
        margin-top: 44px;
        box-shadow: 0 2px 24px rgba(41, 121, 255, 0.13);
        color: #FAFAFA;
        text-align: left;
        border: 1.5px solid #e3e3e3;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }

    .profil-contact h6 {
        color: #fff;
        font-weight: bold;
        margin-bottom: 16px;
        letter-spacing: 1px;
        font-size: 1.18rem;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profil-contact i {
        color: #fff;
        margin-right: 12px;
        font-size: 1.18rem;
    }

    .profil-contact div {
        margin-bottom: 12px;
        color: #FAFAFA;
        font-size: 1.11rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media (max-width: 991px) {
        .section-split {
            flex-direction: column;
            gap: 28px;
        }

        .stat-box {
            flex-direction: column;
            gap: 18px;
        }

        .card-grid,
        .struktur-grid {
            flex-direction: column;
            gap: 18px;
        }

        .struktur-grid-wrap {
            flex-direction: column;
            gap: 18px;
        }
    }

    @media (max-width: 767px) {
        .hero-content h1 {
            font-size: 1.3rem;
        }

        .section-title,
        .struktur-title {
            font-size: 1.05rem;
        }

        .hero-content {
            padding: 32px 8px;
        }

        .container-profil {
            padding: 18px 8px;
        }

        .split-img img {
            max-width: 100%;
        }

        .struktur-section {
            padding: 24px 0 16px 0;
        }

        .struktur-title {
            font-size: 1.1rem;
        }

        .struktur-grid-wrap {
            padding: 16px 4px 8px 4px;
        }

        .struktur-card {
            min-width: 140px;
            max-width: 100%;
            padding: 18px 6px 12px 6px;
        }

        .profil-contact {
            padding: 14px 6px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-profil">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Persatuan Tenis Meja Seluruh Indonesia – Sumatera Barat</h1>
        <p>Membangun atlet, klub, dan prestasi menuju level nasional dan internasional.</p>
        <a href="#" class="btn btn-ptmsi me-2"><i class="bi bi-person-plus"></i> Pendaftaran Atlet</a>
        <a href="#" class="btn btn-outline-light"><i class="bi bi-calendar-event"></i> Kalender Kejuaraan</a>
    </div>
</section>

<!-- Tentang PTMSI Sumbar -->
<section class="section-split">
    <div class="split-text">
        <h2 class="fw-bold mb-3">Tentang PTMSI Sumatera Barat</h2>
        <p class="text-muted">PTMSI Sumbar adalah organisasi resmi yang membina olahraga tenis meja di Sumatera Barat. Fokus kami pada pembinaan atlet, pelatih, klub, serta penyelenggaraan event dan kompetisi tingkat daerah hingga nasional.</p>
        <div class="stat-box">
            <div class="stat">
                <h3>32+</h3>
                <p>Klub Terdaftar</p>
            </div>
            <div class="stat">
                <h3>540+</h3>
                <p>Atlet Aktif</p>
            </div>
        </div>
    </div>
    <div class="split-img">
        <img src="<?= base_url('assets/img/pengurus-ptmsi.jpg') ?>" alt="Pengurus PTMSI Sumbar">
    </div>
</section>

<!-- Visi & Misi -->
<section class="bg-white py-5">
    <div class="container">
        <div class="section-title">Visi & Misi</div>
        <div class="card-grid">
            <div class="card">
                <i class="bi bi-bullseye"></i>
                <h5>Visi</h5>
                <p>Mewujudkan Sumatera Barat sebagai pusat pembinaan atlet tenis meja berprestasi.</p>
            </div>
            <div class="card">
                <i class="bi bi-lightning"></i>
                <h5>Misi</h5>
                <p>Meningkatkan kualitas pelatih, atlet, dan kompetisi secara berkelanjutan.</p>
            </div>
            <div class="card">
                <i class="bi bi-people"></i>
                <h5>Tujuan</h5>
                <p>Mengembangkan ekosistem klub, turnamen, dan pembinaan usia dini.</p>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi -->
<section class="struktur-section">
    <div class="struktur-title">STRUKTUR ORGANISASI</div>
    <div class="struktur-grid-wrap">
        <div class="struktur-card">
            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Ketua">
            <h5>Rando Saputra</h5>
            <p>Ketua Umum</p>
        </div>
        <div class="struktur-card">
            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Wakil Ketua">
            <h5>Rando Pratama</h5>
            <p>Wakil Ketua</p>
        </div>
        <div class="struktur-card">
            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Sekretaris">
            <h5>Rando Wijaya</h5>
            <p>Sekretaris</p>
        </div>
        <div class="struktur-card">
            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="Bendahara">
            <h5>Rando Putra</h5>
            <p>Bendahara</p>
        </div>
    </div>
    <div class="profil-contact mt-5">
        <h6><i class="bi bi-info-circle-fill"></i> KONTAK & SEKRETARIAT</h6>
        <div><i class="bi bi-geo-alt-fill"></i>Jl. Contoh No. 123, Padang, Sumatera Barat</div>
        <div><i class="bi bi-envelope-fill"></i>info@ptmsisumbar.or.id</div>
        <div><i class="bi bi-telephone-fill"></i>0812-3456-7890</div>
    </div>
</section>



<?= $this->include('layouts/footer') ?>