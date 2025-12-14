<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt"></i> Pendaftaran Event/Turnamen
                    </h3>
                    <div>
                        <a href="<?= base_url('admin/pendaftaran/event/menunggu-konfirmasi') ?>" class="btn btn-warning me-2">
                            <i class="fas fa-clock"></i> Menunggu Konfirmasi
                        </a>
                        <a href="<?= base_url('admin/pendaftaran/event/menunggu-verifikasi') ?>" class="btn btn-primary">
                            <i class="fas fa-check"></i> Menunggu Verifikasi
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3><?= count($events) ?></h3>
                                    <p class="mb-0">Total Event</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3><?= count(array_filter($events, fn($e) => $e['status'] === 'aktif')) ?></h3>
                                    <p class="mb-0">Event Aktif</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3>0</h3>
                                    <p class="mb-0">Menunggu Konfirmasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3>0</h3>
                                    <p class="mb-0">Menunggu Verifikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event List -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Judul Event</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="15%">Lokasi</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Pendaftar</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($events)): ?>
                                    <?php foreach ($events as $index => $event): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong><?= esc($event['judul']) ?></strong>
                                                <?php if (!empty($event['batas_pendaftaran'])): ?>
                                                    <br><small class="text-muted">
                                                        Batas: <?= date('d/m/Y', strtotime($event['batas_pendaftaran'])) ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small>
                                                    <?= date('d/m/Y', strtotime($event['tanggal_mulai'])) ?><br>
                                                    s/d <?= date('d/m/Y', strtotime($event['tanggal_selesai'])) ?>
                                                </small>
                                            </td>
                                            <td><?= esc($event['lokasi']) ?></td>
                                            <td>
                                                <span class="badge bg-<?= getStatusColor($event['status']) ?>">
                                                    <?= ucfirst(esc($event['status'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">0</span>
                                                <small class="d-block text-muted">peserta</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/pendaftaran/event/detail/' . $event['id_event']) ?>"
                                                        class="btn btn-sm btn-info" title="Lihat Pendaftar">
                                                        <i class="fas fa-users"></i>
                                                    </a>
                                                    <?php if ($event['status'] === 'aktif'): ?>
                                                        <a href="<?= base_url('admin/pendaftaran/event/bracket/' . $event['id_event']) ?>"
                                                            class="btn btn-sm btn-success" title="Bracket">
                                                            <i class="fas fa-sitemap"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url('admin/event/edit/' . $event['id_event']) ?>"
                                                        class="btn btn-sm btn-warning" title="Edit Event">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                                                <h5>Belum ada event</h5>
                                                <p class="text-muted">Event akan muncul setelah dibuat di manajemen event</p>
                                                <a href="<?= base_url('admin/event/create') ?>" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Buat Event Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
function getStatusColor($status)
{
    switch ($status) {
        case 'aktif':
            return 'success';
        case 'selesai':
            return 'secondary';
        case 'draft':
            return 'warning';
        default:
            return 'secondary';
    }
}
?>
<?= $this->endSection() ?>