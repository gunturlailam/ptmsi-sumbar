<?= $this->extend('user/atlet/layouts/main') ?>

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
                                <i class='bx bx-user me-2'></i>Profil Atlet
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola informasi pribadi dan data atlet Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/atlet/dashboard') ?>" class="btn btn-outline-secondary">
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

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class='bx bx-exclamation-circle me-2'></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('user/atlet/update-profil') ?>" method="POST">
                        <?= csrf_field() ?>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-600">
                                <i class='bx bx-user me-2'></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="<?= old('nama_lengkap', $atlet['nama_lengkap'] ?? '') ?>" required>
                            <small class="text-muted">Minimal 3 karakter</small>
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

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label fw-600">
                                <i class='bx bx-calendar me-2'></i>Tanggal Lahir <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="<?= old('tanggal_lahir', $atlet['tanggal_lahir'] ?? '') ?>" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label fw-600">
                                <i class='bx bx-male-female me-2'></i>Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?= old('jenis_kelamin', $atlet['jenis_kelamin'] ?? '') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old('jenis_kelamin', $atlet['jenis_kelamin'] ?? '') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <!-- No HP -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label fw-600">
                                <i class='bx bx-phone me-2'></i>No. HP/WhatsApp <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                value="<?= old('no_hp', $atlet['no_hp'] ?? '') ?>"
                                placeholder="08xxxxxxxxxx" required>
                            <small class="text-muted">10-15 digit</small>
                        </div>

                        <!-- Kategori Usia -->
                        <div class="mb-3">
                            <label for="kategori_usia" class="form-label fw-600">
                                <i class='bx bx-cake me-2'></i>Kategori Usia
                            </label>
                            <select class="form-select" id="kategori_usia" name="kategori_usia">
                                <option value="">Otomatis berdasarkan usia</option>
                                <option value="U-12" <?= old('kategori_usia', $atlet['kategori_usia'] ?? '') === 'U-12' ? 'selected' : '' ?>>U-12 (Under 12)</option>
                                <option value="U-15" <?= old('kategori_usia', $atlet['kategori_usia'] ?? '') === 'U-15' ? 'selected' : '' ?>>U-15 (Under 15)</option>
                                <option value="U-18" <?= old('kategori_usia', $atlet['kategori_usia'] ?? '') === 'U-18' ? 'selected' : '' ?>>U-18 (Under 18)</option>
                                <option value="Senior" <?= old('kategori_usia', $atlet['kategori_usia'] ?? '') === 'Senior' ? 'selected' : '' ?>>Senior (18+)</option>
                            </select>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-600">
                                <i class='bx bx-map me-2'></i>Alamat <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat', $atlet['alamat'] ?? '') ?></textarea>
                            <small class="text-muted">Minimal 5 karakter</small>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-save me-2'></i>Simpan Perubahan
                            </button>
                            <a href="<?= base_url('user/atlet/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-x me-2'></i>Batal
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
                        <small class="text-muted d-block mb-1">ID Atlet</small>
                        <strong><?= $atlet['id_atlet'] ?? '-' ?></strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge bg-success">
                            <i class='bx bx-check-circle me-1'></i>Aktif
                        </span>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Klub</small>
                        <strong><?= $atlet['nama_klub'] ?? 'Belum ada' ?></strong>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Bergabung Sejak</small>
                        <strong><?= isset($atlet['dibuat_pada']) ? date('d/m/Y', strtotime($atlet['dibuat_pada'])) : '-' ?></strong>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning bg-gradient border-0">
                    <h5 class="text-white mb-0">
                        <i class='bx bx-bulb me-2'></i>Tips
                    </h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Pastikan data pribadi Anda akurat</small>
                        </li>
                        <li class="mb-2">
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Email tidak dapat diubah setelah pendaftaran</small>
                        </li>
                        <li class="mb-2">
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Nomor HP harus aktif untuk komunikasi</small>
                        </li>
                        <li>
                            <i class='bx bx-check text-success me-2'></i>
                            <small>Kategori usia akan mempengaruhi turnamen</small>
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