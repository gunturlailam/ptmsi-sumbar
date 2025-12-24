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
                                <i class="fas fa-calendar-day me-3"></i>Pertandingan Hari Ini
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                <?= date('d F Y', strtotime($today)) ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('admin/generate-matches') ?>" class="btn btn-outline-secondary px-4 py-2"
                                style="border-radius: 20px; font-weight: 600;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (empty($matches)): ?>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 20px;"></i>
                        <h5 class="text-muted mb-2">Tidak Ada Pertandingan</h5>
                        <p class="text-muted mb-0">Belum ada pertandingan yang dijadwalkan untuk hari ini.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-list me-2"></i>Jadwal Pertandingan (<?= count($matches) ?> Pertandingan)
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10%;">Jam</th>
                                        <th style="width: 10%;">Babak</th>
                                        <th style="width: 30%;">Atlet 1</th>
                                        <th style="width: 30%;">Atlet 2</th>
                                        <th style="width: 15%;">Venue</th>
                                        <th style="width: 5%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($matches as $match): ?>
                                        <tr>
                                            <td>
                                                <strong><?= date('H:i', strtotime($match['jadwal'])) ?></strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?= esc($match['babak']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2" style="width: 35px; height: 35px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-user text-white" style="font-size: 0.7rem;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold"><?= esc($match['nama_atlet1'] ?? 'N/A') ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($match['babak'] === 'Bye'): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-moon me-1"></i>Istirahat (Bye)
                                                    </span>
                                                <?php else: ?>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2" style="width: 35px; height: 35px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-user text-white" style="font-size: 0.7rem;"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold"><?= esc($match['nama_atlet2'] ?? 'N/A') ?></h6>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    <?= esc($match['venue']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-body p-4 text-center">
                        <h6 class="text-muted mb-2">Total Pertandingan</h6>
                        <h3 class="text-primary fw-bold"><?= count($matches) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-body p-4 text-center">
                        <h6 class="text-muted mb-2">Pertandingan Reguler</h6>
                        <h3 class="text-success fw-bold">
                            <?php
                            $regular = 0;
                            foreach ($matches as $m) {
                                if ($m['babak'] !== 'Bye') $regular++;
                            }
                            echo $regular;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-body p-4 text-center">
                        <h6 class="text-muted mb-2">Bye (Istirahat)</h6>
                        <h3 class="text-warning fw-bold">
                            <?php
                            $bye = 0;
                            foreach ($matches as $m) {
                                if ($m['babak'] === 'Bye') $bye++;
                            }
                            echo $bye;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>