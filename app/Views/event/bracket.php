<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                                <i class="bi bi-diagram-3-fill me-3"></i>Bracket Pertandingan
                            </h1>
                            <h4 class="text-primary mb-1"><?= esc($event['judul']) ?></h4>
                            <p class="mb-0 text-muted">
                                <i class="bi bi-calendar me-2"></i><?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                <span class="mx-2">•</span>
                                <i class="bi bi-trophy me-2"></i><?= ucfirst($event['tingkat']) ?>
                            </p>
                        </div>
                        <a href="<?= base_url('event') ?>" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bracket Content -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <?php if (!empty($pertandingan)): ?>
                        <?php
                        // Group pertandingan by babak
                        $babakGroup = [];
                        foreach ($pertandingan as $p) {
                            $babakGroup[$p['babak']][] = $p;
                        }
                        ?>

                        <div class="bracket-container">
                            <?php foreach ($babakGroup as $babak => $matches): ?>
                                <div class="bracket-round mb-5">
                                    <h5 class="text-center mb-4 fw-bold text-primary">
                                        <?= ucfirst($babak) ?>
                                    </h5>
                                    <div class="row g-3">
                                        <?php foreach ($matches as $match): ?>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="match-card p-3 border rounded-3 <?= !empty($match['id_pemenang_atlet']) ? 'border-success' : 'border-secondary' ?>">
                                                    <div class="match-header text-center mb-2">
                                                        <small class="text-muted">Pertandingan #<?= $match['urutan_pertandingan'] ?></small>
                                                    </div>

                                                    <!-- Atlet 1 -->
                                                    <div class="player-row d-flex justify-content-between align-items-center p-2 rounded mb-1 <?= $match['id_pemenang_atlet'] == $match['id_atlet1'] ? 'bg-success text-white' : 'bg-light' ?>">
                                                        <span class="fw-bold"><?= esc($match['nama_atlet1'] ?? 'TBA') ?></span>
                                                        <span class="badge bg-primary"><?= $match['skor_atlet1'] ?? '-' ?></span>
                                                    </div>

                                                    <!-- VS -->
                                                    <div class="text-center my-1">
                                                        <small class="text-muted">VS</small>
                                                    </div>

                                                    <!-- Atlet 2 -->
                                                    <div class="player-row d-flex justify-content-between align-items-center p-2 rounded mb-2 <?= $match['id_pemenang_atlet'] == $match['id_atlet2'] ? 'bg-success text-white' : 'bg-light' ?>">
                                                        <span class="fw-bold"><?= esc($match['nama_atlet2'] ?? 'TBA') ?></span>
                                                        <span class="badge bg-primary"><?= $match['skor_atlet2'] ?? '-' ?></span>
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="text-center">
                                                        <?php if (!empty($match['id_pemenang_atlet'])): ?>
                                                            <span class="badge bg-success">
                                                                <i class="bi bi-check-circle me-1"></i>Selesai
                                                            </span>
                                                        <?php elseif ($match['status'] == 'berlangsung'): ?>
                                                            <span class="badge bg-warning">
                                                                <i class="bi bi-clock me-1"></i>Berlangsung
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary">
                                                                <i class="bi bi-calendar me-1"></i>Terjadwal
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="bi bi-diagram-3" style="font-size: 4rem; color: #e0e0e0;"></i>
                            <h5 class="mt-3 fw-bold">Bracket Belum Tersedia</h5>
                            <p class="text-muted">Bracket pertandingan akan ditampilkan setelah pendaftaran ditutup dan peserta dikonfirmasi.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .match-card {
        transition: all 0.3s ease;
    }

    .match-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .player-row {
        transition: all 0.3s ease;
    }

    .bracket-container {
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .bracket-round {
            margin-bottom: 2rem;
        }
    }
</style>
<?= $this->endSection() ?>