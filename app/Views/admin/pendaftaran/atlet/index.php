<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-user-plus"></i> Pendaftaran Atlet
                    </h3>
                    <a href="<?= base_url('admin/pendaftaran/atlet/pending') ?>" class="btn btn-warning">
                        <i class="fas fa-clock"></i> Menunggu Verifikasi
                    </a>
                </div>
                <div class="card-body">
                    <!-- Filter & Search -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="<?= base_url('admin/pendaftaran/atlet') ?>" class="d-flex">
                                <input type="text" name="search" class="form-control me-2"
                                    placeholder="Cari atlet..." value="<?= esc($search ?? '') ?>">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="GET" action="<?= base_url('admin/pendaftaran/atlet') ?>">
                                <?php if (!empty($search)): ?>
                                    <input type="hidden" name="search" value="<?= esc($search) ?>">
                                <?php endif; ?>
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="pending" <?= ($status ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="verified" <?= ($status ?? '') == 'verified' ? 'selected' : '' ?>>Terverifikasi</option>
                                    <option value="rejected" <?= ($status ?? '') == 'rejected' ? 'selected' : '' ?>>Ditolak</option>
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
                                    <th width="20%">Nama Lengkap</th>
                                    <th width="15%">Email</th>
                                    <th width="10%">No. HP</th>
                                    <th width="15%">Klub</th>
                                    <th width="10%">Tanggal Daftar</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pendaftaran)): ?>
                                    <?php foreach ($pendaftaran as $index => $p): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong><?= esc($p['nama_lengkap']) ?></strong>
                                                <br><small class="text-muted"><?= esc($p['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?></small>
                                            </td>
                                            <td><?= esc($p['email']) ?></td>
                                            <td><?= esc($p['no_hp']) ?></td>
                                            <td><?= esc($p['nama_klub'] ?? 'Belum memilih') ?></td>
                                            <td><?= date('d/m/Y', strtotime($p['tanggal_daftar'])) ?></td>
                                            <td>
                                                <span class="badge bg-<?= getStatusColor($p['status']) ?>">
                                                    <?= getStatusText($p['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/pendaftaran/atlet/detail/' . $p['id_pendaftaran']) ?>"
                                                        class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if ($p['status'] === 'pending'): ?>
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            onclick="verifikasiAtlet(<?= $p['id_pendaftaran'] ?>, 'verified')" title="Verifikasi">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="verifikasiAtlet(<?= $p['id_pendaftaran'] ?>, 'rejected')" title="Tolak">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url('admin/pendaftaran/atlet/delete/' . $p['id_pendaftaran']) ?>"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus pendaftaran ini?')"
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
                                                <i class="fas fa-user-plus fa-3x text-muted mb-3"></i>
                                                <h5>Belum ada pendaftaran atlet</h5>
                                                <p class="text-muted">Data pendaftaran akan muncul setelah ada yang mendaftar</p>
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
                <h5 class="modal-title">Verifikasi Pendaftaran Atlet</h5>
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
    function verifikasiAtlet(id, status) {
        const modal = new bootstrap.Modal(document.getElementById('verifikasiModal'));
        const form = document.getElementById('verifikasiForm');
        const statusInput = document.getElementById('verifikasiStatus');
        const text = document.getElementById('verifikasiText');
        const btn = document.getElementById('verifikasiBtn');

        form.action = '<?= base_url('admin/pendaftaran/atlet/verifikasi/') ?>' + id;
        statusInput.value = status;

        if (status === 'verified') {
            text.textContent = 'Apakah Anda yakin ingin memverifikasi pendaftaran atlet ini?';
            btn.textContent = 'Verifikasi';
            btn.className = 'btn btn-success';
        } else {
            text.textContent = 'Apakah Anda yakin ingin menolak pendaftaran atlet ini?';
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
        case 'verified':
            return 'success';
        case 'pending':
            return 'warning';
        case 'rejected':
            return 'danger';
        default:
            return 'secondary';
    }
}

function getStatusText($status)
{
    switch ($status) {
        case 'verified':
            return 'Terverifikasi';
        case 'pending':
            return 'Pending';
        case 'rejected':
            return 'Ditolak';
        default:
            return 'Unknown';
    }
}
?>
<?= $this->endSection() ?>