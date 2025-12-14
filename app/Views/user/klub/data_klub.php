<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                                <i class="fas fa-building me-3"></i>Data Klub
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Informasi lengkap dan data klub <?= esc($klub['nama']) ?>
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
        <!-- Informasi Utama Klub -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-info-circle me-2"></i>Informasi Klub
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-tag text-primary me-2"></i>Nama Klub
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666; font-size: 1.1rem;">
                                    <?= esc($klub['nama']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt text-success me-2"></i>Tanggal Berdiri
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666;">
                                    <?= date('d F Y', strtotime($klub['tanggal_berdiri'])) ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>Alamat
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666;">
                                    <?= esc($klub['alamat']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-user-tie text-warning me-2"></i>Penanggung Jawab
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666;">
                                    <?= esc($klub['penanggung_jawab']) ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-phone text-info me-2"></i>Telepon
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666;">
                                    <?= esc($klub['telepon']) ?>
                                </p>
                            </div>
                        </div>
                        <?php if (!empty($klub['nama_organisasi'])): ?>
                            <div class="col-12 mb-3">
                                <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                    <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                        <i class="fas fa-sitemap text-secondary me-2"></i>Organisasi
                                    </h6>
                                    <p class="mb-0" style="font-weight: 600; color: #666;">
                                        <?= esc($klub['nama_organisasi']) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status dan Aksi -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-chart-bar me-2"></i>Status Klub
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <?php if ($klub['status'] === 'aktif'): ?>
                            <div class="status-badge mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle text-white" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="mb-2" style="font-weight: 900; color: #28a745;">AKTIF</h4>
                            <p class="mb-0 text-muted">Klub sudah terverifikasi dan dapat beroperasi penuh</p>
                        <?php else: ?>
                            <div class="status-badge mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock text-white" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="mb-2" style="font-weight: 900; color: #ffc107;"><?= strtoupper($klub['status']) ?></h4>
                            <p class="mb-0 text-muted">Menunggu verifikasi dari Admin Provinsi</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <h6 style="font-weight: 700; color: #003366; margin-bottom: 15px;">Tanggal Penting</h6>
                        <div class="text-start">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Didaftarkan:</span>
                                <span style="font-weight: 600;"><?= date('d/m/Y', strtotime($klub['tanggal_berdiri'])) ?></span>
                            </div>
                            <?php if (!empty($klub['tanggal_verifikasi'])): ?>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Diverifikasi:</span>
                                    <span style="font-weight: 600;"><?= date('d/m/Y', strtotime($klub['tanggal_verifikasi'])) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($klub['status'] === 'aktif'): ?>
                        <div class="d-grid gap-2">
                            <a href="<?= base_url('user/klub/kelola-atlet') ?>" class="btn btn-primary" style="border-radius: 15px; font-weight: 600;">
                                <i class="fas fa-users me-2"></i>Kelola Atlet
                            </a>
                            <a href="<?= base_url('user/klub/pendaftaran-turnamen') ?>" class="btn btn-success" style="border-radius: 15px; font-weight: 600;">
                                <i class="fas fa-trophy me-2"></i>Daftar Turnamen
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Dokumen Klub -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-file-alt me-2"></i>Dokumen Klub
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <?php if (!empty($klub['sk_klub_path'])): ?>
                            <div class="col-md-6 mb-3">
                                <div class="document-card p-3" style="background: #f8f9fa; border-radius: 15px; border-left: 4px solid #1E90FF;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-file-pdf" style="font-size: 2rem; color: #dc3545;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" style="font-weight: 700; color: #003366;">SK Klub</h6>
                                            <p class="mb-2 small text-muted">Surat Keputusan Pendirian Klub</p>
                                            <a href="<?= base_url($klub['sk_klub_path']) ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius: 10px;">
                                                <i class="fas fa-download me-1"></i>Unduh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($klub['identitas_pengurus_path'])): ?>
                            <div class="col-md-6 mb-3">
                                <div class="document-card p-3" style="background: #f8f9fa; border-radius: 15px; border-left: 4px solid #28a745;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3"></div> <i class="fas fa-id-card" style="font-size: 2rem; color: #28a745;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1" style="font-weight: 700; color: #003366;">Identitas Pengurus</h6>
                                        <p class="mb-2 small text-muted">Dokumen Identitas Pengurus Klub</p>
                                        <a href="<?= base_url($klub['identitas_pengurus_path']) ?>" target="_blank" class="btn btn-sm btn-outline-success" style="border-radius: 10px;">
                                            <i class="fas fa-download me-1"></i>Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php endif; ?>
                </div>

                <?php if (empty($klub['sk_klub_path']) && empty($klub['identitas_pengurus_path'])): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                        <p class="text-muted mb-0">Belum ada dokumen yang diupload</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .info-item {
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: #e9ecef !important;
        transform: translateY(-2px);
    }

    .document-card {
        transition: all 0.3s ease;
    }

    .document-card:hover {
        background: #e9ecef !important;
        transform: translateY(-2px);
    }

    .status-badge {
        transition: all 0.3s ease;
    }

    .status-badge:hover {
        transform: scale(1.05);
    }
</style>
<?= $this->endSection() ?>