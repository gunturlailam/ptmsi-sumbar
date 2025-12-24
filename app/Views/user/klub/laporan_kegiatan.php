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
                                <i class='bx bx-file me-2'></i>Laporan Kegiatan
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola laporan kegiatan klub Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-outline-secondary">
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
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">Semua Bulan</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= $i ?>" <?= ($bulan ?? '') == $i ? 'selected' : '' ?>>
                                        <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <option value="">Semua Tahun</option>
                                <?php for ($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                    <option value="<?= $i ?>" <?= ($tahun ?? '') == $i ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jenis" class="form-label">Jenis Kegiatan</label>
                            <select class="form-select" id="jenis" name="jenis">
                                <option value="">Semua Jenis</option>
                                <option value="latihan" <?= ($jenis ?? '') === 'latihan' ? 'selected' : '' ?>>Latihan</option>
                                <option value="pertandingan" <?= ($jenis ?? '') === 'pertandingan' ? 'selected' : '' ?>>Pertandingan</option>
                                <option value="seminar" <?= ($jenis ?? '') === 'seminar' ? 'selected' : '' ?>>Seminar</option>
                                <option value="lainnya" <?= ($jenis ?? '') === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-search me-2'></i>Filter
                            </button>
                            <a href="<?= base_url('user/klub/laporan-kegiatan') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-reset me-2'></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Laporan -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($laporan_kegiatan)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-1 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada laporan kegiatan</h5>
                        <p class="text-muted mb-4">Tidak ada laporan kegiatan yang sesuai dengan filter Anda.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Kegiatan</th>
                                    <th>Deskripsi</th>
                                    <th>Peserta</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($laporan_kegiatan as $laporan): ?>
                                    <tr>
                                        <td>
                                            <strong><?= date('d/m/Y', strtotime($laporan['tanggal_kegiatan'])) ?></strong>
                                        </td>
                                        <td>
                                            <?php
                                            $jenis = $laporan['jenis_kegiatan'] ?? 'lainnya';
                                            $badgeClass = match ($jenis) {
                                                'latihan' => 'bg-primary',
                                                'pertandingan' => 'bg-success',
                                                'seminar' => 'bg-info',
                                                'lainnya' => 'bg-secondary',
                                                default => 'bg-secondary'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= ucfirst($jenis) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small><?= substr(esc($laporan['deskripsi'] ?? ''), 0, 50) ?>...</small>
                                        </td>
                                        <td>
                                            <small><?= $laporan['jumlah_peserta'] ?? 0 ?> orang</small>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $laporan['status'] ?? 'draft';
                                            $statusBadge = match ($status) {
                                                'selesai' => 'bg-success',
                                                'draft' => 'bg-warning',
                                                'pending' => 'bg-secondary',
                                                default => 'bg-secondary'
                                            };
                                            $statusLabel = match ($status) {
                                                'selesai' => 'Selesai',
                                                'draft' => 'Draft',
                                                'pending' => 'Menunggu',
                                                default => 'Tidak Diketahui'
                                            };
                                            ?>
                                            <span class="badge <?= $statusBadge ?>">
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('user/klub/detail-laporan/' . $laporan['id_laporan']) ?>" class="btn btn-sm btn-outline-primary">
                                                <i class='bx bx-show'></i>
                                            </a>
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