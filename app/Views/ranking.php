<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #003366;
            --secondary-blue: #1E90FF;
            --light-blue: #00BFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            min-height: 100vh;
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

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 50px;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
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
            background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }

        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }

        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
            animation: fadeInUp 1s ease-out;
        }

        .submenu-nav {
            background: white;
            border-radius: 30px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            position: relative;
            overflow: hidden;
        }

        .submenu-nav::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(30, 144, 255, 0.05) 0%, transparent 70%);
        }

        .submenu-nav .nav-link {
            color: var(--primary-blue);
            font-weight: 700;
            padding: 14px 28px;
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0 8px;
            position: relative;
            z-index: 1;
        }

        .submenu-nav .nav-link:hover,
        .submenu-nav .nav-link.active {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--light-blue) 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
            transform: translateY(-2px);
        }

        .section-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--secondary-blue);
        }

        .filter-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .table-gradient {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-gradient thead {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
        }

        .table-gradient thead th {
            padding: 15px;
            font-weight: 600;
            border: none;
        }

        .table-gradient tbody tr {
            transition: all 0.3s ease;
        }

        .table-gradient tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .table-gradient tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .badge-posisi {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-emas {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #000;
        }

        .badge-perak {
            background: linear-gradient(135deg, #C0C0C0 0%, #808080 100%);
            color: #000;
        }

        .badge-perunggu {
            background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
            color: white;
        }

        .badge-default {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .submenu-nav .nav-link {
                margin: 5px 0;
                display: block;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/header') ?>

    <div class="hero-section">
        <div class="container">
            <h1><i class="bi bi-trophy"></i> Ranking & Statistik</h1>
            <p>Peringkat Atlet, Statistik Pertandingan, dan Rekap Medali PTMSI Sumbar</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#ranking-atlet" data-bs-toggle="pill">
                        <i class="bi bi-list-ol"></i> Ranking Atlet Provinsi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#statistik-pertandingan" data-bs-toggle="pill">
                        <i class="bi bi-bar-chart"></i> Statistik Pertandingan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rekap-medali" data-bs-toggle="pill">
                        <i class="bi bi-award"></i> Rekap Perolehan Medali
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- 1. Ranking Atlet Provinsi per Kategori -->
            <div class="tab-pane fade show active" id="ranking-atlet">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-list-ol"></i> Ranking Atlet Provinsi per Kategori
                    </h2>

                    <!-- Filter -->
                    <div class="filter-section">
                        <form method="get" action="<?= base_url('ranking') ?>">
                            <div class="row align-items-end">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">Filter Kategori Usia:</label>
                                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                                        <option value="all" <?= $selectedKategori === 'all' ? 'selected' : '' ?>>Semua Kategori</option>
                                        <?php foreach ($allKategori as $kat): ?>
                                            <option value="<?= esc($kat) ?>" <?= $selectedKategori === $kat ? 'selected' : '' ?>>
                                                <?= esc($kat) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-funnel"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Ranking -->
                    <?php if (!empty($rankings)): ?>
                        <div class="table-responsive">
                            <table class="table table-gradient">
                                <thead>
                                    <tr>
                                        <th width="80">Posisi</th>
                                        <th>Nama Atlet</th>
                                        <th>Klub</th>
                                        <th>Kategori</th>
                                        <th>Gender</th>
                                        <th width="100">Poin</th>
                                        <th width="150">Berlaku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rankings as $rank): ?>
                                        <tr>
                                            <td>
                                                <?php if ($rank['posisi'] == 1): ?>
                                                    <span class="badge badge-emas">#<?= $rank['posisi'] ?></span>
                                                <?php elseif ($rank['posisi'] == 2): ?>
                                                    <span class="badge badge-perak">#<?= $rank['posisi'] ?></span>
                                                <?php elseif ($rank['posisi'] == 3): ?>
                                                    <span class="badge badge-perunggu">#<?= $rank['posisi'] ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-default">#<?= $rank['posisi'] ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong><?= esc($rank['nama_lengkap']) ?></strong></td>
                                            <td><?= esc($rank['nama_klub'] ?? '-') ?></td>
                                            <td><?= esc($rank['kategori_usia']) ?></td>
                                            <td>
                                                <?php if ($rank['jenis_kelamin'] === 'L'): ?>
                                                    <i class="bi bi-gender-male text-primary"></i> Putra
                                                <?php else: ?>
                                                    <i class="bi bi-gender-female text-danger"></i> Putri
                                                <?php endif; ?>
                                            </td>
                                            <td><strong><?= number_format($rank['poin']) ?></strong></td>
                                            <td><?= date('d M Y', strtotime($rank['tanggal_berlaku'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h4>Belum Ada Data Ranking</h4>
                            <p>Data ranking atlet akan ditampilkan di sini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 2. Statistik Pertandingan -->
            <div class="tab-pane fade" id="statistik-pertandingan">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-bar-chart"></i> Statistik Pertandingan
                    </h2>

                    <?php if (!empty($statistikPertandingan)): ?>
                        <div class="table-responsive">
                            <table class="table table-gradient">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Nama Event</th>
                                        <th width="150">Total Pertandingan</th>
                                        <th width="150">Tanggal Mulai</th>
                                        <th width="150">Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($statistikPertandingan as $stat): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><strong><?= esc($stat['nama_event']) ?></strong></td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    <?= number_format($stat['total_pertandingan']) ?> Pertandingan
                                                </span>
                                            </td>
                                            <td><?= date('d M Y', strtotime($stat['tanggal_mulai'])) ?></td>
                                            <td><?= date('d M Y', strtotime($stat['tanggal_selesai'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="bi bi-graph-down"></i>
                            <h4>Belum Ada Data Statistik</h4>
                            <p>Statistik pertandingan akan ditampilkan di sini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 3. Rekap Perolehan Medali -->
            <div class="tab-pane fade" id="rekap-medali">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-award"></i> Rekap Perolehan Medali
                    </h2>

                    <!-- Rekap Medali per Klub -->
                    <h4 class="text-primary mb-3"><i class="bi bi-building"></i> Perolehan Medali per Klub</h4>
                    <?php if (!empty($rekapMedaliKlub)): ?>
                        <div class="table-responsive mb-5">
                            <table class="table table-gradient">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Nama Klub</th>
                                        <th width="100" class="text-center">
                                            <i class="bi bi-trophy-fill" style="color: #FFD700;"></i> Emas
                                        </th>
                                        <th width="100" class="text-center">
                                            <i class="bi bi-trophy-fill" style="color: #C0C0C0;"></i> Perak
                                        </th>
                                        <th width="100" class="text-center">
                                            <i class="bi bi-trophy-fill" style="color: #CD7F32;"></i> Perunggu
                                        </th>
                                        <th width="100" class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rekapMedaliKlub as $medali): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><strong><?= esc($medali['nama_klub']) ?></strong></td>
                                            <td class="text-center">
                                                <span class="badge badge-emas"><?= $medali['emas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-perak"><?= $medali['perak'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-perunggu"><?= $medali['perunggu'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <strong><?= $medali['emas'] + $medali['perak'] + $medali['perunggu'] ?></strong>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="bi bi-trophy"></i>
                            <h4>Belum Ada Data Medali Klub</h4>
                            <p>Rekap medali per klub akan ditampilkan di sini</p>
                        </div>
                    <?php endif; ?>

                    <!-- Rekap Medali per Atlet -->
                    <h4 class="text-primary mb-3 mt-5"><i class="bi bi-person-badge"></i> Perolehan Medali per Atlet</h4>
                    <?php if (!empty($rekapMedaliAtlet)): ?>
                        <div class="table-responsive">
                            <table class="table table-gradient">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Nama Atlet</th>
                                        <th>Klub</th>
                                        <th width="100" class="text-center">
                                            <i class="bi bi-trophy-fill" style="color: #FFD700;"></i> Emas
                                        </th>
                                        <th width="100" class="text-center">
                                            <i class="bi bi-trophy-fill" style="color: #C0C0C0;"></i> Perak
                                        </th>
                                        <th width="100" class="text-center">
                                            <i class="bi bi-trophy-fill" style="color: #CD7F32;"></i> Perunggu
                                        </th>
                                        <th width="100" class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rekapMedaliAtlet as $medali): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><strong><?= esc($medali['nama_lengkap']) ?></strong></td>
                                            <td><?= esc($medali['nama_klub'] ?? '-') ?></td>
                                            <td class="text-center">
                                                <span class="badge badge-emas"><?= $medali['emas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-perak"><?= $medali['perak'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-perunggu"><?= $medali['perunggu'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <strong><?= $medali['emas'] + $medali['perak'] + $medali['perunggu'] ?></strong>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="bi bi-trophy"></i>
                            <h4>Belum Ada Data Medali Atlet</h4>
                            <p>Rekap medali per atlet akan ditampilkan di sini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Smooth scroll for navigation
        document.querySelectorAll('a[data-bs-toggle="pill"]').forEach(link => {
            link.addEventListener('shown.bs.tab', function(e) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>