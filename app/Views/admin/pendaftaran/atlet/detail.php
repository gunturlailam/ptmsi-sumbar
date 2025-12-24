<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i> Detail Pendaftaran Atlet
                    </h3>
                    <a href="<?= base_url('admin/pendaftaran/atlet') ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="border-bottom pb-2 mb-3">Data Pribadi</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>Nama Lengkap</strong></td>
                                    <td><?= esc($pendaftaran['nama_lengkap']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>NIK</strong></td>
                                    <td><?= esc($pendaftaran['nik'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat, Tanggal Lahir</strong></td>
                                    <td><?= esc($pendaftaran['tempat_lahir'] ?? '-') ?>, <?= isset($pendaftaran['tanggal_lahir']) ? date('d F Y', strtotime($pendaftaran['tanggal_lahir'])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td><?= ($pendaftaran['jenis_kelamin'] ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td><?= esc($pendaftaran['alamat'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>No. HP</strong></td>
                                    <td><?= esc($pendaftaran['no_hp'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><?= esc($pendaftaran['email']) ?></td>
                                </tr>
                            </table>

                            <h5 class="border-bottom pb-2 mb-3 mt-4">Data Atlet</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>Kategori Usia</strong></td>
                                    <td><span class="badge bg-primary"><?= esc($pendaftaran['kategori_usia'] ?? '-') ?></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Klub</strong></td>
                                    <td><?= esc($pendaftaran['nama_klub'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Daftar</strong></td>
                                    <td><?= isset($pendaftaran['tanggal_daftar']) ? date('d F Y H:i', strtotime($pendaftaran['tanggal_daftar'])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        <?php
                                        $statusClass = 'secondary';
                                        $statusText = $pendaftaran['status'] ?? 'Unknown';
                                        if ($pendaftaran['status'] == 'diterima') {
                                            $statusClass = 'success';
                                            $statusText = 'Diterima';
                                        } elseif (strpos($pendaftaran['status'], 'menunggu') !== false) {
                                            $statusClass = 'warning';
                                            $statusText = 'Menunggu Verifikasi';
                                        } elseif (strpos($pendaftaran['status'], 'ditolak') !== false) {
                                            $statusClass = 'danger';
                                            $statusText = 'Ditolak';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $statusClass ?>"><?= $statusText ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <h5 class="border-bottom pb-2 mb-3">Foto</h5>
                            <?php if (!empty($pendaftaran['foto_path'])): ?>
                                <img src="<?= base_url('uploads/pendaftaran_atlet/' . $pendaftaran['foto_path']) ?>"
                                    class="img-fluid rounded" alt="Foto Atlet" style="max-height: 300px;">
                            <?php else: ?>
                                <div class="text-center py-5 bg-light rounded">
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                    <p class="text-muted mt-2">Tidak ada foto</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (strpos($pendaftaran['status'], 'menunggu') !== false): ?>
                        <hr>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success" onclick="verifikasiAtlet(<?= $pendaftaran['id_pendaftaran_atlet'] ?>, 'diterima')">
                                <i class="fas fa-check"></i> Terima Pendaftaran
                            </button>
                            <button type="button" class="btn btn-danger" onclick="verifikasiAtlet(<?= $pendaftaran['id_pendaftaran_atlet'] ?>, 'ditolak')">
                                <i class="fas fa-times"></i> Tolak Pendaftaran
                            </button>
                        </div>
                    <?php endif; ?>
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
                <h5 class="modal-title">Verifikasi Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="verifikasiForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="status" id="verifikasiStatus">
                    <p id="verifikasiText"></p>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
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

        if (status === 'diterima') {
            text.textContent = 'Apakah Anda yakin ingin MENERIMA pendaftaran ini?';
            btn.textContent = 'Terima';
            btn.className = 'btn btn-success';
        } else {
            text.textContent = 'Apakah Anda yakin ingin MENOLAK pendaftaran ini?';
            btn.textContent = 'Tolak';
            btn.className = 'btn btn-danger';
        }

        modal.show();
    }
</script>
<?= $this->endSection() ?>