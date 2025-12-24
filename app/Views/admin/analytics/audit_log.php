<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-2">
                                <i class='bx bx-history me-2'></i>Audit Log
                            </h3>
                            <p class="text-muted mb-0">Riwayat lengkap semua aktivitas sistem</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('admin/analytics/export-audit-log') ?>" class="btn btn-primary">
                                <i class='bx bx-download me-2'></i>Export CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Modul</label>
                            <select name="modul" class="form-select">
                                <option value="">Semua Modul</option>
                                <option value="ATLET" <?= $modul === 'ATLET' ? 'selected' : '' ?>>Atlet</option>
                                <option value="PELATIH" <?= $modul === 'PELATIH' ? 'selected' : '' ?>>Pelatih</option>
                                <option value="KLUB" <?= $modul === 'KLUB' ? 'selected' : '' ?>>Klub</option>
                                <option value="EVENT" <?= $modul === 'EVENT' ? 'selected' : '' ?>>Event</option>
                                <option value="BERITA" <?= $modul === 'BERITA' ? 'selected' : '' ?>>Berita</option>
                                <option value="SYSTEM" <?= $modul === 'SYSTEM' ? 'selected' : '' ?>>System</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Aksi</label>
                            <select name="aksi" class="form-select">
                                <option value="">Semua Aksi</option>
                                <option value="CREATE" <?= $aksi === 'CREATE' ? 'selected' : '' ?>>Create</option>
                                <option value="UPDATE" <?= $aksi === 'UPDATE' ? 'selected' : '' ?>>Update</option>
                                <option value="DELETE" <?= $aksi === 'DELETE' ? 'selected' : '' ?>>Delete</option>
                                <option value="VIEW" <?= $aksi === 'VIEW' ? 'selected' : '' ?>>View</option>
                                <option value="APPROVE" <?= $aksi === 'APPROVE' ? 'selected' : '' ?>>Approve</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="sukses" <?= $status === 'sukses' ? 'selected' : '' ?>>Sukses</option>
                                <option value="gagal" <?= $status === 'gagal' ? 'selected' : '' ?>>Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class='bx bx-search me-2'></i>Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Audit Log Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <?php if (empty($logs)): ?>
                        <div class="p-4 text-center text-muted">
                            <i class='bx bx-inbox display-4 mb-3'></i>
                            <p>Tidak ada audit log</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Aksi</th>
                                        <th>Modul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $log): ?>
                                        <tr>
                                            <td>
                                                <small><?= date('d/m/Y H:i:s', strtotime($log['dibuat_pada'])) ?></small>
                                            </td>
                                            <td><?= esc($log['nama_lengkap'] ?? 'System') ?></td>
                                            <td>
                                                <span class="badge bg-info"><?= esc($log['aksi']) ?></span>
                                            </td>
                                            <td><?= esc($log['modul']) ?></td>
                                            <td>
                                                <small><?= esc(substr($log['deskripsi'] ?? '', 0, 50)) ?></small>
                                            </td>
                                            <td>
                                                <?php if ($log['status'] === 'sukses'): ?>
                                                    <span class="badge bg-success">Sukses</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Gagal</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small><?= esc($log['ip_address']) ?></small>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="p-4 border-top">
                            <nav>
                                <ul class="pagination mb-0">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=1&modul=<?= $modul ?>&aksi=<?= $aksi ?>&status=<?= $status ?>">First</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>&modul=<?= $modul ?>&aksi=<?= $aksi ?>&status=<?= $status ?>">Previous</a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="page-item active">
                                        <span class="page-link"><?= $page ?></span>
                                    </li>

                                    <?php if (($page * $limit) < $total): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>&modul=<?= $modul ?>&aksi=<?= $aksi ?>&status=<?= $status ?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>