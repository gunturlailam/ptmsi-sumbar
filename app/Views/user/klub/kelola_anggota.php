<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary text-white rounded-circle me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div>
                            <h2 class="mb-1 fw-bold text-primary">Kelola Anggota Klub</h2>
                            <p class="mb-0 text-muted">Kelola semua anggota klub <?= esc($klub['nama']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Navigation Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <ul class="nav nav-pills nav-fill" id="anggotaTabs" role="tablist"></ul>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-0" id="atlet-tab" data-bs-toggle="pill" data-bs-target="#atlet" type="button" role="tab">
                            <i class="fas fa-running me-2"></i>Atlet (<?= count($anggota_atlet) ?>)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0" id="pelatih-tab" data-bs-toggle="pill" data-bs-target="#pelatih" type="button" role="tab">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Pelatih & Wasit (<?= count($anggota_pelatih) ?>)
                        </button>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="anggotaTabsContent">
        <!-- Atlet Tab -->
        <div class="tab-pane fade show active" id="atlet" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-light border-0" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-running me-2"></i>Daftar Atlet
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($anggota_atlet)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Nama Atlet</th>
                                        <th class="border-0 px-4 py-3">Email</th>
                                        <th class="border-0 px-4 py-3">No. HP</th>
                                        <th class="border-0 px-4 py-3">Status</th>
                                        <th class="border-0 px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($anggota_atlet as $atlet): ?>
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold"><?= esc($atlet['nama_lengkap']) ?></div>
                                                        <small class="text-muted">ID: <?= esc($atlet['id_atlet']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3"><?= esc($atlet['email']) ?></td>
                                            <td class="px-4 py-3"><?= esc($atlet['no_hp'] ?? '-') ?></td>
                                            <td class="px-4 py-3">
                                                <?php
                                                $statusClass = $atlet['status'] === 'aktif' ? 'success' : 'warning';
                                                $statusText = ucfirst($atlet['status']);
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>"><?= $statusText ?></span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <button type="button" class="btn btn-outline-info btn-sm"
                                                    onclick="showDetailAtlet(<?= $atlet['id_atlet'] ?>)">
                                                    <i class="fas fa-eye me-1"></i>Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-user-slash fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Atlet</h5>
                            <p class="text-muted">Klub belum memiliki atlet yang terdaftar.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Pelatih Tab -->
        <div class="tab-pane fade" id="pelatih" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-light border-0" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Daftar Pelatih & Wasit
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($anggota_pelatih)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Nama Pelatih</th>
                                        <th class="border-0 px-4 py-3">Email</th>
                                        <th class="border-0 px-4 py-3">No. HP</th>
                                        <th class="border-0 px-4 py-3">Tingkat Sertifikasi</th>
                                        <th class="border-0 px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($anggota_pelatih as $pelatih): ?>
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-chalkboard-teacher"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold"><?= esc($pelatih['nama_lengkap']) ?></div>
                                                        <small class="text-muted">ID: <?= esc($pelatih['id_pelatih']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3"><?= esc($pelatih['email']) ?></td>
                                            <td class="px-4 py-3"><?= esc($pelatih['nohp'] ?? '-') ?></td>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-info"><?= esc($pelatih['jenis'] ?? 'Pelatih') ?></span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <button type="button" class="btn btn-outline-info btn-sm"
                                                    onclick="showDetailPelatih(<?= $pelatih['id_pelatih'] ?>)">
                                                    <i class="fas fa-eye me-1"></i>Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-chalkboard-teacher fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Pelatih</h5>
                            <p class="text-muted">Klub belum memiliki pelatih yang terdaftar.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Atlet -->
<div class="modal fade" id="detailAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Atlet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailAtletContent">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pelatih -->
<div class="modal fade" id="detailPelatihModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pelatih</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailPelatihContent">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
        font-size: 0.875rem;
    }

    .nav-pills .nav-link {
        color: #6c757d;
        border-radius: 0;
        padding: 1rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
    }

    .nav-pills .nav-link:hover:not(.active) {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .table th {
        font-weight: 600;
        color: #495057;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<script>
    function showDetailAtlet(idAtlet) {
        const modal = new bootstrap.Modal(document.getElementById('detailAtletModal'));
        const content = document.getElementById('detailAtletContent');

        // Show loading
        content.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

        modal.show();

        // Fetch detail data
        fetch(`<?= base_url('user/klub/detail-atlet/') ?>${idAtlet}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    content.innerHTML = generateAtletDetailContent(data.atlet);
                } else {
                    content.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${data.message || 'Gagal memuat detail atlet'}
                    </div>
                `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Terjadi kesalahan saat memuat data
                </div>
            `;
            });
    }

    function showDetailPelatih(idPelatih) {
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

        // Fetch detail data
        fetch(`<?= base_url('user/klub/detail-pelatih/') ?>${idPelatih}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    content.innerHTML = generatePelatihDetailContent(data.pelatih);
                } else {
                    content.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${data.message || 'Gagal memuat detail pelatih'}
                    </div>
                `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Terjadi kesalahan saat memuat data
                </div>
            `;
            });
    }

    function generateAtletDetailContent(atlet) {
        return `
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">Informasi Pribadi</h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Nama Lengkap:</td>
                        <td class="fw-semibold">${atlet.nama_lengkap}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td>${atlet.email}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. HP:</td>
                        <td>${atlet.no_hp || '-'}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Lahir:</td>
                        <td>${atlet.tanggal_lahir || '-'}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">Informasi Atlet</h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Kategori Usia:</td>
                        <td><span class="badge bg-info">${atlet.kategori_usia || '-'}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis Kelamin:</td>
                        <td>${atlet.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Ranking Provinsi:</td>
                        <td class="fw-bold text-success">${atlet.ranking_provinsi || 'Belum ada ranking'}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        ${atlet.alamat ? `
        <div class="mt-3">
            <h6 class="fw-bold text-primary mb-2">Alamat</h6>
            <p class="text-muted">${atlet.alamat}</p>
        </div>
        ` : ''}
    `;
    }

    function generatePelatihDetailContent(pelatih) {
        return `
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">Informasi Pribadi</h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Nama Lengkap:</td>
                        <td class="fw-semibold">${pelatih.nama_lengkap}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td>${pelatih.email}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. HP:</td>
                        <td>${pelatih.no_hp || '-'}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">Informasi Pelatih</h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Tingkat Sertifikasi:</td>
                        <td><span class="badge bg-success">${pelatih.jenis_pelatih}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        
        ${pelatih.alamat && pelatih.alamat !== '-' ? `
        <div class="mt-3">
            <h6 class="fw-bold text-primary mb-2">Alamat</h6>
            <p class="text-muted">${pelatih.alamat}</p>
        </div>
        ` : ''}
    `;
    }
</script>
<?= $this->endSection() ?>