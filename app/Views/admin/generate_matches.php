<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                                <i class="fas fa-dice me-3"></i>Generate Pertandingan Acak
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Buat pertandingan acak untuk semua atlet hari ini
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-secondary px-4 py-2"
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
        <!-- Main Content -->
        <div class="col-lg-8 mb-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-info-circle me-2"></i>Informasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info" style="border-radius: 15px; margin-bottom: 0;">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-lightbulb me-2"></i>Cara Kerja
                        </h6>
                        <ul class="mb-0">
                            <li>Sistem akan mengambil semua atlet aktif</li>
                            <li>Atlet akan dipasangkan secara acak</li>
                            <li>Setiap pertandingan dijadwalkan 30 menit</li>
                            <li>Pertandingan dimulai jam 08:00 pagi</li>
                            <li>Jika jumlah atlet ganjil, ada 1 atlet yang bye (istirahat)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-chart-bar me-2"></i>Statistik
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="stat-box p-3" style="background: #f8f9fa; border-radius: 15px; text-align: center;">
                                <h6 class="text-muted mb-2">Total Atlet Aktif</h6>
                                <h3 class="text-primary fw-bold"><?= count($all_atlet) ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="stat-box p-3" style="background: #f8f9fa; border-radius: 15px; text-align: center;">
                                <h6 class="text-muted mb-2">Perkiraan Pertandingan</h6>
                                <h3 class="text-success fw-bold"><?= floor(count($all_atlet) / 2) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #6f42c1, #5a32a3); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-cogs me-2"></i>Aksi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="event_id" class="form-label fw-bold">
                            <i class="fas fa-calendar me-2"></i>Pilih Event (Opsional)
                        </label>
                        <select class="form-select" id="event_id" style="border-radius: 15px; padding: 12px;">
                            <option value="">-- Gunakan Event Aktif Pertama --</option>
                            <?php foreach ($events as $event): ?>
                                <option value="<?= $event['id_event'] ?>">
                                    <?= esc($event['nama_event']) ?> (<?= date('d/m/Y', strtotime($event['tanggal_mulai'])) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-lg" id="btnGenerate"
                            style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border: none; border-radius: 20px; font-weight: 700;">
                            <i class="fas fa-magic me-2"></i>Generate Pertandingan Acak
                        </button>
                        <button type="button" class="btn btn-lg btn-outline-danger" id="btnClear"
                            style="border-radius: 20px; font-weight: 700;">
                            <i class="fas fa-trash me-2"></i>Hapus Semua Pertandingan Hari Ini
                        </button>
                        <a href="<?= base_url('admin/matches-today') ?>" class="btn btn-lg btn-outline-primary"
                            style="border-radius: 20px; font-weight: 700;">
                            <i class="fas fa-eye me-2"></i>Lihat Pertandingan Hari Ini
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 mb-4">
            <!-- Daftar Atlet -->
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-users me-2"></i>Daftar Atlet Aktif
                    </h5>
                </div>
                <div class="card-body p-4" style="max-height: 600px; overflow-y: auto;">
                    <?php if (empty($all_atlet)): ?>
                        <div class="alert alert-warning" style="border-radius: 15px;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Tidak ada atlet aktif
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($all_atlet as $atlet): ?>
                                <div class="list-group-item px-0 py-2 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2" style="width: 40px; height: 40px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user text-white" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-bold"><?= esc($atlet['nama_lengkap']) ?></h6>
                                            <small class="text-muted"><?= esc($atlet['nama_klub'] ?? 'Tanpa Klub') ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Container -->
<div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999; max-width: 400px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnGenerate = document.getElementById('btnGenerate');
        const btnClear = document.getElementById('btnClear');
        const eventSelect = document.getElementById('event_id');

        btnGenerate.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin membuat pertandingan acak untuk semua atlet?')) {
                generateMatches();
            }
        });

        btnClear.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus semua pertandingan hari ini?')) {
                clearMatches();
            }
        });

        function generateMatches() {
            btnGenerate.disabled = true;
            btnGenerate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Membuat...';

            fetch('<?= base_url('admin/generate-matches/generate-random') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'event_id=' + eventSelect.value + '&<?= csrf_token() ?>=<?= csrf_hash() ?>'
                })
                .then(response => response.json())
                .then(data => {
                    btnGenerate.disabled = false;
                    btnGenerate.innerHTML = '<i class="fas fa-magic me-2"></i>Generate Pertandingan Acak';

                    if (data.success) {
                        showAlert('success', 'Berhasil!', data.message);
                        setTimeout(() => {
                            window.location.href = '<?= base_url('admin/matches-today') ?>';
                        }, 2000);
                    } else {
                        showAlert('danger', 'Error!', data.message);
                    }
                })
                .catch(error => {
                    btnGenerate.disabled = false;
                    btnGenerate.innerHTML = '<i class="fas fa-magic me-2"></i>Generate Pertandingan Acak';
                    showAlert('danger', 'Error!', 'Terjadi kesalahan: ' + error.message);
                });
        }

        function clearMatches() {
            btnClear.disabled = true;
            btnClear.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';

            fetch('<?= base_url('admin/generate-matches/clear-matches') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: '<?= csrf_token() ?>=<?= csrf_hash() ?>'
                })
                .then(response => response.json())
                .then(data => {
                    btnClear.disabled = false;
                    btnClear.innerHTML = '<i class="fas fa-trash me-2"></i>Hapus Semua Pertandingan Hari Ini';

                    if (data.success) {
                        showAlert('success', 'Berhasil!', data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        showAlert('danger', 'Error!', data.message);
                    }
                })
                .catch(error => {
                    btnClear.disabled = false;
                    btnClear.innerHTML = '<i class="fas fa-trash me-2"></i>Hapus Semua Pertandingan Hari Ini';
                    showAlert('danger', 'Error!', 'Terjadi kesalahan: ' + error.message);
                });
        }

        function showAlert(type, title, message) {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();

            const alertHTML = `
                <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show shadow-lg" style="border-radius: 15px;" role="alert">
                    <strong>${title}</strong><br>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            alertContainer.insertAdjacentHTML('beforeend', alertHTML);

            setTimeout(() => {
                const alert = document.getElementById(alertId);
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        }
    });
</script>

<?= $this->endSection() ?>