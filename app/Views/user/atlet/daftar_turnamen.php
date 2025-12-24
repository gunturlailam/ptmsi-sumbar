<?= $this->extend('user/atlet/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-trophy me-2'></i>Daftar Turnamen
                            </h3>
                            <p class="text-muted mb-0">
                                Daftar dan ikuti turnamen badminton yang tersedia
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/atlet/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Turnamen Tersedia -->
    <div class="row mb-5">
        <div class="col-12">
            <h5 class="mb-4">
                <i class='bx bx-calendar me-2'></i>Turnamen Tersedia
            </h5>

            <?php if (empty($turnamen_tersedia)): ?>
                <div class="alert alert-info border-0" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    <strong>Tidak ada turnamen tersedia</strong> saat ini. Silakan cek kembali nanti.
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($turnamen_tersedia as $turnamen): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-2">
                                        <?= esc($turnamen['nama_event']) ?>
                                    </h5>
                                    <?php
                                    $tmDate = date('Y-m-d', strtotime($turnamen['tanggal_mulai'] . ' -1 day'));
                                    $tmDateTime = $tmDate . ' 19:00:00';
                                    ?>
                                    <p class="card-text text-muted small mb-1">
                                        <i class='bx bx-calendar me-1'></i>
                                        <?= date('d/m/Y', strtotime($turnamen['tanggal_mulai'])) ?>
                                    </p>
                                    <p class="card-text text-muted small mb-1">
                                        <i class='bx bx-time-five me-1'></i>
                                        Deadline daftar:
                                        <?= date('d/m/Y H:i', strtotime($turnamen['batas_pendaftaran'])) ?>
                                    </p>
                                    <p class="card-text text-muted small mb-1">
                                        <i class='bx bx-group me-1'></i>
                                        Technical Meeting:
                                        <?= date('d/m/Y H:i', strtotime($tmDateTime)) ?>
                                    </p>
                                    <span class="badge bg-secondary small countdown-badge mt-1"
                                        data-deadline="<?= esc($turnamen['batas_pendaftaran']) ?>"
                                        data-tm="<?= esc($tmDateTime) ?>"
                                        data-start="<?= esc($turnamen['tanggal_mulai']) . ' 00:00:00' ?>">
                                        Menghitung...
                                    </span>
                                    <p class="card-text small mb-3 mt-2">
                                        <?= substr(esc($turnamen['deskripsi'] ?? ''), 0, 100) ?>...
                                    </p>
                                    <div class="d-grid gap-2">
                                        <div class="alert alert-info mb-0 py-2 px-3" style="border-radius: 8px;">
                                            <small>
                                                <i class='bx bx-info-circle me-1'></i>
                                                Pendaftaran hanya melalui klub Anda
                                            </small>
                                        </div>
                                        <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>"
                                            class="btn btn-outline-secondary btn-sm">
                                            <i class='bx bx-info-circle me-1'></i>Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Riwayat Pendaftaran -->
    <div class="row">
        <div class="col-12">
            <h5 class="mb-4">
                <i class='bx bx-history me-2'></i>Riwayat Pendaftaran
            </h5>

            <?php if (empty($riwayat_pendaftaran)): ?>
                <div class="alert alert-info border-0" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    <strong>Belum ada pendaftaran</strong>. Daftar turnamen sekarang untuk memulai!
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Turnamen</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($riwayat_pendaftaran as $pendaftaran): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($pendaftaran['nama_event']) ?></strong>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y H:i', strtotime($pendaftaran['tanggal_daftar'])) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $pendaftaran['status'] ?? 'pending';
                                        $badgeClass = match ($status) {
                                            'approved' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            'pending' => 'bg-warning',
                                            default => 'bg-secondary'
                                        };
                                        $statusLabel = match ($status) {
                                            'approved' => 'Disetujui',
                                            'rejected' => 'Ditolak',
                                            'pending' => 'Menunggu',
                                            default => 'Tidak Diketahui'
                                        };
                                        ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= $statusLabel ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('tournament/detail/' . $pendaftaran['id_event']) ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class='bx bx-show'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Hitung mundur untuk atlet - daftar turnamen
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

                badge.className = 'badge small countdown-badge mt-1 ' + badgeClass;

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