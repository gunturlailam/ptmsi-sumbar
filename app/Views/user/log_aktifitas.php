<?= $this->extend('user/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-4">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-history me-2'></i>Log Aktivitas
                            </h3>
                            <p class="text-muted mb-0">
                                Riwayat lengkap semua aktivitas akun Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="jenis_entitas" class="form-label">Jenis Entitas</label>
                            <select class="form-select" id="jenis_entitas" name="jenis_entitas">
                                <option value="">Semua</option>
                                <option value="atlet" <?= ($jenis_entitas ?? '') === 'atlet' ? 'selected' : '' ?>>Atlet</option>
                                <option value="klub" <?= ($jenis_entitas ?? '') === 'klub' ? 'selected' : '' ?>>Klub</option>
                                <option value="turnamen" <?= ($jenis_entitas ?? '') === 'turnamen' ? 'selected' : '' ?>>Turnamen</option>
                                <option value="profil" <?= ($jenis_entitas ?? '') === 'profil' ? 'selected' : '' ?>>Profil</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="aksi" class="form-label">Aksi</label>
                            <select class="form-select" id="aksi" name="aksi">
                                <option value="">Semua</option>
                                <option value="create" <?= ($aksi ?? '') === 'create' ? 'selected' : '' ?>>Buat</option>
                                <option value="update" <?= ($aksi ?? '') === 'update' ? 'selected' : '' ?>>Ubah</option>
                                <option value="delete" <?= ($aksi ?? '') === 'delete' ? 'selected' : '' ?>>Hapus</option>
                                <option value="view" <?= ($aksi ?? '') === 'view' ? 'selected' : '' ?>>Lihat</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal ?? '' ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-search me-2'></i>Filter
                            </button>
                            <a href="<?= base_url('user/log-aktifitas') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-reset me-2'></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Tabel -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($log_aktifitas)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-1 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada aktivitas</h5>
                        <p class="text-muted">Tidak ada log aktivitas yang sesuai dengan filter Anda.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                    <th>Jenis Entitas</th>
                                    <th>ID Entitas</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($log_aktifitas as $log): ?>
                                    <tr>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d/m/Y H:i:s', strtotime($log['dibuat_pada'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php
                                            $aksi = $log['aksi'] ?? 'unknown';
                                            $badgeClass = match ($aksi) {
                                                'create' => 'bg-success',
                                                'update' => 'bg-info',
                                                'delete' => 'bg-danger',
                                                'view' => 'bg-secondary',
                                                default => 'bg-secondary'
                                            };
                                            $aksiLabel = match ($aksi) {
                                                'create' => 'Buat',
                                                'update' => 'Ubah',
                                                'delete' => 'Hapus',
                                                'view' => 'Lihat',
                                                default => 'Tidak Diketahui'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= $aksiLabel ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong><?= esc($log['jenis_entitas']) ?></strong>
                                        </td>
                                        <td>
                                            <code><?= $log['id_entitas'] ?></code>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= ucfirst($aksi) ?> <?= strtolower($log['jenis_entitas']) ?> #<?= $log['id_entitas'] ?>
                                            </small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if (isset($pager)): ?>
                    <div class="row mt-4">
                        <div class="col-12">
                            <?= $pager->links() ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>