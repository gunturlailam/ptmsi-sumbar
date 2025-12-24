<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-clock"></i> Pendaftaran Atlet - Menunggu Verifikasi
                    </h3>
                    <div>
                        <span class="badge bg-warning text-dark me-2"><?= count($pendaftaran) ?> PENDAFTARAN</span>
                        <a href="<?= base_url('admin/pendaftaran/atlet') ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Semua Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Info Alert -->
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            <strong>Pendaftaran Menunggu Verifikasi</strong><br>
                            Berikut adalah daftar pendaftaran atlet yang menunggu verifikasi dari Admin Provinsi.
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
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Lengkap</th>
                                    <th width="10%">Kategori</th>
                                    <th width="15%">Klub</th>
                                    <th width="15%">Email</th>
                                    <th width="15%">Tanggal Daftar</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pendaftaran)): ?>
                                    <?php foreach ($pendaftaran as $index => $p): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong><?= esc($p['nama_lengkap']) ?></strong>
                                                <br><small class="text-muted">NIK: <?= esc($p['nik'] ?? '-') ?></small>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?= esc($p['kategori_usia'] ?? '-') ?></span>
                                            </td>
                                            <td><?= esc($p['nama_klub'] ?? '-') ?></td>
                                            <td><?= esc($p['email']) ?></td>
                                            <td>
                                                <?= isset($p['tanggal_daftar']) ? date('d/m/Y H:i', strtotime($p['tanggal_daftar'])) : '-' ?>
                                                <br><small class="text-muted"><?= isset($p['tanggal_daftar']) ? time_elapsed_string($p['tanggal_daftar']) : '' ?></small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/pendaftaran/atlet/detail/' . $p['id_pendaftaran_atlet']) ?>"
                                                        class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        onclick="verifikasiAtlet(<?= $p['id_pendaftaran_atlet'] ?>, 'diterima')" title="Terima">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="verifikasiAtlet(<?= $p['id_pendaftaran_atlet'] ?>, 'ditolak')" title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                                <h5>Tidak ada pendaftaran yang menunggu verifikasi</h5>
                                                <p class="text-muted">Semua pendaftaran sudah diproses</p>
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
                        <textarea class="form-control" name="catatan" id="catatan" rows="3" placeholder="Masukkan catatan jika diperlukan..."></textarea>
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

        if (status === 'diterima') {
            text.textContent = 'Apakah Anda yakin ingin MENERIMA pendaftaran atlet ini? Akun user dan profil atlet akan dibuat secara otomatis.';
            btn.textContent = 'Terima';
            btn.className = 'btn btn-success';
        } else {
            text.textContent = 'Apakah Anda yakin ingin MENOLAK pendaftaran atlet ini?';
            btn.textContent = 'Tolak';
            btn.className = 'btn btn-danger';
        }

        modal.show();
    }
</script>

<?php
function time_elapsed_string($datetime)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    if ($diff->d == 0) {
        if ($diff->h == 0) {
            return $diff->i . ' menit yang lalu';
        }
        return $diff->h . ' jam yang lalu';
    } elseif ($diff->d == 1) {
        return 'Kemarin';
    } elseif ($diff->d < 7) {
        return $diff->d . ' hari yang lalu';
    } else {
        return date('d M Y', strtotime($datetime));
    }
}
?>
<?= $this->endSection() ?>