<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klub & Pengurus - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        .nav-menu-card {
            background: linear-gradient(135deg, #fff 0%, #E8F2FF 100%);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            height: 100%;
        }

        .nav-menu-card:hover {
            background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.3);
            border-color: #1E90FF;
        }

        .nav-menu-card .nav-icon-wrapper {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover .nav-icon-wrapper {
            background: #fff;
            transform: scale(1.1) rotate(5deg);
        }

        .nav-menu-card .nav-icon-wrapper i {
            font-size: 2rem;
            color: #fff;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover .nav-icon-wrapper i {
            color: #1E90FF;
        }

        .nav-menu-card h6 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 8px;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover h6 {
            color: #fff;
        }

        .nav-menu-card p {
            font-size: 0.85rem;
            color: #666;
            margin: 0;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover p {
            color: rgba(255, 255, 255, 0.9);
        }

        .klub-card {
            background: #fff;
            border-radius: 25px;
            padding: 25px;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .klub-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, #1E90FF 0%, #00BFFF 100%);
        }

        .klub-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            border-color: #1E90FF;
        }

        .klub-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #E8F2FF;
        }

        .klub-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
        }

        .klub-icon i {
            font-size: 2rem;
            color: #fff;
        }

        .klub-title h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 5px;
        }

        .klub-badge {
            background: linear-gradient(135deg, #E8F2FF, #fff);
            color: #1E90FF;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #1E90FF;
        }

        .klub-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.95rem;
            color: #555;
        }

        .klub-info i {
            color: #1E90FF;
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
        }

        .syarat-card {
            background: linear-gradient(135deg, #F8F9FA 0%, #E8F2FF 100%);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 15px;
            border: 2px solid #E8F2FF;
            transition: all 0.3s ease;
            display: flex;
            align-items: start;
            gap: 15px;
        }

        .syarat-card:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.15);
            border-color: #1E90FF;
        }

        .syarat-number {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 900;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.3);
        }

        .filter-section {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        }

        .filter-section select,
        .filter-section input {
            border: 2px solid #E8F2FF;
            border-radius: 15px;
            padding: 12px 18px;
            transition: all 0.3s;
        }

        .filter-section select:focus,
        .filter-section input:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 0 4px rgba(30, 144, 255, 0.1);
            outline: none;
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <!-- Hero Section -->
    <div class="hero-modern">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">
                    <i class="bi bi-building-fill"></i> Klub & Pengurus PTMSI Sumbar
                </h1>
                <p class="hero-subtitle">Informasi lengkap klub, kontak, syarat pendirian, dan database wasit</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="row g-3 mb-5">
            <div class="col-md-3 col-6">
                <a href="#daftar-klub" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <h6>Daftar Klub</h6>
                    <p>Klub tenis meja</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#kontak-klub" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h6>Kontak Klub</h6>
                    <p>Informasi kontak</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#syarat-pendirian" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </div>
                    <h6>Syarat Pendirian</h6>
                    <p>Klub baru</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#database-wasit" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-flag-fill"></i>
                    </div>
                    <h6>Database Wasit</h6>
                    <p>Wasit & ofisial</p>
                </a>
            </div>
        </div>

        <!-- Daftar Klub Section -->
        <div id="daftar-klub" class="card-modern">
            <h2 class="section-title-modern">
                <i class="bi bi-building-fill"></i> Daftar Klub Tenis Meja se-Sumatera Barat
            </h2>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="row g-3">
                    <div class="col-md-4">
                        <select id="filterKabKota" class="form-select">
                            <option value="">Semua Kab/Kota</option>
                            <option value="Padang">Padang</option>
                            <option value="Bukittinggi">Bukittinggi</option>
                            <option value="Payakumbuh">Payakumbuh</option>
                            <option value="Solok">Solok</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="searchKlub" class="form-control" placeholder="🔍 Cari nama klub...">
                    </div>
                </div>
            </div>

            <?php if (!empty($klub)): ?>
                <div class="grid-modern">
                    <?php foreach ($klub as $k): ?>
                        <div class="klub-card">
                            <div class="klub-header">
                                <div class="klub-icon">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="klub-title flex-grow-1">
                                    <h4><?= esc($k['nama']) ?></h4>
                                    <span class="klub-badge">
                                        <?= esc($k['nama_organisasi'] ?? 'PTMSI Sumbar') ?>
                                    </span>
                                </div>
                            </div>

                            <div class="klub-info">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span><?= esc($k['alamat'] ?? 'Alamat belum tersedia') ?></span>
                            </div>

                            <?php if (!empty($k['penanggung_jawab'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-person-fill"></i>
                                    <span><strong>PJ:</strong> <?= esc($k['penanggung_jawab']) ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($k['telepon'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span><?= esc($k['telepon']) ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($k['tanggal_berdiri'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-calendar-check"></i>
                                    <span><strong>Berdiri:</strong> <?= date('d M Y', strtotime($k['tanggal_berdiri'])) ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="klub-info">
                                <i class="bi bi-check-circle-fill"></i>
                                <span><strong>Status:</strong> <?= esc(ucfirst($k['status'] ?? 'aktif')) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-building-x" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                    <h5 class="mt-3 fw-bold">Belum ada data klub</h5>
                    <p class="text-muted">Data klub akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Kontak Klub Section -->
        <div id="kontak-klub" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-telephone-fill"></i> Kontak Klub
            </h2>

            <div class="alert alert-info d-flex align-items-center mb-4" role="alert" style="border-radius: 20px; border-left: 5px solid #0dcaf0;">
                <i class="bi bi-info-circle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    Berikut adalah informasi kontak lengkap klub-klub tenis meja di Sumatera Barat. Untuk informasi lebih lanjut, silakan hubungi langsung klub yang bersangkutan.
                </div>
            </div>

            <?php if (!empty($klub)): ?>
                <div class="grid-modern-2">
                    <?php foreach ($klub as $k): ?>
                        <div class="item-card-modern">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div style="width: 60px; height: 60px; border-radius: 15px; background: linear-gradient(135deg, #1E90FF, #00BFFF); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="bi bi-building" style="font-size: 1.8rem; color: #fff;"></i>
                                </div>
                                <h5 class="fw-bold text-primary mb-0"><?= esc($k['nama']) ?></h5>
                            </div>
                            <div class="klub-info">
                                <i class="bi bi-geo-alt"></i>
                                <span><?= esc($k['alamat'] ?? 'Alamat belum tersedia') ?></span>
                            </div>
                            <?php if (!empty($k['penanggung_jawab'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-person"></i>
                                    <span><strong>PJ:</strong> <?= esc($k['penanggung_jawab']) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($k['telepon'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-telephone"></i>
                                    <a href="tel:<?= esc($k['telepon']) ?>" style="color: #1E90FF; text-decoration: none; font-weight: 600;">
                                        <?= esc($k['telepon']) ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-telephone-x" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                    <h5 class="mt-3 fw-bold">Belum ada data kontak klub</h5>
                    <p class="text-muted">Informasi kontak klub akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Syarat Pendirian Section -->
        <div id="syarat-pendirian" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-clipboard-check-fill"></i> Syarat Pendirian Klub Baru
            </h2>

            <p class="lead mb-4" style="color: #555; line-height: 1.8;">
                Untuk mendirikan klub tenis meja baru yang terdaftar di PTMSI Sumatera Barat, berikut adalah persyaratan dan prosedur yang harus dipenuhi:
            </p>

            <div class="syarat-card">
                <div class="syarat-number">1</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Surat Permohonan Pendirian Klub</h6>
                    <p class="text-muted mb-0">Mengajukan surat permohonan pendirian klub yang ditujukan kepada Ketua Umum PTMSI Sumatera Barat dengan melampirkan proposal kegiatan klub.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">2</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Akta Pendirian Klub</h6>
                    <p class="text-muted mb-0">Memiliki akta pendirian klub yang telah disahkan oleh notaris dan terdaftar di instansi terkait.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">3</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Struktur Kepengurusan</h6>
                    <p class="text-muted mb-0">Memiliki struktur kepengurusan yang jelas minimal terdiri dari Ketua, Sekretaris, dan Bendahara dengan melampirkan fotokopi KTP pengurus.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">4</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Anggota Minimal</h6>
                    <p class="text-muted mb-0">Memiliki minimal 10 (sepuluh) orang anggota aktif dengan melampirkan daftar nama, alamat, dan fotokopi KTP anggota.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">5</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Sarana dan Prasarana</h6>
                    <p class="text-muted mb-0">Memiliki atau memiliki akses ke sarana latihan berupa meja tenis meja standar minimal 2 (dua) meja beserta perlengkapannya.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">6</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Program Kerja</h6>
                    <p class="text-muted mb-0">Menyusun program kerja klub untuk jangka waktu minimal 1 (satu) tahun yang mencakup kegiatan latihan rutin dan target prestasi.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">7</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Rekomendasi</h6>
                    <p class="text-muted mb-0">Mendapatkan rekomendasi dari PTMSI Kabupaten/Kota setempat (jika ada) atau langsung dari PTMSI Provinsi Sumatera Barat.</p>
                </div>
            </div>

            <div class="syarat-card">
                <div class="syarat-number">8</div>
                <div>
                    <h6 class="fw-bold text-primary mb-2">Biaya Administrasi</h6>
                    <p class="text-muted mb-0">Membayar biaya administrasi pendaftaran klub sesuai dengan ketentuan yang berlaku di PTMSI Sumatera Barat.</p>
                </div>
            </div>

            <div class="alert alert-warning d-flex align-items-center mt-4" role="alert" style="border-radius: 20px; border-left: 5px solid #ffc107;">
                <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    <strong>Informasi Lebih Lanjut:</strong> Untuk konsultasi dan pengajuan pendirian klub baru, silakan hubungi Sekretariat PTMSI Sumbar di <strong>0812-3456-7890</strong> atau email ke <strong>sekretariat@ptmsisumbar.or.id</strong>
                </div>
            </div>
        </div>

        <!-- Database Wasit Section -->
        <div id="database-wasit" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-flag-fill"></i> Database Wasit & Ofisial Pertandingan
            </h2>

            <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-radius: 20px; border-left: 5px solid #28a745;">
                <i class="bi bi-check-circle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    Database wasit dan ofisial pertandingan tenis meja yang terdaftar dan bersertifikat di PTMSI Sumatera Barat.
                </div>
            </div>

            <?php if (!empty($wasit)): ?>
                <div class="grid-modern-4">
                    <?php foreach ($wasit as $w): ?>
                        <div class="item-card-modern">
                            <div class="text-center mb-3">
                                <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($w['nama']) ?>"
                                    style="width: 80px; height: 80px; border-radius: 50%; border: 4px solid #1E90FF; object-fit: cover;">
                            </div>
                            <h6 class="fw-bold text-primary text-center mb-2"><?= esc($w['nama']) ?></h6>
                            <div class="text-center mb-3">
                                <?php if ($w['jenis'] == 'Wasit'): ?>
                                    <span class="badge" style="background: linear-gradient(135deg, #1E90FF, #00BFFF); padding: 6px 14px; border-radius: 20px;">
                                        <i class="bi bi-flag-fill"></i> Wasit
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: linear-gradient(135deg, #28a745, #20c997); padding: 6px 14px; border-radius: 20px;">
                                        <i class="bi bi-person-badge"></i> Ofisial
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="klub-info">
                                <i class="bi bi-award"></i>
                                <span><strong>Lisensi:</strong> <?= esc($w['lisensi']) ?></span>
                            </div>
                            <div class="klub-info">
                                <i class="bi bi-geo-alt"></i>
                                <span><?= esc($w['kab_kota']) ?></span>
                            </div>
                            <?php if (!empty($w['telepon'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-telephone"></i>
                                    <span><?= esc($w['telepon']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-flag" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                    <h5 class="mt-3 fw-bold">Belum ada data wasit & ofisial</h5>
                    <p class="text-muted">Database wasit dan ofisial akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="item-card-modern h-100">
                        <h5 class="text-primary mb-3">
                            <i class="bi bi-flag-fill"></i> Menjadi Wasit
                        </h5>
                        <p class="text-muted">
                            Untuk menjadi wasit tenis meja bersertifikat, Anda harus mengikuti pelatihan dan ujian sertifikasi yang diselenggarakan oleh PTMSI.
                        </p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Mengikuti Pelatihan Wasit</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Lulus Ujian Teori & Praktik</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Mendapat Sertifikat Lisensi</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="item-card-modern h-100">
                        <h5 class="text-success mb-3">
                            <i class="bi bi-person-badge-fill"></i> Menjadi Ofisial
                        </h5>
                        <p class="text-muted">
                            Ofisial pertandingan bertugas membantu kelancaran jalannya pertandingan seperti pencatat skor, pengatur jadwal, dan koordinator teknis.
                        </p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Mengikuti Pelatihan Ofisial</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Memahami Sistem Pertandingan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Mendapat Sertifikat</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Smooth scroll untuk navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Filter klub
        const filterKabKota = document.getElementById('filterKabKota');
        const searchKlub = document.getElementById('searchKlub');
        const klubCards = document.querySelectorAll('.klub-card');

        if (filterKabKota) {
            filterKabKota.addEventListener('change', filterKlubFunction);
        }

        if (searchKlub) {
            searchKlub.addEventListener('input', filterKlubFunction);
        }

        function filterKlubFunction() {
            const kabKotaValue = filterKabKota ? filterKabKota.value.toLowerCase() : '';
            const searchValue = searchKlub ? searchKlub.value.toLowerCase() : '';

            klubCards.forEach(card => {
                const klubText = card.querySelector('.klub-title h4').textContent.toLowerCase();
                const alamatText = card.querySelector('.klub-info').textContent.toLowerCase();

                const matchKabKota = !kabKotaValue || alamatText.includes(kabKotaValue);
                const matchSearch = !searchValue || klubText.includes(searchValue);

                card.style.display = matchKabKota && matchSearch ? 'block' : 'none';
            });
        }
    </script>
</body>

</html>