<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang, <?= session()->get('nama_lengkap') ?? 'Admin' ?>! 🎉</h5>
                        <p class="mb-4">
                            Anda memiliki <span class="fw-bold"><?= $pendingCount ?? 0 ?> pendaftaran</span> yang menunggu verifikasi.
                            Periksa dan kelola data dengan mudah melalui dashboard ini.
                        </p>
                        <a href="<?= base_url('admin/pendaftaran/atlet') ?>" class="btn btn-sm btn-outline-primary">Lihat Pendaftaran</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="<?= base_url('assets/img/illustrations/man-with-laptop-light.png') ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row">
    <!-- Total Atlet -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="bx bx-user bx-sm"></i>
                        </span>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                            <a class="dropdown-item" href="<?= base_url('admin/atlet') ?>">Lihat Detail</a>
                            <a class="dropdown-item" href="<?= base_url('admin/atlet/create') ?>">Tambah Atlet</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Atlet</span>
                <h3 class="card-title mb-2"><?= $totalAtlet ?? 0 ?></h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Atlet Aktif</small>
            </div>
        </div>
    </div>

    <!-- Total Pelatih -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="bx bx-user-check bx-sm"></i>
                        </span>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                            <a class="dropdown-item" href="<?= base_url('admin/pelatih') ?>">Lihat Detail</a>
                            <a class="dropdown-item" href="<?= base_url('admin/pelatih/create') ?>">Tambah Pelatih</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Pelatih</span>
                <h3 class="card-title mb-2"><?= $totalPelatih ?? 0 ?></h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Pelatih Aktif</small>
            </div>
        </div>
    </div>

    <!-- Total Klub -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-info">
                            <i class="bx bx-buildings bx-sm"></i>
                        </span>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="<?= base_url('admin/klub') ?>">Lihat Detail</a>
                            <a class="dropdown-item" href="<?= base_url('admin/klub/create') ?>">Tambah Klub</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Klub</span>
                <h3 class="card-title mb-2"><?= $totalKlub ?? 0 ?></h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Klub Terdaftar</small>
            </div>
        </div>
    </div>

    <!-- Total Event -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="bx bx-trophy bx-sm"></i>
                        </span>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                            <a class="dropdown-item" href="<?= base_url('admin/event') ?>">Lihat Detail</a>
                            <a class="dropdown-item" href="<?= base_url('admin/event/create') ?>">Tambah Event</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Event</span>
                <h3 class="card-title mb-2"><?= $totalEvent ?? 0 ?></h3>
                <small class="text-warning fw-semibold"><i class="bx bx-calendar"></i> Event Aktif</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Berita Terbaru -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Berita Terbaru</h5>
                    <small class="text-muted"><?= $totalBerita ?? 0 ?> Total Berita</small>
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="beritaDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="beritaDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/berita') ?>">Lihat Semua</a>
                        <a class="dropdown-item" href="<?= base_url('admin/berita/create') ?>">Tambah Berita</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <?php if (!empty($beritaTerbaru)): ?>
                        <?php foreach (array_slice($beritaTerbaru, 0, 5) as $berita): ?>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="bx bx-news"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><?= esc(substr($berita['judul'], 0, 40)) ?>...</h6>
                                        <small class="text-muted"><?= date('d M Y', strtotime($berita['tanggal_publikasi'])) ?></small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold"><?= $berita['views'] ?? 0 ?> views</small>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-center text-muted py-3">Belum ada berita</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Event Mendatang -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Event Mendatang</h5>
                    <small class="text-muted"><?= $totalEventAktif ?? 0 ?> Event Aktif</small>
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="eventDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="eventDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/event') ?>">Lihat Semua</a>
                        <a class="dropdown-item" href="<?= base_url('admin/event/create') ?>">Tambah Event</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <?php if (!empty($eventMendatang)): ?>
                        <?php foreach (array_slice($eventMendatang, 0, 5) as $event): ?>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="bx bx-trophy"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><?= esc(substr($event['judul'], 0, 40)) ?>...</h6>
                                        <small class="text-muted"><?= date('d M Y', strtotime($event['tanggal_mulai'])) ?></small>
                                    </div>
                                    <div class="user-progress">
                                        <span class="badge bg-label-primary"><?= $event['status'] ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-center text-muted py-3">Belum ada event</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Pending -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Pendaftaran Pending</h5>
                    <small class="text-muted"><?= $pendingCount ?? 0 ?> Menunggu</small>
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="pendingDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="pendingDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/pendaftaran/atlet') ?>">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <?php if (!empty($pendaftaranPending)): ?>
                        <?php foreach (array_slice($pendaftaranPending, 0, 5) as $pending): ?>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="bx bx-time"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0"><?= esc($pending['nama'] ?? 'Pendaftaran') ?></h6>
                                        <small class="text-muted"><?= $pending['jenis'] ?? 'Atlet' ?> - <?= date('d M Y', strtotime($pending['created_at'])) ?></small>
                                    </div>
                                    <div class="user-progress">
                                        <span class="badge bg-label-warning">Pending</span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-center text-muted py-3">Tidak ada pendaftaran pending</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>