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
                                <i class="fas fa-trophy me-3"></i><?= esc($turnamen['nama_event'] ?? $turnamen['judul']) ?>
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Detail turnamen dan informasi pendaftaran
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('tournament') ?>" class="btn btn-outline-secondary px-4 py-2"
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
        <!-- Informasi Turnamen -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-info-circle me-2"></i>Informasi Turnamen
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Status dan Badges -->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border-radius: 15px; font-weight: 700; font-size: 0.9rem;">
                            <i class="fas fa-check-circle me-1"></i><?= ucfirst($turnamen['status']) ?>
                        </span>
                        <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; border-radius: 15px; font-weight: 700; font-size: 0.9rem;">
                            <i class="fas fa-layer-group me-1"></i><?= ucfirst($turnamen['tingkat'] ?? 'Kabupaten') ?>
                        </span>
                        <?php if (!empty($turnamen['kategori_usia'])): ?>
                            <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #dc3545, #c82333); color: white; border-radius: 15px; font-weight: 700; font-size: 0.9rem;">
                                <i class="fas fa-birthday-cake me-1"></i><?= esc($turnamen['kategori_usia']) ?>
                            </span>
                        <?php endif; ?>
                        <?php if (!empty($turnamen['kategori_gender'])): ?>
                            <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #6f42c1, #5a32a3); color: white; border-radius: 15px; font-weight: 700; font-size: 0.9rem;">
                                <i class="fas fa-venus-mars me-1"></i><?= ucfirst($turnamen['kategori_gender']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Deskripsi -->
                    <?php if (!empty($turnamen['deskripsi'])): ?>
                        <div class="mb-4">
                            <h6 style="font-weight: 700; color: #003366;">
                                <i class="fas fa-file-alt me-2"></i>Deskripsi
                            </h6>
                            <p style="color: #666; line-height: 1.6;"><?= nl2br(esc($turnamen['deskripsi'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Detail Informasi -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>Tanggal Pelaksanaan
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666;">
                                    <?= date('d F Y', strtotime($turnamen['tanggal_mulai'])) ?>
                                    <?php if ($turnamen['tanggal_selesai'] !== $turnamen['tanggal_mulai']): ?>
                                        - <?= date('d F Y', strtotime($turnamen['tanggal_selesai'])) ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-clock text-warning me-2"></i>Batas Pendaftaran
                                </h6>
                                <p class="mb-0" style="font-weight: 600; color: #666;">
                                    <?= date('d F Y', strtotime($turnamen['batas_pendaftaran'])) ?>
                                </p>
                            </div>
                        </div>
                        <?php if (!empty($turnamen['lokasi'])): ?>
                            <div class="col-md-6 mb-3">
                                <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                    <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>Lokasi
                                    </h6>
                                    <p class="mb-0" style="font-weight: 600; color: #666;">
                                        <?= esc($turnamen['lokasi']) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-6 mb-3">
                            <div class="info-item p-3" style="background: #f8f9fa; border-radius: 15px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 8px;">
                                    <i class="fas fa-money-bill-wave text-success me-2"></i>Biaya Pendaftaran
                                </h6>
                                <p class="mb-0" style="font-weight: 700; color: #1E90FF; font-size: 1.1rem;">
                                    <?php if ($turnamen['biaya_pendaftaran'] > 0): ?>
                                        Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        Gratis
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Syarat Khusus -->
                    <?php if (!empty($turnamen['syarat_khusus'])): ?>
                        <div class="mt-4">
                            <h6 style="font-weight: 700; color: #003366;">
                                <i class="fas fa-exclamation-triangle me-2"></i>Syarat Khusus
                            </h6>
                            <div class="alert alert-info" style="border-radius: 15px;">
                                <?= nl2br(esc($turnamen['syarat_khusus'])) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Panel Pendaftaran -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg sticky-top" style="border-radius: 25px; background: rgba(255,255,255,0.95); top: 20px;">
                <div class="card-header border-0 text-center" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-user-plus me-2"></i>Pendaftaran
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Status Kuota -->
                    <div class="mb-4">
                        <h6 style="font-weight: 700; color: #003366; margin-bottom: 15px;">
                            <i class="fas fa-users me-2"></i>Status Kuota
                        </h6>
                        <div class="text-center mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="mb-0" style="font-weight: 900; color: #28a745;"><?= $turnamen['jumlah_peserta'] ?></h3>
                                    <small class="text-muted">Terdaftar</small>
                                </div>
                                <div class="col-6">
                                    <h3 class="mb-0" style="font-weight: 900; color: #1E90FF;">
                                        <?= $turnamen['kuota_peserta'] > 0 ? $turnamen['kuota_peserta'] : '∞' ?>
                                    </h3>
                                    <small class="text-muted">Kuota</small>
                                </div>
                            </div>
                        </div>

                        <?php
                        $persentaseKuota = $turnamen['kuota_peserta'] > 0 ?
                            ($turnamen['jumlah_peserta'] / $turnamen['kuota_peserta']) * 100 : ($turnamen['jumlah_peserta'] > 0 ? 50 : 0);
                        ?>
                        <div class="progress mb-2" style="height: 12px; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: <?= min($persentaseKuota, 100) ?>%; background: linear-gradient(45deg, #28a745, #20c997);"
                                aria-valuenow="<?= $persentaseKuota ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <p class="mb-0 text-center small">
                            <?php if ($turnamen['sisa_kuota'] > 0): ?>
                                <span class="text-success" style="font-weight: 600;">Sisa <?= $turnamen['sisa_kuota'] ?> slot</span>
                            <?php elseif ($turnamen['kuota_peserta'] > 0): ?>
                                <span class="text-danger" style="font-weight: 600;">Kuota penuh</span>
                            <?php else: ?>
                                <span class="text-info" style="font-weight: 600;">Kuota tidak terbatas</span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- Status Pendaftaran User -->
                    <?php if (session()->get('logged_in')): ?>
                        <?php if ($sudah_mendaftar): ?>
                            <div class="alert alert-success text-center" style="border-radius: 15px;">
                                <i class="fas fa-check-circle" style="font-size: 2rem; margin-bottom: 10px;"></i>
                                <h6 style="font-weight: 700;">Anda Sudah Terdaftar</h6>
                                <p class="mb-2 small">Status:
                                    <strong><?= ucfirst(str_replace('_', ' ', $pendaftaran_user['status_verifikasi'])) ?></strong>
                                </p>
                                <?php if ($pendaftaran_user['status_verifikasi'] === 'pending'): ?>
                                    <p class="mb-0 small text-muted">Menunggu verifikasi panitia</p>
                                <?php endif; ?>
                            </div>

                            <?php if ($turnamen['biaya_pendaftaran'] > 0 && empty($pendaftaran_user['bukti_pembayaran'])): ?>
                                <a href="<?= base_url('tournament/upload-bukti/' . $pendaftaran_user['id_pendaftaran']) ?>"
                                    class="btn btn-warning w-100 mb-2" style="border-radius: 20px; font-weight: 700;">
                                    <i class="fas fa-upload me-2"></i>Upload Bukti Bayar
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- Tombol Daftar -->
                            <?php if ($masih_bisa_daftar): ?>
                                <a href="<?= base_url('tournament/daftar/' . $turnamen['id_event']) ?>"
                                    class="btn btn-lg w-100 mb-3"
                                    style="background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; border: none; border-radius: 20px; font-weight: 700; transition: all 0.4s ease; text-decoration: none;">
                                    <i class="fas fa-clipboard-list me-2"></i>Daftar Sekarang
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-lg w-100 mb-3" disabled style="border-radius: 20px; font-weight: 700;">
                                    <i class="fas fa-times-circle me-2"></i>
                                    <?php if (strtotime($turnamen['batas_pendaftaran']) < time()): ?>
                                        Pendaftaran Ditutup
                                    <?php elseif ($turnamen['sisa_kuota'] <= 0 && $turnamen['kuota_peserta'] > 0): ?>
                                        Kuota Penuh
                                    <?php else: ?>
                                        Tidak Tersedia
                                    <?php endif; ?>
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Belum Login -->
                        <div class="alert alert-warning text-center" style="border-radius: 15px;">
                            <i class="fas fa-sign-in-alt" style="font-size: 2rem; margin-bottom: 10px;"></i>
                            <h6 style="font-weight: 700;">Login Diperlukan</h6>
                            <p class="mb-3 small">Silakan login terlebih dahulu untuk mendaftar turnamen</p>
                            <a href="<?= base_url('auth/login') ?>" class="btn btn-primary w-100" style="border-radius: 20px; font-weight: 700;">
                                <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Informasi Tambahan -->
                    <div class="mt-4">
                        <h6 style="font-weight: 700; color: #003366; margin-bottom: 15px;">
                            <i class="fas fa-info-circle me-2"></i>Informasi Penting
                        </h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Pastikan status atlet/klub sudah aktif
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Periksa kategori usia dan gender
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Siapkan bukti pembayaran jika diperlukan
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success me-2"></i>
                                Tunggu konfirmasi dari panitia
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .info-item {
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: #e9ecef !important;
        transform: translateY(-2px);
    }
</style>
<?= $this->endSection() ?>