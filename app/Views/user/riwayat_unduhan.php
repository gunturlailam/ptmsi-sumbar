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
                                <i class='bx bx-download me-2'></i>Riwayat Unduhan
                            </h3>
                            <p class="text-muted mb-0">
                                Dokumen yang telah Anda unduh
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
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori Dokumen</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">Semua Kategori</option>
                                <option value="peraturan" <?= ($kategori ?? '') === 'peraturan' ? 'selected' : '' ?>>Peraturan</option>
                                <option value="formulir" <?= ($kategori ?? '') === 'formulir' ? 'selected' : '' ?>>Formulir</option>
                                <option value="panduan" <?= ($kategori ?? '') === 'panduan' ? 'selected' : '' ?>>Panduan</option>
                                <option value="laporan" <?= ($kategori ?? '') === 'laporan' ? 'selected' : '' ?>>Laporan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal Unduhan</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal ?? '' ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-search me-2'></i>Filter
                            </button>
                            <a href="<?= base_url('user/riwayat-unduhan') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-reset me-2'></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Unduhan -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($riwayat_unduhan)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-1 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada riwayat unduhan</h5>
                        <p class="text-muted mb-4">Anda belum mengunduh dokumen apapun.</p>
                        <a href="<?= base_url('dokumen') ?>" class="btn btn-primary">
                            <i class='bx bx-download me-2'></i>Lihat Dokumen
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Unduhan</th>
                                    <th>Ukuran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($riwayat_unduhan as $unduhan): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($unduhan['judul_dokumen']) ?></strong>
                                        </td>
                                        <td>
                                            <?php
                                            $kategori = $unduhan['kategori'] ?? 'lainnya';
                                            $badgeClass = match ($kategori) {
                                                'peraturan' => 'bg-primary',
                                                'formulir' => 'bg-success',
                                                'panduan' => 'bg-info',
                                                'laporan' => 'bg-warning',
                                                default => 'bg-secondary'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= ucfirst($kategori) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d/m/Y H:i', strtotime($unduhan['diunduh_pada'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <small><?= $unduhan['ukuran'] ?? '-' ?></small>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('dokumen/download/' . $unduhan['id_dokumen']) ?>" class="btn btn-sm btn-outline-primary" title="Unduh Ulang">
                                                <i class='bx bx-download'></i>
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