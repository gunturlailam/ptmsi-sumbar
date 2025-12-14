<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pendaftaran / Pelatih/Wasit /</span> Detail
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

    <div class="row">
        <!-- Main Info -->
        <div class="col-xl-8 col-lg-7 col-md-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Pelatih/Wasit</h5>
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
                    <span class="badge bg-label-<?= $statusClass[$pendaftaran['status']] ?? 'secondary' ?> fs-6">
                        <?= $statusText[$pendaftaran['status']] ?? $pendaftaran['status'] ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <p class="mb-0"><?= esc($pendaftaran['nama_lengkap']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NIK</label>
                            <p class="mb-0"><?= esc($pendaftaran['nik']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tempat, Tanggal Lahir</label>
                            <p class="mb-0"><?= esc($pendaftaran['tempat_lahir']) ?>, <?= date('d F Y', strtotime($pendaftaran['tanggal_lahir'])) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <p class="mb-0"><?= $pendaftaran['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis</label>
                            <p class="mb-0">
                                <span class="badge bg-label-<?= $pendaftaran['jenis_pelatih'] === 'pelatih' ? 'primary' : 'info' ?>">
                                    <?= ucfirst($pendaftaran['jenis_pelatih']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Klub</label>
                            <p class="mb-0"><?= esc($pendaftaran['nama_klub'] ?? '-') ?></p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <p class="mb-0"><?= esc($pendaftaran['alamat']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No. HP</label>
                            <p class="mb-0"><?= esc($pendaftaran['no_hp']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p class="mb-0"><?= esc($pendaftaran['email']) ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Pendaftaran</label>
                            <p class="mb-0"><?= date('d F Y H:i', strtotime($pendaftaran['tanggal_daftar'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification History -->
            <?php if (!empty($pendaftaran['catatan_provinsi']) || !empty($pendaftaran['tanggal_verifikasi'])): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Riwayat Verifikasi</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($pendaftaran['tanggal_verifikasi'])): ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Verifikasi</label>
                                <p class="mb-0"><?= date('d F Y H:i', strtotime($pendaftaran['tanggal_verifikasi'])) ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($pendaftaran['catatan_provinsi'])): ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Catatan Admin</label>
                                <p class="mb-0"><?= esc($pendaftaran['catatan_provinsi']) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- Photo -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Foto Pelatih/Wasit</h5>
                </div>
                <div class="card-body text-center">
                    <?php if (!empty($pendaftaran['foto_path']) && file_exists($pendaftaran['foto_path'])): ?>
                        <img src="<?= base_url($pendaftaran['foto_path']) ?>" alt="Foto Pelatih/Wasit"
                            class="img-fluid rounded" style="max-height: 300px;">
                    <?php else: ?>
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <span class="avatar-initial rounded bg-label-primary fs-2">
                                <?= strtoupper(substr($pendaftaran['nama_lengkap'], 0, 1)) ?>
                            </span>
                        </div>
                        <p class="text-muted">Foto tidak tersedia</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Certificate -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Sertifikat</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($pendaftaran['sertifikat_path']) && file_exists($pendaftaran['sertifikat_path'])): ?>
                        <?php $ext = pathinfo($pendaftaran['sertifikat_path'], PATHINFO_EXTENSION); ?>
                        <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])): ?>
                            <img src="<?= base_url($pendaftaran['sertifikat_path']) ?>" alt="Sertifikat"
                                class="img-fluid rounded mb-3">
                        <?php else: ?>
                            <div class="text-center mb-3">
                                <i class="bx bx-file-blank bx-lg text-muted"></i>
                                <p class="mb-0">Dokumen PDF</p>
                            </div>
                        <?php endif; ?>
                        <a href="<?= base_url($pendaftaran['sertifikat_path']) ?>" target="_blank"
                            class="btn btn-outline-primary btn-sm w-100">
                            <i class="bx bx-download"></i> Lihat/Download
                        </a>
                    <?php else: ?>
                        <div class="text-center">
                            <i class="bx bx-file-blank bx-lg text-muted mb-2"></i>
                            <p class="text-muted mb-0">Sertifikat tidak tersedia</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions -->
            <?php if ($pendaftaran['status'] === 'menunggu_verifikasi_provinsi'): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Aksi Verifikasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success"
                                onclick="showVerificationModal(<?= $pendaftaran['id_pendaftaran_pelatih'] ?>, 'diterima')">
                                <i class="bx bx-check"></i> Terima Pendaftaran
                            </button>
                            <button type="button" class="btn btn-danger"
                                onclick="showVerificationModal(<?= $pendaftaran['id_pendaftaran_pelatih'] ?>, 'ditolak')">
                                <i class="bx bx-x"></i> Tolak Pendaftaran
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row">
        <div class="col-12">
            <a href="<?= base_url('admin/pendaftaran/pelatih') ?>" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Kembali ke Daftar
            </a>
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