<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 50px 50px;
            margin-bottom: 40px;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin-top: -80px;
            position: relative;
            z-index: 2;
        }

        .stats-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(30, 144, 255, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(30, 144, 255, 0.15);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 20px;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: #003366;
            margin-bottom: 10px;
        }

        .stats-label {
            color: #666;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .quick-actions {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(30, 144, 255, 0.1);
        }

        .action-btn {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 15px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
            color: white;
        }

        .recent-activity {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(30, 144, 255, 0.1);
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
            margin-right: 15px;
        }

        .profile-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(30, 144, 255, 0.1);
            text-align: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin: 0 auto 20px;
        }

        .role-badge {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }

        .section-title {
            color: #003366;
            font-weight: 900;
            font-size: 1.5rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #1E90FF;
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="bi bi-speedometer2"></i> Dashboard Saya
                    </h1>
                    <p class="lead mb-0">Selamat datang kembali, <?= esc($user['nama_lengkap']) ?>!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Welcome Card -->
        <div class="row">
            <div class="col-12">
                <div class="welcome-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="fw-bold text-primary mb-3">
                                Selamat datang di Dashboard <?= ucfirst($role) ?>!
                            </h2>
                            <p class="text-muted mb-0">
                                Kelola profil Anda, lihat aktivitas terbaru, dan akses fitur-fitur yang tersedia untuk <?= $role ?>.
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="profile-avatar">
                                <i class="bi bi-person"></i>
                            </div>
                            <h5 class="fw-bold text-primary"><?= esc($user['nama_lengkap']) ?></h5>
                            <span class="role-badge"><?= ucfirst($role) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mt-5">
            <?php if ($role === 'atlet'): ?>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Kompetisi Diikuti</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Medali Diraih</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <div class="stats-number">-</div>
                        <div class="stats-label">Ranking Saat Ini</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #6f42c1 0%, #6610f2 100%);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Event Mendatang</div>
                    </div>
                </div>
            <?php elseif ($role === 'pelatih'): ?>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Atlet Dibina</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Sertifikat</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Jadwal Latihan</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #6f42c1 0%, #6610f2 100%);">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Prestasi Atlet</div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Event Diawasi</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Lisensi Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Tugas Selesai</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #6f42c1 0%, #6610f2 100%);">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="stats-number">0</div>
                        <div class="stats-label">Tugas Pending</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="row mt-4">
            <!-- Quick Actions -->
            <div class="col-md-8 mb-4">
                <div class="quick-actions">
                    <h3 class="section-title">
                        <i class="bi bi-lightning"></i> Aksi Cepat
                    </h3>
                    <div class="row">
                        <?php if ($role === 'atlet'): ?>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('user/profile') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-person-gear"></i> Update Profil
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('event') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-calendar-plus"></i> Daftar Event
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('ranking') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-bar-chart"></i> Lihat Ranking
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('layanan-online') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-file-earmark-plus"></i> Layanan Online
                                </a>
                            </div>
                        <?php elseif ($role === 'pelatih'): ?>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('user/profile') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-person-gear"></i> Update Profil
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('atlet-pelatih') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-people"></i> Kelola Atlet
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('layanan-online') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-award"></i> Ajukan Sertifikasi
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('pembinaan') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-mortarboard"></i> Program Pembinaan
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('user/profile') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-person-gear"></i> Update Profil
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('event') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-calendar-check"></i> Event Tugas
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('dokumen') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-file-earmark-text"></i> Dokumen Regulasi
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?= base_url('layanan-online') ?>" class="action-btn w-100 text-center">
                                    <i class="bi bi-globe"></i> Layanan Online
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Profile Summary -->
            <div class="col-md-4 mb-4">
                <div class="profile-card">
                    <h3 class="section-title justify-content-center">
                        <i class="bi bi-person-circle"></i> Profil Saya
                    </h3>
                    <div class="profile-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2"><?= esc($user['nama_lengkap']) ?></h5>
                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope"></i> <?= esc($user['email']) ?>
                    </p>
                    <p class="text-muted mb-3">
                        <i class="bi bi-phone"></i> <?= esc($user['nohp'] ?? 'Belum diisi') ?>
                    </p>
                    <span class="role-badge"><?= ucfirst($role) ?></span>
                    <div class="mt-3">
                        <a href="<?= base_url('user/profile') ?>" class="action-btn">
                            <i class="bi bi-pencil"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="recent-activity">
                    <h3 class="section-title">
                        <i class="bi bi-clock-history"></i> Aktivitas Terbaru
                    </h3>
                    <div class="activity-item d-flex align-items-center">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Akun berhasil dibuat</h6>
                            <small class="text-muted">
                                <?= date('d M Y H:i', strtotime($user['dibuat_pada'])) ?>
                            </small>
                        </div>
                    </div>
                    <div class="activity-item d-flex align-items-center">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Belum ada aktivitas lain</h6>
                            <small class="text-muted">Mulai gunakan fitur-fitur yang tersedia</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>
</body>

</html>