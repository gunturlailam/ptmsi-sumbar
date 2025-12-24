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
                                <i class='bx bx-file me-2'></i>Laporan Kegiatan Klub
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola dan lihat laporan kegiatan klub Anda
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

    <!-- Statistik Laporan -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Total Laporan</p>
                            <h3 class="text-primary mb-0"><?= count($laporan) ?></h3>
                        </div>
                        <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-file'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Laporan Selesai</p>
                            <h3 class="text-success mb-0">
                                <?php
                                $selesai = 0;
                                foreach ($laporan as $l) {
                                    if (($l['status'] ?? 'draft') === 'selesai') $selesai++;
                                }
                                echo $selesai;
                                ?>
                            </h3>
                        </div>
                        <div class="text-success" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-check-circle'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Laporan Draft</p>
                            <h3 class="text-warning mb-0">
                                <?php
                                $draft = 0;
                                foreach ($laporan as $l) {
                                    if (($l['status'] ?? 'draft') === 'draft') $draft++;
                                }
                                echo $draft;
                                ?>
                            </h3>
                        </div>
                        <div class="text-warning" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-edit'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Laporan -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($laporan)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-1 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada laporan kegiatan</h5>
                        <p class="text-muted mb-4">Mulai buat laporan kegiatan klub Anda untuk melacak semua aktivitas.</p>
                        <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-primary">
                            <i class='bx bx-plus me-2'></i>Buat Laporan
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Judul Kegiatan</th>
                                    <th>Jenis</th>
                                    <th>Peserta</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($laporan as $item): ?>
                                    <tr>
                                        <td>
                                            <strong><?= date('d/m/Y', strtotime($item['tanggal_laporan'] ?? date('Y-m-d'))) ?></strong>
                                        </td>
                                        <td>
                                            <?= esc($item['judul_kegiatan'] ?? 'Tanpa Judul') ?>
                                        </td>
                                        <td>
                                            <?php
                                            $jenis = $item['jenis_kegiatan'] ?? 'lainnya';
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
                                            <small><?= $item['jumlah_peserta'] ?? 0 ?> orang</small>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $item['status'] ?? 'draft';
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
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" title="Lihat Detail">
                                                    <i class='bx bx-show'></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary" title="Edit">
                                                    <i class='bx bx-edit'></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger" title="Hapus">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>