<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-2">
                <i class='bx bx-link-alt me-2'></i>Assign Ofisial ke Turnamen
            </h3>
            <p class="text-muted mb-0">Tugaskan ofisial untuk menangani turnamen</p>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="<?= base_url('admin/ofisial/store-assignment') ?>">
                        <?= csrf_field() ?>

                        <!-- Ofisial -->
                        <div class="mb-3">
                            <label for="id_ofisial" class="form-label">
                                <i class='bx bx-user-check me-2'></i>Pilih Ofisial
                            </label>
                            <select class="form-select" id="id_ofisial" name="id_ofisial" required>
                                <option value="">-- Pilih Ofisial --</option>
                                <?php foreach ($ofisials as $ofisial): ?>
                                    <option value="<?= $ofisial['id_ofisial'] ?>" <?= old('id_ofisial') == $ofisial['id_ofisial'] ? 'selected' : '' ?>>
                                        <?= $ofisial['nama_lengkap'] ?> (<?= $ofisial['nomor_lisensi'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($errors = $validation->getError('id_ofisial')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Event -->
                        <div class="mb-3">
                            <label for="id_event" class="form-label">
                                <i class='bx bx-trophy me-2'></i>Pilih Turnamen
                            </label>
                            <select class="form-select" id="id_event" name="id_event" required>
                                <option value="">-- Pilih Turnamen --</option>
                                <?php foreach ($events as $event): ?>
                                    <option value="<?= $event['id_event'] ?>" <?= old('id_event') == $event['id_event'] ? 'selected' : '' ?>>
                                        <?= $event['nama_event'] ?> (<?= date('d/m/Y', strtotime($event['tanggal_mulai'])) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($errors = $validation->getError('id_event')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Role Assignment -->
                        <div class="mb-3">
                            <label for="role_assignment" class="form-label">
                                <i class='bx bx-briefcase me-2'></i>Role Penugasan
                            </label>
                            <select class="form-select" id="role_assignment" name="role_assignment" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="wasit" <?= old('role_assignment') === 'wasit' ? 'selected' : '' ?>>Wasit</option>
                                <option value="juri" <?= old('role_assignment') === 'juri' ? 'selected' : '' ?>>Juri</option>
                                <option value="pencatat" <?= old('role_assignment') === 'pencatat' ? 'selected' : '' ?>>Pencatat</option>
                                <option value="verifikator" <?= old('role_assignment') === 'verifikator' ? 'selected' : '' ?>>Verifikator</option>
                            </select>
                            <?php if ($errors = $validation->getError('role_assignment')): ?>
                                <small class="text-danger"><?= $errors ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info mb-4">
                            <i class='bx bx-info-circle me-2'></i>
                            <strong>Penjelasan Role:</strong>
                            <ul class="mb-0 mt-2">
                                <li><strong>Wasit:</strong> Menjalankan pertandingan</li>
                                <li><strong>Juri:</strong> Memberikan penilaian</li>
                                <li><strong>Pencatat:</strong> Mencatat hasil pertandingan</li>
                                <li><strong>Verifikator:</strong> Memverifikasi hasil pertandingan</li>
                            </ul>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-save me-2'></i>Simpan Penugasan
                            </button>
                            <a href="<?= base_url('admin/ofisial/assignment') ?>" class="btn btn-secondary">
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