<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pendaftaran /</span> Pelatih/Wasit
    </h4>

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

    <!-- Filter & Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?= base_url('admin/pendaftaran/pelatih') ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <input type="text" class="form-control" name="search"
                            value="<?= esc($search ?? '') ?>"
                            placeholder="Nama, email, atau klub...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="menunggu_verifikasi_provinsi" <?= ($status ?? '') === 'menunggu_verifikasi_provinsi' ? 'selected' : '' ?>>
                                Menunggu Verifikasi
                            </option>
                            <option value="diterima" <?= ($status ?? '') === 'diterima' ? 'selected' : '' ?>>
                                Diterima
                            </option>
                            <option value="ditolak" <?= ($status ?? '') === 'ditolak' ? 'selected' : '' ?>>
                                Ditolak
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis</label>
                        <select class="form-select" name="jenis">
                            <option value="">Semua Jenis</option>
                            <option value="pelatih" <?= ($jenis ?? '') === 'pelatih' ? 'selected' : '' ?>>
                                Pelatih
                            </option>
                            <option value="wasit" <?= ($jenis ?? '') === 'wasit' ? 'selected' : '' ?>>
                                Wasit
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-search"></i>
                            </button>
                            <a href="<?= base_url('admin/pendaftaran/pelatih') ?>" class="btn btn-outline-secondary">
                                <i class="bx bx-refresh"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-time-five text-warning"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Menunggu Verifikasi</span>
                    <h3 class="card-title mb-2">
                        <?= count(array_filter($pendaftaran, fn($p) => $p['status'] === 'menunggu_verifikasi_provinsi')) ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-check-circle text-success"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Diterima</span>
                    <h3 class="card-title mb-2">
                        <?= count(array_filter($pendaftaran, fn($p) => $p['status'] === 'diterima')) ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user-check text-info"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Pelatih</span>
                    <h3 class="card-title mb-2">
                        <?= count(array_filter($pendaftaran, fn($p) => $p['jenis_pelatih'] === 'pelatih')) ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user-voice text-primary"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Wasit</span>
                    <h3 class="card-title mb-2">
                        <?= count(array_filter($pendaftaran, fn($p) => $p['jenis_pelatih'] === 'wasit')) ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pendaftaran Pelatih/Wasit</h5>
            <div class="d-flex gap-2">
                <a href="<?= base_url('admin/pendaftaran/pelatih/pending') ?>" class="btn btn-warning btn-sm">
                    <i class="bx bx-time"></i> Pending
                </a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis</th>
                        <th>Klub</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftaran)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bx bx-search-alt-2 bx-lg text-muted mb-2"></i>
                                    <span class="text-muted">Tidak ada data pendaftaran</span>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendaftaran as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <?php if (!empty($item['foto_path']) && file_exists($item['foto_path'])): ?>
                                                <img src="<?= base_url($item['foto_path']) ?>" alt="Foto" class="rounded-circle">
                                            <?php else: ?>
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    <?= strtoupper(substr($item['nama_lengkap'], 0, 1)) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <strong><?= esc($item['nama_lengkap']) ?></strong><br>
                                            <small class="text-muted"><?= esc($item['nik']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-label-<?= $item['jenis_pelatih'] === 'pelatih' ? 'primary' : 'info' ?>">
                                        <?= ucfirst($item['jenis_pelatih']) ?>
                                    </span>
                                </td>
                                <td><?= esc($item['nama_klub'] ?? '-') ?></td>
                                <td><?= esc($item['email']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($item['tanggal_daftar'])) ?></td>
                                <td>
                                    <?php
                                    $statusClass = [
                                        'menunggu_verifikasi_provinsi' => 'warning',
                                        'diterima' => 'success',
                                        'ditolak' => 'danger'
                                    ];
                                    $statusText = [
                                        'menunggu_verifikasi_provinsi' => 'Menunggu Verifikasi',
                                        'diterima' => 'Diterima',
                                        'ditolak' => 'Ditolak'
                                    ];
                                    ?>
                                    <span class="badge bg-label-<?= $statusClass[$item['status']] ?? 'secondary' ?>">
                                        <?= $statusText[$item['status']] ?? $item['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/pendaftaran/pelatih/detail/' . $item['id_pendaftaran_pelatih']) ?>">
                                                <i class="bx bx-show me-1"></i> Detail
                                            </a>
                                            <?php if ($item['status'] === 'menunggu_verifikasi_provinsi'): ?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-success" href="#"
                                                    onclick="showVerificationModal(<?= $item['id_pendaftaran_pelatih'] ?>, 'diterima')">
                                                    <i class="bx bx-check me-1"></i> Terima
                                                </a>
                                                <a class="dropdown-item text-danger" href="#"
                                                    onclick="showVerificationModal(<?= $item['id_pendaftaran_pelatih'] ?>, 'ditolak')">
                                                    <i class="bx bx-x me-1"></i> Tolak
                                                </a>
                                            <?php endif; ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#"
                                                onclick="confirmDelete(<?= $item['id_pendaftaran_pelatih'] ?>)">
                                                <i class="bx bx-trash me-1"></i> Hapus
                                            </a>
                                        </div>
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

<!-- Verification Modal -->
<div class="modal fade" id="verificationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalTitle">Verifikasi Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="verificationForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="status" id="verificationStatus">
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"
                            placeholder="Berikan catatan untuk keputusan ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="verificationSubmitBtn">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showVerificationModal(id, status) {
        const modal = new bootstrap.Modal(document.getElementById('verificationModal'));
        const form = document.getElementById('verificationForm');
        const title = document.getElementById('verificationModalTitle');
        const submitBtn = document.getElementById('verificationSubmitBtn');
        const statusInput = document.getElementById('verificationStatus');

        form.action = `<?= base_url('admin/pendaftaran/pelatih/verifikasi/') ?>${id}`;
        statusInput.value = status;

        if (status === 'diterima') {
            title.textContent = 'Terima Pendaftaran';
            submitBtn.textContent = 'Terima';
            submitBtn.className = 'btn btn-success';
        } else {
            title.textContent = 'Tolak Pendaftaran';
            submitBtn.textContent = 'Tolak';
            submitBtn.className = 'btn btn-danger';
        }

        modal.show();
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data pendaftaran ini?')) {
            window.location.href = `<?= base_url('admin/pendaftaran/pelatih/delete/') ?>${id}`;
        }
    }
</script>

<?= $this->endSection() ?>