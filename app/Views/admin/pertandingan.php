<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h4 class="mb-1">Manajemen Pertandingan</h4>
                    <small class="text-muted">
                        <?= $today_only ? 'Daftar pertandingan yang berlangsung hari ini' : 'Daftar seluruh pertandingan aktif' ?>
                    </small>
                </div>
                <div class="ms-auto d-flex gap-2">
                    <!-- Tombol filter Hari Ini / Semua -->
                    <?php if ($today_only): ?>
                    <a href="<?= base_url('admin/pertandingan?today=0') ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="bx bx-calendar"></i> Tampilkan Semua
                    </a>
                    <?php else: ?>
                    <a href="<?= base_url('admin/pertandingan?today=1') ?>" class="btn btn-sm btn-primary">
                        <i class="bx bx-calendar-check"></i> Pertandingan Hari Ini
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Filter & Pencarian -->
            <div class="card mb-3">
                <div class="card-body">
                    <form method="get" class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <label class="form-label mb-1">Cari Pertandingan</label>
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Cari judul event, turnamen, atau lokasi..."
                                value="<?= esc($search ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label mb-1">Mode Tampilan</label>
                            <select name="today" class="form-select form-select-sm">
                                <option value="" <?= !$today_only ? 'selected' : '' ?>>Semua Pertandingan Aktif</option>
                                <option value="1" <?= $today_only ? 'selected' : '' ?>>Hanya Pertandingan Hari Ini
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                <i class="bx bx-search"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <a href="<?= base_url('admin/pertandingan') ?>"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="bx bx-reset"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Pertandingan -->
            <div class="card">
                <div class="card-body p-0">
                    <?php if (!empty($events)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Event / Turnamen</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Penyelenggara</th>
                                    <th>Tingkat</th>
                                    <th style="width: 110px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $today = date('Y-m-d');
                                    ?>
                                <?php foreach ($events as $event): ?>
                                <?php
                                        $isToday = ($event['tanggal_mulai'] <= $today && $event['tanggal_selesai'] >= $today);

                                        // Deadline pendaftaran & Technical Meeting otomatis
                                        $deadline = $event['batas_pendaftaran'] ?? null;
                                        $tmDate = date('Y-m-d', strtotime($event['tanggal_mulai'] . ' -1 day'));
                                        $tmDateTime = $tmDate . ' 19:00:00'; // TM otomatis H-1 jam 19.00
                                        $startDateTime = $event['tanggal_mulai'] . ' 00:00:00';
                                        ?>
                                <tr class="<?= $isToday ? 'table-success' : '' ?>">
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <strong><?= esc($event['judul']) ?></strong><br>
                                        <small class="text-muted">
                                            Turnamen: <?= esc($event['nama_turnamen'] ?? '-') ?>
                                        </small>
                                    </td>
                                    <td>
                                        <small class="d-block mb-1">
                                            <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                            s/d
                                            <?= date('d M Y', strtotime($event['tanggal_selesai'])) ?>
                                            <?php if ($isToday): ?>
                                            <span class="badge bg-success ms-1">Hari Ini</span>
                                            <?php endif; ?>
                                        </small>

                                        <!-- Timeline: Deadline, TM, Start + Hitung Mundur -->
                                        <small class="text-muted d-block">
                                            <?php if ($deadline): ?>
                                            Deadline daftar:
                                            <?= date('d M Y H:i', strtotime($deadline)) ?><br>
                                            <?php endif; ?>
                                            Technical Meeting:
                                            <?= date('d M Y H:i', strtotime($tmDateTime)) ?>
                                        </small>
                                        <span class="badge bg-secondary mt-1 countdown-badge"
                                            data-deadline="<?= $deadline ? esc($deadline) : '' ?>"
                                            data-tm="<?= esc($tmDateTime) ?>" data-start="<?= esc($startDateTime) ?>">
                                            Menghitung...
                                        </span>
                                    </td>
                                    <td>
                                        <small><?= esc($event['lokasi'] ?? '-') ?></small>
                                    </td>
                                    <td>
                                        <small><?= esc($event['nama_klub'] ?? 'PTMSI Sumbar') ?></small>
                                    </td>
                                    <td>
                                        <?php
                                                $badgeClass = 'bg-secondary';
                                                if (isset($event['tingkat'])) {
                                                    $tingkat = strtolower($event['tingkat']);
                                                    if ($tingkat === 'provinsi') {
                                                        $badgeClass = 'bg-primary';
                                                    } elseif ($tingkat === 'nasional') {
                                                        $badgeClass = 'bg-warning text-dark';
                                                    } elseif ($tingkat === 'open') {
                                                        $badgeClass = 'bg-info text-dark';
                                                    }
                                                }
                                                ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= esc($event['tingkat'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/pertandingan/detail/' . $event['id_event']) ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bx bx-show"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="p-4 text-center">
                        <i class="bx bx-calendar-x" style="font-size: 3rem;"></i>
                        <h5 class="mt-2 mb-1">
                            <?php if ($today_only): ?>
                            Tidak ada pertandingan yang berlangsung hari ini.
                            <?php else: ?>
                            Belum ada pertandingan aktif yang terdaftar.
                            <?php endif; ?>
                        </h5>
                        <p class="text-muted mb-0">
                            Tambahkan atau aktifkan event terlebih dahulu di menu
                            <strong>Event & Kejuaraan → Daftar Event</strong> agar muncul di sini.
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Hitung mundur untuk Deadline, Technical Meeting, dan Mulai Pertandingan
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
                label = 'Pendaftaran tutup dalam: ';
                badgeClass = 'bg-info text-dark';
            } else if (tmTime && now < tmTime) {
                diff = tmTime - now;
                label = 'TM dimulai dalam: ';
                badgeClass = 'bg-warning text-dark';
            } else if (startTime && now < startTime) {
                diff = startTime - now;
                label = 'Laga dimulai dalam: ';
                badgeClass = 'bg-primary';
            } else if (startTime && now >= startTime) {
                label = 'Sedang berlangsung / selesai';
                badgeClass = 'bg-success';
            } else {
                label = 'Jadwal belum lengkap';
                badgeClass = 'bg-secondary';
            }

            badge.className = 'badge mt-1 countdown-badge ' + badgeClass;

            if (diff !== null) {
                const durationText = formatDuration(diff);
                badge.textContent = label + (durationText || 'sebentar lagi');
            } else {
                badge.textContent = label;
            }
        });
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>

<?= $this->endSection() ?>