<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-xxl -grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pendaftaran / Pelatih/Wasit /</span> Menunggu Verifikasi
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

    <!-- Info Alert -->
    <div class="alert alert-info d-flex" role="alert">
        <span class="badge badge-center rounded-pill bg-info border-label-info p-3 me-2">
            <i class="bx bx-time fs-6"></i>
        </span>
        <div>
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Pendaftaran Menunggu Verifikasi</h6>
            <p class="mb-0">Berikut adalah daftar pendaftaran pelatih/wasit yang menunggu verifikasi dari Admin Provinsi.</p>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pendaftaran Pending</h5>
            <div class="d-flex gap-2">
                <span class="badge bg-warning fs-6"><?= count($pendaftaran) ?> Pendaftaran</span>
                <a href="<?= base_url('admin/pendaftaran/pelatih') ?>" class="btn btn-secondary btn-sm">
                    <i class="bx bx-arrow-back"></i> Semua Data
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftaran)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bx bx-check-circle bx-lg text-success mb-2"></i>
                                    <span class="text-muted">Tidak ada pendaftaran yang menunggu verifikasi</span>
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
                                <td>
                                    <?= esc($item['email']) ?>
                                    <?php if (function_exists('is_email_registered') ? is_email_registered($item['email']) : false): ?>
                                        <span class="badge bg-danger ms-1">Sudah terdaftar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y H:i', strtotime($item['tanggal_daftar'])) ?>
                                    <br>
                                    <small class="text-muted">
                                        <?php
                                        $diff = time() - strtotime($item['tanggal_daftar']);
                                        $days = floor($diff / (60 * 60 * 24));
                                        if ($days > 0) {
                                            echo $days . ' hari yang lalu';
                                        } else {
                                            $hours = floor($diff / (60 * 60));
                                            echo $hours > 0 ? $hours . ' jam yang lalu' : 'Baru saja';
                                        }
                                        ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?= base_url('admin/pendaftaran/pelatih/detail/' . $item['id_pendaftaran_pelatih']) ?>"
                                            class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <?php if (function_exists('is_email_registered') ? is_email_registered($item['email']) : false): ?>
                                            <button type="button" class="btn btn-sm btn-success" title="Terima" disabled>
                                                <i class="bx bx-check"></i>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-success" title="Terima"
                                                onclick="showVerificationModal(<?= $item['id_pendaftaran_pelatih'] ?>, 'diterima')">
                                                <i class="bx bx-check"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-sm btn-danger" title="Tolak"
                                            onclick="showVerificationModal(<?= $item['id_pendaftaran_pelatih'] ?>, 'ditolak')">
                                            <i class="bx bx-x"></i>
                                        </button>
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
</script>

<?= $this->endSection() ?>