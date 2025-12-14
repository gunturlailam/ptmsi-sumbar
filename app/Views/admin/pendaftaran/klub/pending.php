<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clock"></i> Pendaftaran Klub - Menunggu Verifikasi
                    </h3>
                    <div class="card-tools">
                        <a href="<?= base_url('admin/pendaftaran/klub') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($klub)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Terdapat <?= count($klub) ?> klub yang menunggu verifikasi
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-warning">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Klub</th>
                                    <th width="20%">Organisasi</th>
                                    <th width="15%">Penanggung Jawab</th>
                                    <th width="10%">Telepon</th>
                                    <th width="10%">Tanggal Daftar</th>
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
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/pendaftaran/klub/detail/' . $k['id_klub']) ?>"
                                                        class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        onclick="verifikasiKlub(<?= $k['id_klub'] ?>, 'aktif')" title="Verifikasi">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="verifikasiKlub(<?= $k['id_klub'] ?>, 'ditolak')" title="Tolak">
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
                                                <h5>Tidak ada klub yang menunggu verifikasi</h5>
                                                <p class="text-muted">Semua pendaftaran klub sudah diproses</p>
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
<?= $this->endSection() ?>