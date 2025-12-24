<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-primary mb-2">
                        <i class='bx bx-play-circle me-2'></i>Live Scoring
                    </h2>
                    <p class="text-muted mb-0">Ikuti pertandingan tenis meja secara real-time</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Events -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($events)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-calendar-x display-4 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Tidak ada event aktif</h5>
                        <p class="text-muted">Saat ini tidak ada pertandingan yang sedang berlangsung</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($events as $event): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100 hover-shadow">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <span class="badge bg-success">
                                            <i class='bx bx-play-circle me-1'></i>Live
                                        </span>
                                    </div>
                                    <h5 class="card-title mb-2">
                                        <?= esc($event['nama_event']) ?>
                                    </h5>
                                    <p class="text-muted small mb-3">
                                        <i class='bx bx-calendar me-1'></i>
                                        <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                    </p>
                                    <p class="text-muted small mb-4">
                                        <i class='bx bx-map-pin me-1'></i>
                                        <?= esc($event['lokasi'] ?? 'Lokasi tidak ditentukan') ?>
                                    </p>
                                    <div class="d-grid gap-2">
                                        <a href="<?= base_url('live-scoring/event/' . $event['id_event']) ?>" class="btn btn-primary btn-sm">
                                            <i class='bx bx-play-circle me-1'></i>Lihat Live Scoring
                                        </a>
                                        <a href="<?= base_url('live-scoring/bracket/' . $event['id_event']) ?>" class="btn btn-outline-primary btn-sm">
                                            <i class='bx bx-sitemap me-1'></i>Bracket
                                        </a>
                                        <a href="<?= base_url('live-scoring/standings/' . $event['id_event']) ?>" class="btn btn-outline-secondary btn-sm">
                                            <i class='bx bx-list-check me-1'></i>Standings
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

    <!-- Quick Links -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class='bx bx-link me-2'></i>Quick Links
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="<?= base_url('live-scoring/top-rated') ?>" class="btn btn-outline-primary w-100">
                                <i class='bx bx-star me-2'></i>Atlet Terbaik
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('ranking') ?>" class="btn btn-outline-success w-100">
                                <i class='bx bx-chart-line me-2'></i>Ranking
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('notifications') ?>" class="btn btn-outline-info w-100">
                                <i class='bx bx-bell me-2'></i>Notifikasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }
</style>
<?= $this->endSection() ?>