<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> Pendaftaran Klub
                    </h3>
                    <a href="<?= base_url('admin/pendaftaran/klub/pending') ?>" class="btn btn-warning">
                        <i class="fas fa-clock"></i> Menunggu Verifikasi
                    </a>
                </div>
                <div class="card-body">
                    <!-- Filter & Search -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form method="GET" action="<?= base_url('admin/pendaftaran/klub') ?>" class="d-flex">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Cari klub..." value="<?= esc($search ?? '') ?>">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="<?= base_url('admin/pendaftaran/klub') ?>">
                                <?php if (!empty($search)): ?>
                                    <input type="hidden" name="search" value="<?= esc($search) ?>">
                                <?php endif; ?>
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="pending" <?= ($status ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="aktif" <?= ($status ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="nonaktif" <?= ($status ?? '') == 'nonaktif' ? 'selected' : '' ?>>Non-aktif</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="<?= base_url('admin/pendaftaran/klub') ?>">
                                <?php if (!empty($search)): ?>
                                    <input type="hidden" name="search" value="<?= esc($search) ?>">
                                <?php endif; ?>
                                <?php if (!empty($status)): ?>
                                    <input type="hidden" name="status" value="<?= esc($status) ?>">
                                <?php endif; ?>
                                <select name="organisasi" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Organisasi</option>
                                    <?php foreach ($allOrganisasi as $org): ?>
                                        <option value="<?= $org['id_organisasi'] ?>" <?= ($organisasi ?? '') == $org['id_organisasi'] ? 'selected' : '' ?>>
                                            <?= esc($org['nama_organisasi']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </div>
                    </div>

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

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Klub</th>
                                    <th width="15%">Organisasi</th>
                                    <th width="15%">Penanggung Jawab</th>
                                    <th width="10%">Telepon</th>
                                    <th width="10%">Tanggal Berdiri</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($klub)): ?>
                                    <?php foreach ($klub as $index => $k): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong><?= esc($k['nama']) ?></strong>
                                                <br><small class="text-muted"><?= esc($k['alamat']) ?></small>
                                            </td>
                                            <td><?= esc($k['nama_organisasi'] ?? '-') ?></td>
                                            <td><?= esc($k['penanggung_jawab']) ?></td>
                                            <td><?= esc($k['telepon']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($k['tanggal_berdiri'])) ?></td>
                                            <td>
                                                <span class="badge bg-<?= getStatusColor($k['status']) ?>">
                                                    <?= ucfirst(esc($k['status'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/pendaftaran/klub/detail/' . $k['id_klub']) ?>"
                                                        class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if ($k['status'] === 'pending'): ?>
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            onclick="verifikasiKlub(<?= $k['id_klub'] ?>, 'aktif')" title="Verifikasi">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="verifikasiKlub(<?= $k['id_klub'] ?>, 'ditolak')" title="Tolak">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url('admin/pendaftaran/klub/delete/' . $k['id_klub']) ?>"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus klub ini?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                                <h5>Belum ada data klub</h5>
                                                <p class="text-muted">Data klub akan muncul setelah ada pendaftaran</p>
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

<!-- Verifikasi Modal -->
<div class="modal fade" id="verifikasiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi Klub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="verifikasiForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="status" id="verifikasiStatus">
                    <p id="verifikasiText"></p>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="verifikasiBtn">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function verifikasiKlub(id, status) {
        const modal = new bootstrap.Modal(document.getElementById('verifikasiModal'));
        const form = document.getElementById('verifikasiForm');
        const statusInput = document.getElementById('verifikasiStatus');
        const text = document.getElementById('verifikasiText');
        const btn = document.getElementById('verifikasiBtn');

        form.action = '<?= base_url('admin/pendaftaran/klub/verifikasi/') ?>' + id;
        statusInput.value = status;

        if (status === 'aktif') {
            text.textContent = 'Apakah Anda yakin ingin memverifikasi dan mengaktifkan klub ini?';
            btn.textContent = 'Verifikasi';
            btn.className = 'btn btn-success';
        } else {
            text.textContent = 'Apakah Anda yakin ingin menolak pendaftaran klub ini?';
            btn.textContent = 'Tolak';
            btn.className = 'btn btn-danger';
        }

        modal.show();
    }
</script>

<?php
function getStatusColor($status)
{
    switch ($status) {
        case 'aktif':
            return 'success';
        case 'pending':
            return 'warning';
        case 'nonaktif':
            return 'secondary';
        default:
            return 'secondary';
    }
}
?>
<?= $this->endSection() ?>