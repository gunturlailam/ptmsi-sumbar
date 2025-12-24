<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4"
    style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                        <i class="fas fa-trophy me-3"></i>Pendaftaran Turnamen
                    </h1>
                    <p class="mb-0" style="font-weight: 500; color: #666;">
                        Daftar dan ikuti turnamen tenis meja yang tersedia
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Turnamen -->
    <div class="row">
        <?php if (!empty($turnamen_tersedia)): ?>
        <?php foreach ($turnamen_tersedia as $turnamen): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-lg h-100 tournament-card"
                style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-header border-0 text-center"
                    style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <?= esc($turnamen['nama_event'] ?? $turnamen['judul']) ?>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Status dan Tingkat -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge px-3 py-2"
                            style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border-radius: 15px; font-weight: 700;">
                            <i class="fas fa-check-circle me-1"></i><?= ucfirst($turnamen['status']) ?>
                        </span>
                        <span class="badge px-3 py-2"
                            style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; border-radius: 15px; font-weight: 700;">
                            <?= ucfirst($turnamen['tingkat'] ?? 'Kabupaten') ?>
                        </span>
                    </div>

                    <!-- Informasi Turnamen -->
                    <?php
                            $tmDate = date('Y-m-d', strtotime($turnamen['tanggal_mulai'] . ' -1 day'));
                            $tmDateTime = $tmDate . ' 19:00:00';
                            ?>
                    <div class="mb-3">
                        <div class="row text-center">
                            <div class="col-6 mb-2">
                                <i class="fas fa-calendar text-primary mb-1" style="font-size: 1.2rem;"></i>
                                <p class="mb-0 small" style="font-weight: 600; color: #003366;">Tanggal Mulai</p>
                                <p class="mb-0 small text-muted">
                                    <?= date('d M Y', strtotime($turnamen['tanggal_mulai'])) ?></p>
                            </div>
                            <div class="col-6 mb-2">
                                <i class="fas fa-clock text-warning mb-1" style="font-size: 1.2rem;"></i>
                                <p class="mb-0 small" style="font-weight: 600; color: #003366;">Batas Daftar</p>
                                <p class="mb-0 small text-muted">
                                    <?= date('d M Y H:i', strtotime($turnamen['batas_pendaftaran'])) ?></p>
                            </div>
                        </div>
                        <div class="row text-center mt-2">
                            <div class="col-12">
                                <p class="mb-1 small" style="font-weight: 600; color: #003366;">
                                    <i class="fas fa-users me-1"></i>Technical Meeting
                                </p>
                                <p class="mb-1 small text-muted">
                                    <?= date('d M Y H:i', strtotime($tmDateTime)) ?>
                                </p>
                                <span class="badge bg-secondary countdown-badge mt-1"
                                    data-deadline="<?= esc($turnamen['batas_pendaftaran']) ?>"
                                    data-tm="<?= esc($tmDateTime) ?>"
                                    data-start="<?= esc($turnamen['tanggal_mulai']) . ' 00:00:00' ?>">
                                    Menghitung...
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Kuota dan Biaya -->
                    <div class="mb-3">
                        <div class="row text-center">
                            <div class="col-6 mb-2">
                                <i class="fas fa-users text-success mb-1" style="font-size: 1.2rem;"></i>
                                <p class="mb-0 small" style="font-weight: 600; color: #003366;">Kuota</p>
                                <p class="mb-0 small">
                                    <span class="text-success"
                                        style="font-weight: 700;"><?= $turnamen['jumlah_peserta'] ?></span>
                                    <span class="text-muted">/ <?= $turnamen['kuota_peserta'] ?? '∞' ?></span>
                                </p>
                            </div>
                            <div class="col-6 mb-2">
                                <i class="fas fa-money-bill text-info mb-1" style="font-size: 1.2rem;"></i>
                                <p class="mb-0 small" style="font-weight: 600; color: #003366;">Biaya</p>
                                <p class="mb-0 small" style="font-weight: 700; color: #1E90FF;">
                                    <?php if ($turnamen['biaya_pendaftaran'] > 0): ?>
                                    Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?>
                                    <?php else: ?>
                                    Gratis
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <?php if (!empty($turnamen['kategori_usia']) || !empty($turnamen['kategori_gender'])): ?>
                    <div class="mb-3">
                        <p class="mb-2 small" style="font-weight: 600; color: #003366;">
                            <i class="fas fa-tags me-1"></i>Kategori:
                        </p>
                        <div class="d-flex flex-wrap gap-1">
                            <?php if (!empty($turnamen['kategori_usia'])): ?>
                            <span class="badge bg-secondary"><?= esc($turnamen['kategori_usia']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($turnamen['kategori_gender'])): ?>
                            <span class="badge bg-info"><?= ucfirst($turnamen['kategori_gender']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Lokasi -->
                    <?php if (!empty($turnamen['lokasi'])): ?>
                    <div class="mb-3">
                        <p class="mb-1 small" style="font-weight: 600; color: #003366;">
                            <i class="fas fa-map-marker-alt me-1"></i>Lokasi:
                        </p>
                        <p class="mb-0 small text-muted"><?= esc($turnamen['lokasi']) ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Status Kuota -->
                    <div class="mb-3">
                        <?php
                                $sisaKuota = $turnamen['sisa_kuota'];
                                $persentaseKuota = $turnamen['kuota_peserta'] > 0 ?
                                    ($turnamen['jumlah_peserta'] / $turnamen['kuota_peserta']) * 100 : 0;
                                ?>
                        <div class="progress mb-2" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: <?= $persentaseKuota ?>%; background: linear-gradient(45deg, #28a745, #20c997);"
                                aria-valuenow="<?= $persentaseKuota ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <p class="mb-0 small text-center">
                            <?php if ($sisaKuota > 0): ?>
                            <span class="text-success" style="font-weight: 600;">Sisa <?= $sisaKuota ?> slot</span>
                            <?php elseif ($turnamen['kuota_peserta'] > 0): ?>
                            <span class="text-danger" style="font-weight: 600;">Kuota penuh</span>
                            <?php else: ?>
                            <span class="text-info" style="font-weight: 600;">Kuota tidak terbatas</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="card-footer border-0 text-center"
                    style="background: transparent; padding: 0 1.5rem 1.5rem;">
                    <?php
                            $bisaDaftar = strtotime($turnamen['batas_pendaftaran']) >= time() &&
                                $turnamen['status'] === 'aktif' &&
                                ($sisaKuota > 0 || $turnamen['kuota_peserta'] == 0);
                            ?>

                    <?php if ($bisaDaftar): ?>
                    <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>"
                        class="btn btn-lg w-100 mb-2"
                        style="background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; border: none; border-radius: 20px; font-weight: 700; transition: all 0.4s ease;">
                        <i class="fas fa-sign-in-alt me-2"></i>Daftar Sekarang
                    </a>
                    <?php else: ?>
                    <button class="btn btn-secondary btn-lg w-100 mb-2" disabled
                        style="border-radius: 20px; font-weight: 700;">
                        <i class="fas fa-times-circle me-2"></i>
                        <?php if (strtotime($turnamen['batas_pendaftaran']) < time()): ?>
                        Pendaftaran Ditutup
                        <?php elseif ($sisaKuota <= 0 && $turnamen['kuota_peserta'] > 0): ?>
                        Kuota Penuh
                        <?php else: ?>
                        Tidak Tersedia
                        <?php endif; ?>
                    </button>
                    <?php endif; ?>

                    <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>"
                        class="btn btn-outline-primary w-100" style="border-radius: 20px; font-weight: 600;">
                        <i class="fas fa-info-circle me-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <!-- Tidak ada turnamen -->
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body text-center py-5">
                    <i class="fas fa-trophy" style="font-size: 5rem; color: #e0e0e0; margin-bottom: 2rem;"></i>
                    <h3 class="mb-3" style="font-weight: 900; color: #003366;">Belum Ada Turnamen Tersedia</h3>
                    <p class="mb-4" style="color: #666; font-weight: 500; font-size: 1.1rem;">
                        Saat ini belum ada turnamen yang membuka pendaftaran.
                        Silakan cek kembali nanti atau hubungi admin untuk informasi lebih lanjut.
                    </p>
                    <a href="<?= base_url() ?>" class="btn btn-lg px-4 py-2"
                        style="background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; border: none; border-radius: 20px; font-weight: 700;">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.tournament-card:hover {
    transform: translateY(-10px) !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    transition: width 0.6s ease;
}
</style>

<script>
// Hitung mundur untuk halaman publik tournament
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

            badge.className = 'badge countdown-badge mt-1 ' + badgeClass;

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