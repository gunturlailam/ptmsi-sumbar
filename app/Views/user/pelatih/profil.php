<?= $this->extend('user/pelatih/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-user me-2'></i>Profil Pelatih
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola informasi pribadi dan data pelatih Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/pelatih/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit Profil -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary bg-gradient border-0">
                    <h5 class="text-white mb-0">
                        <i class='bx bx-edit me-2'></i>Edit Profil
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class='bx bx-check-circle me-2'></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('user/pelatih/update-profil') ?>" method="POST">
                        <?= csrf_field() ?>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-600">
                                <i class='bx bx-user me-2'></i>Nama Lengkap
                            </label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="<?= esc($user['nama_lengkap'] ?? '') ?>" readonly>
                            <small class="text-muted">Tidak dapat diubah</small>
                        </div>

                        <!-- Email (Read Only) -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-600">
                                <i class='bx bx-envelope me-2'></i>Email
                            </label>
                            <input type="email" class="form-control" id="email"
                                value="<?= esc($user['email'] ?? '') ?>" disabled>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>

                        <!-- Tingkat Sertifikasi -->
                        <div class="mb-3">
                            <label for="tingkat_sertifikasi" class="form-label fw-600">
                                <i class='bx bx-award me-2'></i>Tingkat Sertifikasi
                            </label>
                            <input type="text" class="form-control" id="tingkat_sertifikasi"
                                value="<?= esc($pelatih['tingkat_sertifikasi'] ?? '-') ?>" readonly>
                            <small class="text-muted">Dikelola oleh Admin</small>
                        </div>

                        <!-- Tanggal Sertifikasi -->
                        <div class="mb-4">
                            <label for="tanggal_sertifikasi" class="form-label fw-600">
                                <i class='bx bx-calendar me-2'></i>Tanggal Sertifikasi
                            </label>
                            <input type="date" class="form-control" id="tanggal_sertifikasi"
                                value="<?= esc($pelatih['tanggal_sertifikasi'] ?? '') ?>" readonly>
                            <small class="text-muted">Dikelola oleh Admin</small>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('user/pelatih/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-x me-2'></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info bg-gradient border-0">
                    <h5 class="text-white mb-0">
                        <i class='bx bx-info-circle me-2'></i>Informasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">ID Pelatih</small>
                        <strong><?= $pelatih['id_pelatih'] ?? '-' ?></strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge bg-success">
                            <i class='bx bx-check-circle me-1'></i>Aktif
                        </span>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Klub</small>
                        <strong><?= $pelatih['nama_klub'] ?? 'Belum ada' ?></strong>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Bergabung Sejak</small>
                        <strong><?= isset($pelatih['dibuat_pada']) ? date('d/m/Y', strtotime($pelatih['dibuat_pada'])) : '-' ?></strong>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning bg-gradient border-0">
                    <h5 class="text-white mb-0">
                        <i class='bx bx-bulb me-2'></i>Informasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Data profil Anda dikelola oleh sistem</small>
                        </li>
                        <li class="mb-2">
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Sertifikasi diverifikasi oleh Admin</small>
                        </li>
                        <li class="mb-2">
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Hubungi admin untuk perubahan data</small>
                        </li>
                        <li>
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Kelola atlet binaan Anda dengan baik</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%) !important;
    }

    .bg-info.bg-gradient {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%) !important;
    }

    .bg-warning.bg-gradient {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
    }
</style>
<?= $this->endSection() ?>