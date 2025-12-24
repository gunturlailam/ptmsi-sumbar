<?= $this->extend('user/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary text-white rounded-circle me-3"
                            style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bx bx-trophy bx-lg"></i>
                        </div>
                        <div>
                            <h2 class="mb-1 fw-bold text-primary">Pendaftaran Turnamen</h2>
                            <p class="mb-0 text-muted">Kelola pendaftaran turnamen untuk klub <?= esc($klub['nama']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Navigation Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <ul class="nav nav-pills nav-fill" id="tournamentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-0" id="available-tab" data-bs-toggle="pill"
                                data-bs-target="#available" type="button" role="tab">
                                <i class="bx bx-calendar-plus me-2"></i>Turnamen Tersedia
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0" id="history-tab" data-bs-toggle="pill"
                                data-bs-target="#history" type="button" role="tab">
                                <i class="bx bx-history me-2"></i>Riwayat Pendaftaran
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="tournamentTabsContent">
        <!-- Turnamen Tersedia -->
        <div class="tab-pane fade show active" id="available" role="tabpanel">
            <div class="row">
                <?php if (!empty($turnamen_tersedia)): ?>
                    <?php foreach ($turnamen_tersedia as $turnamen): ?>
                        <div class="col-lg-6 col-xl-4 mb-4">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease;">
                                <div class="card-header bg-gradient-primary text-white" style="border-radius: 15px 15px 0 0;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-bold"><?= esc($turnamen['nama_event']) ?></h5>
                                        <span class="badge bg-light text-primary"><?= ucfirst($turnamen['tingkat']) ?></span>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Kategori Usia</small>
                                                <span class="badge bg-info"><?= esc($turnamen['kategori_usia']) ?></span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Gender</small>
                                                <span
                                                    class="badge bg-secondary"><?= ucfirst($turnamen['kategori_gender']) ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $tmDate = date('Y-m-d', strtotime($turnamen['tanggal_mulai'] . ' -1 day'));
                                    $tmDateTime = $tmDate . ' 19:00:00';
                                    ?>
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Tanggal Turnamen</small>
                                        <p class="mb-1 fw-semibold">
                                            <i class="bx bx-calendar me-1"></i>
                                            <?= date('d M Y', strtotime($turnamen['tanggal_mulai'])) ?> -
                                            <?= date('d M Y', strtotime($turnamen['tanggal_selesai'])) ?>
                                        </p>
                                    </div>

                                    <div class="mb-1">
                                        <small class="text-muted d-block">Batas Pendaftaran</small>
                                        <p class="mb-1 fw-semibold text-danger">
                                            <i class="bx bx-time-five me-1"></i>
                                            <?= date('d M Y H:i', strtotime($turnamen['batas_pendaftaran'])) ?>
                                        </p>
                                    </div>

                                    <div class="mb-2">
                                        <small class="text-muted d-block">Technical Meeting</small>
                                        <p class="mb-1 fw-semibold text-primary">
                                            <i class="bx bx-group me-1"></i>
                                            <?= date('d M Y H:i', strtotime($tmDateTime)) ?>
                                        </p>
                                    </div>

                                    <span class="badge bg-secondary countdown-badge mb-2"
                                        data-deadline="<?= esc($turnamen['batas_pendaftaran']) ?>"
                                        data-tm="<?= esc($tmDateTime) ?>"
                                        data-start="<?= esc($turnamen['tanggal_mulai']) . ' 00:00:00' ?>">
                                        Menghitung...
                                    </span>

                                    <div class="mb-3">
                                        <small class="text-muted d-block">Lokasi</small>
                                        <p class="mb-1">
                                            <i class="bx bx-map-marker-alt me-1"></i>
                                            <?= esc($turnamen['lokasi']) ?>
                                        </p>
                                    </div>

                                    <?php if ($turnamen['kuota_peserta']): ?>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <small class="text-muted">Kuota Peserta</small>
                                                <small class="fw-semibold">
                                                    <?= $turnamen['jumlah_peserta'] ?? 0 ?>/<?= $turnamen['kuota_peserta'] ?>
                                                </small>
                                            </div>
                                            <?php
                                            $persentase = $turnamen['kuota_peserta'] > 0 ?
                                                (($turnamen['jumlah_peserta'] ?? 0) / $turnamen['kuota_peserta']) * 100 : 0;
                                            ?>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: <?= $persentase ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($turnamen['biaya_pendaftaran'] > 0): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block">Biaya Pendaftaran</small>
                                            <p class="mb-1 fw-bold text-success">
                                                <i class="bx bx-money-bill-wave me-1"></i>
                                                Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($turnamen['deskripsi']): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block">Deskripsi</small>
                                            <p class="mb-0 small"><?= esc(substr($turnamen['deskripsi'], 0, 100)) ?>...</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer bg-transparent border-0 p-4 pt-0">
                                    <div class="d-grid gap-2">
                                        <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>"
                                            class="btn btn-primary btn-lg">
                                            <i class="bx bx-eye me-2"></i>Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                            <div class="card-body text-center py-5">
                                <div class="mb-4">
                                    <i class="bx bx-calendar-times fa-4x text-muted"></i>
                                </div>
                                <h4 class="text-muted mb-2">Tidak Ada Turnamen Tersedia</h4>
                                <p class="text-muted">Saat ini belum ada turnamen yang bisa didaftari. Silakan cek kembali
                                    nanti.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Riwayat Pendaftaran -->
        <div class="tab-pane fade" id="history" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-light border-0" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bx bx-history me-2"></i>Riwayat Pendaftaran Turnamen
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($riwayat_pendaftaran)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Turnamen</th>
                                        <th class="border-0 px-4 py-3">Atlet</th>
                                        <th class="border-0 px-4 py-3">Tanggal Daftar</th>
                                        <th class="border-0 px-4 py-3">Status Verifikasi</th>
                                        <th class="border-0 px-4 py-3">Status Pembayaran</th>
                                        <th class="border-0 px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($riwayat_pendaftaran as $pendaftaran): ?>
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div>
                                                    <div class="fw-semibold"><?= esc($pendaftaran['nama_event']) ?></div>
                                                    <?php if ($pendaftaran['kategori']): ?>
                                                        <small class="text-muted"><?= esc($pendaftaran['kategori']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="fw-semibold"><?= esc($pendaftaran['nama_atlet']) ?></div>
                                                <?php if ($pendaftaran['nama_atlet2']): ?>
                                                    <small class="text-muted">Partner:
                                                        <?= esc($pendaftaran['nama_atlet2']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?= date('d/m/Y H:i', strtotime($pendaftaran['tanggal_daftar'])) ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php
                                                $statusClass = 'secondary';
                                                $statusText = 'Pending';

                                                switch ($pendaftaran['status_verifikasi']) {
                                                    case 'diverifikasi':
                                                        $statusClass = 'success';
                                                        $statusText = 'Diverifikasi';
                                                        break;
                                                    case 'ditolak':
                                                        $statusClass = 'danger';
                                                        $statusText = 'Ditolak';
                                                        break;
                                                    case 'pending':
                                                        $statusClass = 'warning';
                                                        $statusText = 'Menunggu Verifikasi';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>"><?= $statusText ?></span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if ($pendaftaran['biaya_pendaftaran'] > 0): ?>
                                                    <?php
                                                    $paymentClass = 'secondary';
                                                    $paymentText = 'Belum Bayar';

                                                    switch ($pendaftaran['status_pembayaran']) {
                                                        case 'lunas':
                                                            $paymentClass = 'success';
                                                            $paymentText = 'Lunas';
                                                            break;
                                                        case 'menunggu_konfirmasi':
                                                            $paymentClass = 'warning';
                                                            $paymentText = 'Menunggu Konfirmasi';
                                                            break;
                                                        case 'ditolak':
                                                            $paymentClass = 'danger';
                                                            $paymentText = 'Ditolak';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="badge bg-<?= $paymentClass ?>"><?= $paymentText ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-info">Gratis</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="btn-group btn-group-sm">
                                                    <?php if (
                                                        $pendaftaran['biaya_pendaftaran'] > 0 &&
                                                        $pendaftaran['status_pembayaran'] !== 'lunas' &&
                                                        $pendaftaran['status_verifikasi'] !== 'ditolak'
                                                    ): ?>
                                                        <a href="<?= base_url('tournament/upload-bukti/' . $pendaftaran['id_pendaftaran']) ?>"
                                                            class="btn btn-outline-primary btn-sm">
                                                            <i class="bx bx-upload me-1"></i>Upload Bukti
                                                        </a>
                                                    <?php endif; ?>

                                                    <button type="button" class="btn btn-outline-info btn-sm"
                                                        onclick="showDetailPendaftaran(<?= $pendaftaran['id_pendaftaran'] ?>)">
                                                        <i class="bx bx-eye me-1"></i>Detail
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="bx bx-clipboard-list fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Riwayat Pendaftaran</h5>
                            <p class="text-muted">Klub belum pernah mendaftarkan atlet ke turnamen manapun.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pendaftaran -->
<div class="modal fade" id="detailPendaftaranModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pendaftaran Turnamen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailPendaftaranContent">
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
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
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

    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
    }

    .progress {
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        border-radius: 10px;
    }

    .table th {
        font-weight: 600;
        color: #495057;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-group-sm>.btn {
        font-size: 0.75rem;
    }
</style>

<script>
    function showDetailPendaftaran(idPendaftaran) {
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

        // Fetch detail data (you can implement this endpoint)
        fetch(`<?= base_url('user/klub/detail-pendaftaran-turnamen/') ?>${idPendaftaran}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    content.innerHTML = generateDetailContent(data.pendaftaran);
                } else {
                    content.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bx bx-exclamation-triangle me-2"></i>
                        ${data.message || 'Gagal memuat detail pendaftaran'}
                    </div>
                `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bx bx-exclamation-triangle me-2"></i>
                    Terjadi kesalahan saat memuat data
                </div>
            `;
            });
    }

    function generateDetailContent(pendaftaran) {
        return `
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">Informasi Turnamen</h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Nama Turnamen:</td>
                        <td class="fw-semibold">${pendaftaran.nama_event}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kategori:</td>
                        <td>${pendaftaran.kategori || '-'}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Daftar:</td>
                        <td>${pendaftaran.tanggal_daftar}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">Status Pendaftaran</h6>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted">Status Verifikasi:</td>
                        <td><span class="badge bg-${pendaftaran.status_class}">${pendaftaran.status_text}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status Pembayaran:</td>
                        <td><span class="badge bg-${pendaftaran.payment_class}">${pendaftaran.payment_text}</span></td>
                    </tr>
                    ${pendaftaran.nomor_peserta ? `
                    <tr>
                        <td class="text-muted">Nomor Peserta:</td>
                        <td class="fw-bold text-success">${pendaftaran.nomor_peserta}</td>
                    </tr>
                    ` : ''}
                </table>
            </div>
        </div>
        
        ${pendaftaran.catatan_verifikasi ? `
        <div class="mt-3">
            <h6 class="fw-bold text-primary mb-2">Catatan Verifikasi</h6>
            <div class="alert alert-info">
                ${pendaftaran.catatan_verifikasi}
            </div>
        </div>
        ` : ''}
    `;
    }

    // Auto refresh setiap 30 detik untuk update status
    setInterval(() => {
        if (document.getElementById('history').classList.contains('active')) {
            location.reload();
        }
    }, 30000);

    // Hitung mundur untuk klub - pendaftaran turnamen
    document.addEventListener('DOMContentLoaded', function() {
        const badges = document.querySelectorAll('.countdown-badge');

        function formatDuration(ms) {
            if (ms <= 0) return null;
            const totalSeconds = Math.floor(ms / 1000);
            const days = Math.floor(totalSeconds / (24 * 3600));
            const hours = Math.floor((totalSeconds % (24 * 3600)) / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            const parts = [];
            if (days > 0) parts.push(days + 'h');
            if (hours > 0 || days > 0) parts.push(hours + 'j');
            if (minutes > 0 || hours > 0 || days > 0) parts.push(minutes + 'm');
            parts.push(seconds + 'd');

            return parts.join(' ');
        }

        function updateCountdown() {
            const now = new Date().getTime();

            badges.forEach(badge => {
                const deadlineStr = badge.getAttribute('data-deadline');
                const tmStr = badge.getAttribute('data-tm');
                const startStr = badge.getAttribute('data-start');

                const deadlineTime = deadlineStr ? new Date(deadlineStr.replace(' ', 'T')).getTime() : null;
                const tmTime = tmStr ? new Date(tmStr.replace(' ', 'T')).getTime() : null;
                const startTime = startStr ? new Date(startStr.replace(' ', 'T')).getTime() : null;

                let label = '';
                let diff = null;
                let badgeClass = 'bg-secondary';

                if (deadlineTime && now < deadlineTime) {
                    diff = deadlineTime - now;
                    label = 'Daftar tutup dalam: ';
                    badgeClass = 'bg-info text-dark';
                } else if (tmTime && now < tmTime) {
                    diff = tmTime - now;
                    label = 'TM dalam: ';
                    badgeClass = 'bg-warning text-dark';
                } else if (startTime && now < startTime) {
                    diff = startTime - now;
                    label = 'Laga mulai dalam: ';
                    badgeClass = 'bg-primary';
                } else if (startTime && now >= startTime) {
                    label = 'Event berlangsung / selesai';
                    badgeClass = 'bg-success';
                } else {
                    label = 'Jadwal belum lengkap';
                    badgeClass = 'bg-secondary';
                }

                badge.className = 'badge countdown-badge mb-2 ' + badgeClass;

                if (diff !== null) {
                    const durationText = formatDuration(diff);
                    badge.textContent = label + (durationText || 'sebentar lagi');
                } else {
                    badge.textContent = label;
                }
            });
        }

        if (badges.length) {
            updateCountdown();
            setInterval(updateCountdown, 1000);
        }
    });
</script>
<?= $this->endSection() ?>