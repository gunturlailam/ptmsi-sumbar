<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> Detail Pendaftaran Klub
                    </h3>
                    <div class="card-tools">
                        <a href="<?= base_url('admin/pendaftaran/klub') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><?= esc($klub['nama']) ?></h4>
                            <span class="badge bg-<?= getStatusColor($klub['status']) ?> mb-3">
                                <?= ucfirst(esc($klub['status'])) ?>
                            </span>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h6><strong>Informasi Klub</strong></h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%">Nama Klub</td>
                                            <td>: <?= esc($klub['nama']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>: <?= esc($klub['alamat']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Organisasi</td>
                                            <td>: <?= esc($klub['nama_organisasi'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Berdiri</td>
                                            <td>: <?= date('d F Y', strtotime($klub['tanggal_berdiri'])) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6><strong>Penanggung Jawab</strong></h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%">Nama</td>
                                            <td>: <?= esc($klub['penanggung_jawab']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td>: <?= esc($klub['telepon']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>: <span class="badge bg-<?= getStatusColor($klub['status']) ?>"><?= ucfirst(esc($klub['status'])) ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <?php if ($klub['status'] === 'pending'): ?>
                                <div class="mt-4">
                                    <h6><strong>Aksi Verifikasi</strong></h6>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-success"
                                            onclick="verifikasiKlub(<?= $klub['id_klub'] ?>, 'aktif')">
                                            <i class="fas fa-check"></i> Verifikasi & Aktifkan
                                        </button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="verifikasiKlub(<?= $klub['id_klub'] ?>, 'ditolak')">
                                            <i class="fas fa-times"></i> Tolak Pendaftaran
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi Tambahan</h6>
                                </div>
                                <div class="card-body">
                                    <small>
                                        <strong>ID Klub:</strong><br>
                                        <?= esc($klub['id_klub']) ?><br><br>

                                        <strong>Status Saat Ini:</strong><br>
                                        <span class="badge bg-<?= getStatusColor($klub['status']) ?>">
                                            <?= ucfirst(esc($klub['status'])) ?>
                                        </span><br><br>

                                        <?php if ($klub['status'] === 'pending'): ?>
                                            <div class="alert alert-warning alert-sm">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Klub ini menunggu verifikasi admin
                                            </div>
                                        <?php elseif ($klub['status'] === 'aktif'): ?>
                                            <div class="alert alert-success alert-sm">
                                                <i class="fas fa-check-circle"></i>
                                                Klub sudah aktif dan terverifikasi
                                            </div>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
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