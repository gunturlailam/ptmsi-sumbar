<?= $this->extend('user/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                                <i class="fas fa-chalkboard-teacher me-3"></i>Kelola Pelatih & Wasit
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Manajemen pelatih dan wasit klub <?= esc($klub['nama']) ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-outline-secondary px-4 py-2"
                                style="border-radius: 20px; font-weight: 600;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tambah Pelatih/Wasit -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Pelatih/Wasit Baru
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="text-center">
                        <a href="<?= base_url('registration/pelatih-register') ?>" class="btn btn-success btn-lg px-5 py-3"
                            style="border-radius: 20px; font-weight: 700;">
                            <i class="fas fa-user-plus me-2"></i>Daftarkan Pelatih/Wasit Baru
                        </a>
                        <p class="mt-3 text-muted">
                            Klik tombol di atas untuk mendaftarkan pelatih atau wasit baru ke klub Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendaftaran Pelatih Pending -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-clock me-2"></i>Pendaftaran Menunggu Verifikasi (<?= count($pendaftaran_pelatih) ?>)
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($pendaftaran_pelatih)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="font-weight: 700; color: #003366; border-radius: 10px 0 0 10px;">Nama</th>
                                        <th style="font-weight: 700; color: #003366;">Jenis</th>
                                        <th style="font-weight: 700; color: #003366;">Tanggal Daftar</th>
                                        <th style="font-weight: 700; color: #003366;">Status</th>
                                        <th style="font-weight: 700; color: #003366; border-radius: 0 10px 10px 0;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendaftaran_pelatih as $pendaftaran): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-3" style="width: 40px; height: 40px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-chalkboard-teacher text-white"></i>
                                                    </div>
                                                    <div>
                                                        <div style="font-weight: 600; color: #003366;">
                                                            <?= esc($pendaftaran['nama_lengkap']) ?>
                                                        </div>
                                                        <small class="text-muted"><?= esc($pendaftaran['email']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info" style="border-radius: 10px;">
                                                    <?= esc($pendaftaran['jenis_pelatih']) ?>
                                                </span>
                                            </td>
                                            <td style="font-weight: 500;">
                                                <?= date('d/m/Y', strtotime($pendaftaran['tanggal_daftar'])) ?>
                                            </td>
                                            <td>
                                                <?php
                                                $statusClass = 'bg-warning';
                                                $statusText = 'Menunggu Verifikasi';
                                                if ($pendaftaran['status'] === 'diterima') {
                                                    $statusClass = 'bg-success';
                                                    $statusText = 'Diterima';
                                                } elseif ($pendaftaran['status'] === 'ditolak') {
                                                    $statusClass = 'bg-danger';
                                                    $statusText = 'Ditolak';
                                                }
                                                ?>
                                                <span class="badge <?= $statusClass ?>" style="border-radius: 10px;">
                                                    <?= $statusText ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    onclick="lihatDetailPelatih(<?= $pendaftaran['id_pendaftaran_pelatih'] ?>)"
                                                    style="border-radius: 8px;">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-inbox" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                            <p class="text-muted mb-0">Tidak ada pendaftaran pelatih/wasit yang menunggu verifikasi</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Pelatih/Wasit Aktif -->
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #007bff, #0056b3); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-check-circle me-2"></i>Pelatih & Wasit Aktif (<?= count($pelatih_aktif) ?>)
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($pelatih_aktif)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead style="background: #f8f9fa;">
                                    <tr>
                                        <th style="font-weight: 700; color: #003366; border-radius: 10px 0 0 10px;">Nama</th>
                                        <th style="font-weight: 700; color: #003366;">Email</th>
                                        <th style="font-weight: 700; color: #003366;">Jenis</th>
                                        <th style="font-weight: 700; color: #003366;">Sertifikat</th>
                                        <th style="font-weight: 700; color: #003366;">Status</th>
                                        <th style="font-weight: 700; color: #003366; border-radius: 0 10px 10px 0;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pelatih_aktif as $pelatih): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-3" style="width: 40px; height: 40px; background: linear-gradient(45deg, #007bff, #0056b3); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-chalkboard-teacher text-white"></i>
                                                    </div>
                                                    <div>
                                                        <div style="font-weight: 600; color: #003366;">
                                                            <?= esc($pelatih['nama_lengkap']) ?>
                                                        </div>
                                                        <small class="text-muted">ID: <?= $pelatih['id_pelatih'] ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="font-weight: 500;"><?= esc($pelatih['email']) ?></td>
                                            <td>
                                                <span class="badge bg-info" style="border-radius: 10px;">
                                                    <?= esc($pelatih['jenis_pelatih']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if (!empty($pelatih['sertifikat'])): ?>
                                                    <span class="badge bg-success" style="border-radius: 10px;">
                                                        <i class="fas fa-certificate me-1"></i>Ada
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary" style="border-radius: 10px;">
                                                        <i class="fas fa-times me-1"></i>Belum Ada
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-success" style="border-radius: 10px;">
                                                    <i class="fas fa-check me-1"></i>Aktif
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        onclick="lihatDetailPelatihAktif(<?= $pelatih['id_pelatih'] ?>)"
                                                        style="border-radius: 8px;">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-chalkboard-teacher" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                            <p class="text-muted mb-0">Belum ada pelatih/wasit aktif di klub ini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pendaftaran Pelatih -->
<div class="modal fade" id="detailPendaftaranModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-info-circle me-2"></i>Detail Pendaftaran Pelatih/Wasit
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="detailPendaftaranContent">
                <!-- Content will be loaded via AJAX -->
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pelatih Aktif -->
<div class="modal fade" id="detailPelatihModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #007bff, #0056b3); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-user me-2"></i>Detail Pelatih/Wasit
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="detailPelatihContent">
                <!-- Content will be loaded via AJAX -->
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function lihatDetailPelatih(pendaftaranId) {
        const modal = new bootstrap.Modal(document.getElementById('detailPendaftaranModal'));
        const content = document.getElementById('detailPendaftaranContent');

        // Show loading
        content.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

        modal.show();

        // Load pendaftaran detail via AJAX
        fetch('<?= base_url('user/klub/detail-pendaftaran-pelatih') ?>/' + pendaftaranId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pendaftaran = data.pendaftaran;
                    content.innerHTML = `
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="avatar-circle mx-auto mb-3" style="width: 120px; height: 120px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                ${pendaftaran.foto ? 
                                    '<img src="' + pendaftaran.foto + '" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">' :
                                    '<i class="fas fa-chalkboard-teacher text-white" style="font-size: 3rem;"></i>'
                                }
                            </div>
                            <h5 style="font-weight: 700; color: #003366;">${pendaftaran.nama_lengkap}</h5>
                            <span class="badge bg-info" style="border-radius: 10px;">
                                ${pendaftaran.jenis_pelatih}
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Email:</strong></div>
                                <div class="col-sm-8">${pendaftaran.email}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>No. HP:</strong></div>
                                <div class="col-sm-8">${pendaftaran.no_hp}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Alamat:</strong></div>
                                <div class="col-sm-8">${pendaftaran.alamat}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Tanggal Daftar:</strong></div>
                                <div class="col-sm-8">${pendaftaran.tanggal_daftar}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Status:</strong></div>
                                <div class="col-sm-8">
                                    <span class="badge ${pendaftaran.status === 'diterima' ? 'bg-success' : (pendaftaran.status === 'ditolak' ? 'bg-danger' : 'bg-warning')}" style="border-radius: 10px;">
                                        ${pendaftaran.status_text}
                                    </span>
                                </div>
                            </div>
                            ${pendaftaran.sertifikat ? `
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Sertifikat:</strong></div>
                                    <div class="col-sm-8">
                                        <a href="${pendaftaran.sertifikat}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download me-1"></i>Lihat Sertifikat
                                        </a>
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
                } else {
                    content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p class="text-muted">Gagal memuat detail pendaftaran</p>
                    </div>
                `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                </div>
            `;
            });
    }

    function lihatDetailPelatihAktif(pelatihId) {
        const modal = new bootstrap.Modal(document.getElementById('detailPelatihModal'));
        const content = document.getElementById('detailPelatihContent');

        // Show loading
        content.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

        modal.show();

        // Load pelatih detail via AJAX
        fetch('<?= base_url('user/klub/detail-pelatih') ?>/' + pelatihId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pelatih = data.pelatih;
                    content.innerHTML = `
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="avatar-circle mx-auto mb-3" style="width: 120px; height: 120px; background: linear-gradient(45deg, #007bff, #0056b3); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                ${pelatih.foto ? 
                                    '<img src="' + pelatih.foto + '" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">' :
                                    '<i class="fas fa-chalkboard-teacher text-white" style="font-size: 3rem;"></i>'
                                }
                            </div>
                            <h5 style="font-weight: 700; color: #003366;">${pelatih.nama_lengkap}</h5>
                            <span class="badge bg-success" style="border-radius: 10px;">
                                <i class="fas fa-check me-1"></i>Pelatih Aktif
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>ID Pelatih:</strong></div>
                                <div class="col-sm-8">${pelatih.id_pelatih}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Email:</strong></div>
                                <div class="col-sm-8">${pelatih.email}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Jenis:</strong></div>
                                <div class="col-sm-8">
                                    <span class="badge bg-info" style="border-radius: 10px;">${pelatih.jenis_pelatih}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>No. HP:</strong></div>
                                <div class="col-sm-8">${pelatih.no_hp || '-'}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Alamat:</strong></div>
                                <div class="col-sm-8">${pelatih.alamat || '-'}</div>
                            </div>
                            ${pelatih.sertifikat ? `
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Sertifikat:</strong></div>
                                    <div class="col-sm-8">
                                        <a href="${pelatih.sertifikat}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download me-1"></i>Lihat Sertifikat
                                        </a>
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
                } else {
                    content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p class="text-muted">Gagal memuat detail pelatih</p>
                    </div>
                `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                </div>
            `;
            });
    }

    // Auto-hide alerts
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
<?= $this->endSection() ?>