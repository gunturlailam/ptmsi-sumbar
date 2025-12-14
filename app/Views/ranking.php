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
            padding: 35px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            position: relative;
            overflow: hidden;
            border: 2px solid #E8F2FF;
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
            padding: 16px 32px;
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 0 10px;
            position: relative;
            z-index: 1;
            border: 2px solid transparent;
            font-size: 1.05rem;
        }

        .submenu-nav .nav-link:hover {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(30, 144, 255, 0.2);
            border-color: var(--secondary-blue);
        }

        .submenu-nav .nav-link.active {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
        }

        .submenu-nav .nav-link i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .section-card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            margin-bottom: 35px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: 0 12px 40px rgba(30, 144, 255, 0.18);
            transform: translateY(-2px);
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.9rem;
            font-weight: 900;
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(to right, #E8F2FF 0%, transparent 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            color: var(--secondary-blue);
            font-size: 2rem;
        }

        .filter-section {
            background: linear-gradient(135deg, #E8F2FF 0%, #F8F9FA 100%);
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 2px solid #E8F2FF;
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.08);
        }

        .filter-section label {
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 10px;
        }

        .filter-section .form-select {
            border-radius: 15px;
            border: 2px solid #E8F2FF;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-section .form-select:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25);
        }

        .filter-section .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            border: none;
            border-radius: 15px;
            padding: 12px 24px;
            font-weight: 700;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.3);
        }

        .filter-section .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
        }

        .table-gradient {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        }

        .table-gradient thead {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
        }

        .table-gradient thead th {
            padding: 18px 20px;
            font-weight: 700;
            border: none;
            font-size: 1.05rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-gradient tbody tr {
            transition: all 0.4s ease;
            border-bottom: 1px solid #E8F2FF;
        }

        .table-gradient tbody tr:hover {
            background: linear-gradient(135deg, #E8F2FF 0%, #F8F9FA 100%);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.1);
        }

        .table-gradient tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            font-weight: 500;
        }

        .table-gradient tbody td strong {
            font-weight: 700;
            color: var(--primary-blue);
        }

        .badge-posisi {
            padding: 10px 18px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .badge-emas {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #000;
            border: 2px solid #FFD700;
        }

        .badge-emas:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        }

        .badge-perak {
            background: linear-gradient(135deg, #C0C0C0 0%, #808080 100%);
            color: #000;
            border: 2px solid #C0C0C0;
        }

        .badge-perak:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(192, 192, 192, 0.4);
        }

        .badge-perunggu {
            background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
            color: white;
            border: 2px solid #CD7F32;
        }

        .badge-perunggu:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(205, 127, 50, 0.4);
        }

        .badge-default {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border: 2px solid var(--secondary-blue);
        }

        .badge-default:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(30, 144, 255, 0.4);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            border-radius: 25px;
            padding: 30px;
            margin-bottom: 25px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 35px rgba(30, 144, 255, 0.4);
        }

        .stat-card h3 {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .stat-card p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin: 0;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
            background: linear-gradient(135deg, #F8F9FA 0%, #E8F2FF 100%);
            border-radius: 20px;
            border: 2px dashed #E8F2FF;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 25px;
            opacity: 0.4;
            color: var(--secondary-blue);
        }

        .empty-state h4 {
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
            font-size: 1.05rem;
        }

        .alert {
            border-radius: 20px;
            border: 2px solid;
            padding: 20px;
            font-weight: 500;
        }

        .alert-info {
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            border-color: var(--secondary-blue);
            color: var(--primary-blue);
        }

        .alert-warning {
            background: linear-gradient(135deg, #FFF8E1 0%, #FFECB3 100%);
            border-color: #FFA726;
            color: #E65100;
        }

        .alert-success {
            background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
            border-color: #66BB6A;
            color: #2E7D32;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
            padding: 8px 16px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .submenu-nav .nav-link {
                margin: 5px 0;
                display: block;
            }

            .section-card {
                padding: 20px;
            }

            .table-gradient thead th,
            .table-gradient tbody td {
                padding: 12px 10px;
                font-size: 0.9rem;
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
                                        <?php foreach ($allKategori as $key => $label): ?>
                                            <option value="<?= esc($key) ?>" <?= $selectedKategori === $key ? 'selected' : '' ?>>
                                                <?= esc($label) ?>
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
                                            <td><strong><?= number_format($rank['poin'] ?? 0) ?></strong></td>
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