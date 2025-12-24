<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-primary mb-2">
                                <i class='bx bx-play-circle me-2'></i><?= esc($event['nama_event']) ?>
                            </h2>
                            <p class="text-muted mb-0">
                                <i class='bx bx-calendar me-1'></i><?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                <i class='bx bx-map-pin me-1 ms-3'></i><?= esc($event['lokasi'] ?? '-') ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('live-scoring') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#matches">
                        <i class='bx bx-play-circle me-2'></i>Pertandingan Hari Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#results">
                        <i class='bx bx-trophy me-2'></i>Hasil Terbaru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#standings">
                        <i class='bx bx-list-check me-2'></i>Standings
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Matches Tab -->
        <div id="matches" class="tab-pane fade show active">
            <div class="row">
                <div class="col-12">
                    <?php if (empty($matches)): ?>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <i class='bx bx-inbox display-4 text-muted mb-3'></i>
                                <p class="text-muted">Tidak ada pertandingan hari ini</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach ($matches as $match): ?>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-primary">
                                                    <?= date('H:i', strtotime($match['jam_pertandingan'])) ?>
                                                </span>
                                                <span class="badge bg-secondary">
                                                    <?= esc($match['lapangan'] ?? 'Lapangan -') ?>
                                                </span>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-5 text-center">
                                                    <h6 class="mb-1">
                                                        <a href="<?= base_url('live-scoring/atlet/' . $match['id_atlet_1']) ?>" class="text-decoration-none">
                                                            <?= esc($match['nama_atlet_1'] ?? 'Atlet 1') ?>
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">
                                                        <?= esc($match['nama_klub_1'] ?? '-') ?>
                                                    </small>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <div class="display-6 fw-bold text-primary">
                                                        <?= $match['skor_atlet_1'] ?? '-' ?>
                                                    </div>
                                                    <small class="text-muted">vs</small>
                                                    <div class="display-6 fw-bold text-primary">
                                                        <?= $match['skor_atlet_2'] ?? '-' ?>
                                                    </div>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <h6 class="mb-1">
                                                        <a href="<?= base_url('live-scoring/atlet/' . $match['id_atlet_2']) ?>" class="text-decoration-none">
                                                            <?= esc($match['nama_atlet_2'] ?? 'Atlet 2') ?>
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">
                                                        <?= esc($match['nama_klub_2'] ?? '-') ?>
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="mt-3 pt-3 border-top">
                                                <small class="text-muted">
                                                    Status: <span class="badge bg-warning">Dijadwalkan</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Results Tab -->
        <div id="results" class="tab-pane fade">
            <div class="row">
                <div class="col-12">
                    <?php if (empty($results)): ?>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 text-center">
                                <i class='bx bx-inbox display-4 text-muted mb-3'></i>
                                <p class="text-muted">Belum ada hasil pertandingan</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach ($results as $result): ?>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-success">Selesai</span>
                                                <small class="text-muted">
                                                    <?= date('d/m/Y H:i', strtotime($result['tanggal_hasil'])) ?>
                                                </small>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-5 text-center">
                                                    <h6 class="mb-1">Atlet 1</h6>
                                                    <small class="text-muted">Klub</small>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <div class="display-6 fw-bold">
                                                        <?= $result['skor_atlet_1'] ?? '-' ?>
                                                    </div>
                                                    <small>vs</small>
                                                    <div class="display-6 fw-bold">
                                                        <?= $result['skor_atlet_2'] ?? '-' ?>
                                                    </div>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <h6 class="mb-1">Atlet 2</h6>
                                                    <small class="text-muted">Klub</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Standings Tab -->
        <div id="standings" class="tab-pane fade">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Peringkat</th>
                                            <th>Atlet</th>
                                            <th>Klub</th>
                                            <th class="text-end">Menang</th>
                                            <th class="text-end">Kalah</th>
                                            <th class="text-end">Poin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted p-4">
                                                Data standings akan ditampilkan setelah ada hasil pertandingan
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>