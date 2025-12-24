<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-2">
                        <i class='bx bx-shield-check me-2'></i>Kelola Ofisial
                    </h3>
                    <p class="text-muted mb-0">Manajemen data ofisial PTMSI Sumatera Barat</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/ofisial/create') ?>" class="btn btn-primary">
                        <i class='bx bx-plus me-2'></i>Tambah Ofisial
                    </a>
                    <a href="<?= base_url('admin/ofisial/assignment') ?>" class="btn btn-info">
                        <i class='bx bx-link me-2'></i>Penugasan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-gradient rounded-3 p-3">
                                <i class='bx bx-user-check text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Total Ofisial</p>
                            <h5 class="mb-0"><?= $total ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-gradient rounded-3 p-3">
                                <i class='bx bx-check-circle text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Aktif</p>
                            <h5 class="mb-0"><?= $aktif ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-gradient rounded-3 p-3">
                                <i class='bx bx-x-circle text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1">Nonaktif</p>
                            <h5 class="mb-0"><?= $nonaktif ?></h5>
                        </div>
                    </div>
                </div>
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
                        <th>Nama Lengkap</th>
                        <th>Nomor Lisensi</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($ofisials)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class='bx bx-inbox fs-1 d-block mb-2'></i>
                                Belum ada data ofisial
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1;
                        foreach ($ofisials as $ofisial): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= $ofisial['nama_lengkap'] ?></strong>
                                    <br>
                                    <small class="text-muted">@<?= $ofisial['username'] ?? '-' ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?= $ofisial['nomor_lisensi'] ?></span>
                                </td>
                                <td><?= $ofisial['email'] ?></td>
                                <td><?= $ofisial['nohp'] ?></td>
                                <td>
                                    <?php if ($ofisial['status'] === 'aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('admin/ofisial/edit/' . $ofisial['id_ofisial']) ?>" class="btn btn-outline-primary" title="Edit">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <a href="<?= base_url('admin/ofisial/delete/' . $ofisial['id_ofisial']) ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    </div>
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