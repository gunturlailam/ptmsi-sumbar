<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>

<style>
    body {
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
    }

    .card-modern {
        background: #1e293b;
        border-radius: 25px;
        box-shadow: 0 8px 30px rgba(245, 158, 11, 0.1);
        padding: 2.5rem 2rem;
        margin-bottom: 2.5rem;
        border: 2px solid rgba(245, 158, 11, 0.1);
    }

    .section-title-modern {
        font-size: 1.5rem;
        font-weight: 900;
        color: #f59e0b;
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .grid-modern-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
    }

    .grid-modern-4 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 2rem;
    }

    .grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    .item-card-modern {
        background: linear-gradient(135deg, #F8F9FA 0%, #E8F2FF 100%);
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.07);
        padding: 1.5rem 1.2rem;
        border: 1.5px solid #E8F2FF;
        margin-bottom: 0.5rem;
        transition: all 0.3s;
    }

    .item-card-modern:hover {
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
        border-color: #1E90FF;
        transform: translateY(-6px) scale(1.03);
    }

    .btn-modern-primary {
        background: linear-gradient(90deg, #1E90FF 60%, #36a2ff 100%);
        color: #fff;
        font-weight: 700;
        padding: 12px 36px;
        border-radius: 22px;
        font-size: 1.1rem;
        border: none;
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }

    .btn-modern-primary:hover {
        background: #1565c0;
        color: #fff;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.13);
    }

    @media (max-width: 768px) {
        .card-modern {
            padding: 1.2rem 0.7rem;
        }

        .section-title-modern {
            font-size: 1.15rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-modern">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">
                <i class="bi bi-building"></i> Profil PTMSI Sumbar
            </h1>
            <p class="hero-subtitle">Persatuan Tenis Meja Seluruh Indonesia Sumatera Barat</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- Tentang Kami -->
    <div class="card-modern">
        <h2 class="section-title-modern">
            <i class="bi bi-info-circle"></i> Tentang Kami
        </h2>
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="Logo PTMSI"
                    style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid #1E90FF; box-shadow: 0 10px 30px rgba(30, 144, 255, 0.3);">
            </div>
            <div class="col-md-8">
                <p class="lead" style="font-size: 1.1rem; line-height: 1.8; color: #666;">
                    Persatuan Tenis Meja Seluruh Indonesia (PTMSI) Sumatera Barat adalah organisasi olahraga
                    yang menaungi dan mengembangkan cabang olahraga tenis meja di wilayah Sumatera Barat.
                    Kami berkomitmen untuk memajukan prestasi atlet, membina pelatih berkualitas, dan
                    menyelenggarakan kompetisi yang berkualitas tinggi.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #666;">
                    Dengan dukungan dari berbagai pihak, PTMSI Sumbar terus berupaya mencetak atlet-atlet
                    berprestasi yang dapat mengharumkan nama daerah dan negara di kancah nasional maupun internasional.
                </p>
            </div>
        </div>
    </div>

    <!-- Visi & Misi -->
    <div class="row mt-5">
        <div class="col-md-6 mb-4">
            <div class="card-modern h-100">
                <h3 class="section-title-modern">
                    <i class="bi bi-eye"></i> Visi
                </h3>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #666;">
                    Menjadikan PTMSI Sumatera Barat sebagai organisasi olahraga tenis meja yang unggul,
                    profesional, dan berprestasi di tingkat nasional maupun internasional.
                </p>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card-modern h-100">
                <h3 class="section-title-modern">
                    <i class="bi bi-bullseye"></i> Misi
                </h3>
                <ul style="font-size: 1.05rem; line-height: 1.8; color: #666;">
                    <li class="mb-2">Mengembangkan dan membina atlet tenis meja berprestasi</li>
                    <li class="mb-2">Meningkatkan kualitas pelatih dan ofisial</li>
                    <li class="mb-2">Menyelenggarakan kompetisi berkualitas secara berkala</li>
                    <li class="mb-2">Membangun kerjasama dengan berbagai pihak</li>
                    <li>Menyediakan sarana dan prasarana yang memadai</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Struktur Organisasi -->
    <div class="card-modern mt-5">
        <h2 class="section-title-modern">
            <i class="bi bi-diagram-3"></i> Struktur Organisasi
        </h2>
        <?php if (!empty($organisasiProvinsi)): ?>
            <div class="grid-modern-2">
                <?php foreach ($organisasiProvinsi as $org): ?>
                    <div class="item-card-modern">
                        <h5 class="fw-bold text-primary mb-3"><?= esc($org['nama'] ?? $org['nama_organisasi'] ?? 'PTMSI Sumbar') ?></h5>
                        <?php if (isset($org['alamat']) && !empty($org['alamat'])): ?>
                            <div class="mb-2">
                                <i class="bi bi-geo-alt text-primary"></i>
                                <strong>Alamat:</strong> <?= esc($org['alamat']) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($org['telepon']) && !empty($org['telepon'])): ?>
                            <div class="mb-2">
                                <i class="bi bi-telephone text-primary"></i>
                                <strong>Telepon:</strong> <?= esc($org['telepon']) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($org['email']) && !empty($org['email'])): ?>
                            <div>
                                <i class="bi bi-envelope text-primary"></i>
                                <strong>Email:</strong> <?= esc($org['email']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-building" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                <p class="text-muted mt-3">Informasi organisasi akan ditampilkan di sini</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pengurus -->
    <div class="card-modern mt-5">
        <h2 class="section-title-modern">
            <i class="bi bi-people"></i> Pengurus PTMSI Sumbar
        </h2>
        <?php if (!empty($pengurusProvinsi)): ?>
            <div class="grid-modern-4">
                <?php foreach ($pengurusProvinsi as $pengurus): ?>
                    <div class="item-card-modern text-center">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #1E90FF, #00BFFF); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; margin: 0 auto 15px;">
                            <i class="bi bi-person"></i>
                        </div>
                        <h5 class="fw-bold text-primary mb-2"><?= esc($pengurus['nama']) ?></h5>
                        <p class="text-muted mb-1"><span class="badge bg-info text-dark"><?= esc($pengurus['jabatan']) ?></span></p>
                        <?php if (!empty($pengurus['email'])): ?>
                            <div class="mb-1"><i class="bi bi-envelope"></i> <small><?= esc($pengurus['email']) ?></small></div>
                        <?php endif; ?>
                        <?php if (!empty($pengurus['telepon'])): ?>
                            <div class="mb-1"><i class="bi bi-telephone"></i> <small><?= esc($pengurus['telepon']) ?></small></div>
                        <?php endif; ?>
                        <?php if (!empty($pengurus['periode_mulai']) && !empty($pengurus['periode_selesai'])): ?>
                            <div class="mb-1"><i class="bi bi-calendar"></i> <small><?= date('Y', strtotime($pengurus['periode_mulai'])) ?> - <?= date('Y', strtotime($pengurus['periode_selesai'])) ?></small></div>
                        <?php endif; ?>
                        <div>
                            <span class="badge bg-<?= $pengurus['status'] === 'aktif' ? 'success' : 'secondary' ?> text-uppercase"><?= strtoupper($pengurus['status']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-people" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                <p class="text-muted mt-3">Data pengurus akan ditampilkan di sini</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Organisasi Kabupaten/Kota -->
    <div class="card-modern mt-5">
        <h2 class="section-title-modern">
            <i class="bi bi-geo-alt"></i> Organisasi Kabupaten/Kota
        </h2>
        <?php if (!empty($organisasiKabupaten)): ?>
            <div class="grid-modern">
                <?php foreach ($organisasiKabupaten as $org): ?>
                    <div class="item-card-modern">
                        <h5 class="fw-bold text-primary mb-3"><?= esc($org['nama'] ?? $org['nama_organisasi'] ?? 'Organisasi Kabupaten/Kota') ?></h5>
                        <?php if (isset($org['alamat']) && !empty($org['alamat'])): ?>
                            <div class="mb-2">
                                <i class="bi bi-geo-alt text-primary"></i>
                                <small class="text-muted"><?= esc($org['alamat']) ?></small>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($org['telepon']) && !empty($org['telepon'])): ?>
                            <div class="mb-2">
                                <i class="bi bi-telephone text-primary"></i>
                                <small class="text-muted"><?= esc($org['telepon']) ?></small>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($org['email']) && !empty($org['email'])): ?>
                            <div>
                                <i class="bi bi-envelope text-primary"></i>
                                <small class="text-muted"><?= esc($org['email']) ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-geo-alt" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                <p class="text-muted mt-3">Data organisasi kabupaten/kota akan ditampilkan di sini</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Kontak -->
    <div class="card-modern mt-5">
        <h2 class="section-title-modern">
            <i class="bi bi-envelope"></i> Hubungi Kami
        </h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="item-card-modern text-center h-100">
                    <i class="bi bi-geo-alt" style="font-size: 3rem; color: #1E90FF; margin-bottom: 15px;"></i>
                    <h5 class="fw-bold text-primary mb-3">Alamat</h5>
                    <p class="text-muted">Jl. Contoh No. 123<br>Padang, Sumatera Barat</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="item-card-modern text-center h-100">
                    <i class="bi bi-telephone" style="font-size: 3rem; color: #1E90FF; margin-bottom: 15px;"></i>
                    <h5 class="fw-bold text-primary mb-3">Telepon</h5>
                    <p class="text-muted">(0751) 123456<br>0812-3456-7890</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="item-card-modern text-center h-100">
                    <i class="bi bi-envelope" style="font-size: 3rem; color: #1E90FF; margin-bottom: 15px;"></i>
                    <h5 class="fw-bold text-primary mb-3">Email</h5>
                    <p class="text-muted">info@ptmsisumbar.or.id<br>ptmsi.sumbar@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="<?= base_url('hubungi-kami') ?>" class="btn-modern-primary">
                <i class="bi bi-send"></i> Kirim Pesan
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>