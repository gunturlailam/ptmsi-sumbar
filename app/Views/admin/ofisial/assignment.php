<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-2">
                        <i class='bx bx-link me-2'></i>Penugasan Ofisial ke Turnamen
                    </h3>
                    <p class="text-muted mb-0">Kelola penugasan ofisial untuk setiap turnamen</p>
                </div>
                <a href="<?= base_url('admin/ofisial/assign-event') ?>" class="btn btn-primary">
                    <i class='bx bx-plus me-2'></i>Tambah Penugasan
                </a>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class='bx bx-x-circle me-2'></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Ofisial</th>
                        <th>Nomor Lisensi</th>
                        <th>Turnamen</th>
                        <th>Tanggal</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($assignments)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class='bx bx-inbox fs-1 d-block mb-2'></i>
                                Belum ada penugasan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1;
                        foreach ($assignments as $assignment): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= $assignment['nama_lengkap'] ?></strong>
                                    <br>
                                    <small class="text-muted"><?= $assignment['email'] ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?= $assignment['nomor_lisensi'] ?></span>
                                </td>
                                <td><?= $assignment['nama_event'] ?></td>
                                <td>
                                    <small>
                                        <?= date('d/m/Y', strtotime($assignment['tanggal_mulai'])) ?> -
                                        <?= date('d/m/Y', strtotime($assignment['tanggal_selesai'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <?php
                                    $roleColors = [
                                        'wasit' => 'primary',
                                        'juri' => 'success',
                                        'pencatat' => 'warning',
                                        'verifikator' => 'danger'
                                    ];
                                    $color = $roleColors[$assignment['role_assignment']] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?= $color ?>"><?= ucfirst($assignment['role_assignment']) ?></span>
                                </td>
                                <td>
                                    <?php if ($assignment['status'] === 'aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/ofisial/delete-assignment/' . $assignment['id_assignment']) ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin ingin menghapus penugasan ini?')"
                                        title="Hapus">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>