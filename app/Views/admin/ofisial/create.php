<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-2">
                <i class='bx bx-plus-circle me-2'></i>Tambah Ofisial Baru
            </h3>
            <p class="text-muted mb-0">Tambahkan ofisial baru ke sistem PTMSI</p>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="<?= base_url('admin/ofisial/store') ?>">
                        <?= csrf_field() ?>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">
                                <i class='bx bx-user me-2'></i>Nama Lengkap
                            </label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="<?= old('nama_lengkap') ?>" required>
                            <?php if ($errors = $validation->getError('nama_lengkap')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class='bx bx-at me-2'></i>Username
                            </label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?= old('username') ?>" required>
                            <?php if ($errors = $validation->getError('username')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class='bx bx-envelope me-2'></i>Email
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= old('email') ?>" required>
                            <?php if ($errors = $validation->getError('email')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- No HP -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">
                                <i class='bx bx-phone me-2'></i>No HP
                            </label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="<?= old('no_hp') ?>" required>
                            <?php if ($errors = $validation->getError('no_hp')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Nomor Lisensi -->
                        <div class="mb-3">
                            <label for="nomor_lisensi" class="form-label">
                                <i class='bx bx-id-card me-2'></i>Nomor Lisensi
                            </label>
                            <input type="text" class="form-control" id="nomor_lisensi" name="nomor_lisensi"
                                value="<?= old('nomor_lisensi') ?>" placeholder="LIC-001-2025" required>
                            <?php if ($errors = $validation->getError('nomor_lisensi')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class='bx bx-toggle-right me-2'></i>Status
                            </label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="aktif" <?= old('status') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="nonaktif" <?= old('status') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                            <?php if ($errors = $validation->getError('status')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info mb-4">
                            <i class='bx bx-info-circle me-2'></i>
                            <strong>Password Default:</strong> ofisial2025
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-save me-2'></i>Simpan
                            </button>
                            <a href="<?= base_url('admin/ofisial') ?>" class="btn btn-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>