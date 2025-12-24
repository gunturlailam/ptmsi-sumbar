<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-2">
                        <i class='bx bx-save me-2'></i>Backup & Export Data
                    </h3>
                    <p class="text-muted mb-0">Kelola backup dan export data sistem</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Backup Options -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-download me-2'></i>Export All Data
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Export semua data sistem ke file ZIP yang berisi CSV files untuk setiap tabel.
                    </p>
                    <div class="alert alert-info mb-4">
                        <i class='bx bx-info-circle me-2'></i>
                        <strong>Informasi:</strong> File backup akan berisi data dari tabel: Klub, Atlet, Pelatih, Event, Berita, Ranking, dan User.
                    </div>
                    <a href="<?= base_url('admin/analytics/export-all-data') ?>" class="btn btn-primary w-100">
                        <i class='bx bx-download me-2'></i>Download Backup ZIP
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-history me-2'></i>Export Audit Log
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">
                        Export audit log dalam format CSV untuk analisis dan audit trail.
                    </p>
                    <form method="GET" action="<?= base_url('admin/analytics/export-audit-log') ?>" class="mb-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" value="<?= date('Y-m-01') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control" value="<?= date('Y-m-d') ?>">
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class='bx bx-download me-2'></i>Download Audit Log CSV
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Backup Information -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-info-circle me-2'></i>Informasi Backup
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Tabel yang Dibackup:</h6>
                            <ul class="list-unstyled">
                                <li><i class='bx bx-check text-success me-2'></i>Klub</li>
                                <li><i class='bx bx-check text-success me-2'></i>Atlet</li>
                                <li><i class='bx bx-check text-success me-2'></i>Pelatih</li>
                                <li><i class='bx bx-check text-success me-2'></i>Event</li>
                                <li><i class='bx bx-check text-success me-2'></i>Berita</li>
                                <li><i class='bx bx-check text-success me-2'></i>Ranking</li>
                                <li><i class='bx bx-check text-success me-2'></i>User</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Panduan Penggunaan:</h6>
                            <ol class="ps-3">
                                <li>Klik tombol "Download Backup ZIP"</li>
                                <li>File akan diunduh dalam format ZIP</li>
                                <li>Extract file ZIP untuk melihat CSV files</li>
                                <li>Buka CSV files dengan Excel atau aplikasi spreadsheet lainnya</li>
                                <li>Simpan backup di lokasi yang aman</li>
                            </ol>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-warning">
                        <i class='bx bx-shield-alt-2 me-2'></i>
                        <strong>Keamanan:</strong> Backup berisi data sensitif. Pastikan untuk menyimpan file backup di lokasi yang aman dan terlindungi.
                    </div>

                    <div class="alert alert-info">
                        <i class='bx bx-info-circle me-2'></i>
                        <strong>Rekomendasi:</strong> Lakukan backup secara berkala (minimal 1x per minggu) untuk memastikan data Anda aman.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>