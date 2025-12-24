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
                                <i class="fas fa-trophy me-3"></i>Input Hasil Pertandingan
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Catat hasil pertandingan dan update ranking otomatis
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
                            <i class="fas fa-list me-2"></i>Daftar Pertandingan (<?= count($matches) ?> Pertandingan)
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <?php foreach ($matches as $match): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
                                        <!-- Header -->
                                        <div style="background: linear-gradient(45deg, #1E90FF, #00BFFF); padding: 15px; color: white;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="fw-bold">
                                                    <i class="fas fa-clock me-1"></i><?= date('H:i', strtotime($match['jadwal'])) ?>
                                                </small>
                                                <span class="badge bg-white text-primary">
                                                    <?= esc($match['babak']) ?>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Match Content -->
                                        <div class="card-body p-3">
                                            <!-- Atlet 1 -->
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="avatar me-2" style="width: 40px; height: 40px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-user text-white" style="font-size: 0.8rem;"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">
                                                            <?= esc($match['nama_atlet1'] ?? 'N/A') ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- VS -->
                                            <div class="text-center mb-3">
                                                <span class="badge bg-secondary" style="font-size: 0.8rem;">VS</span>
                                            </div>

                                            <!-- Atlet 2 -->
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2" style="width: 40px; height: 40px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-user text-white" style="font-size: 0.8rem;"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">
                                                            <?= esc($match['nama_atlet2'] ?? 'N/A') ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Venue -->
                                            <div class="alert alert-light mb-3 py-2 px-3" style="border-radius: 10px; font-size: 0.85rem;">
                                                <i class="fas fa-map-marker-alt me-1"></i><?= esc($match['venue']) ?>
                                            </div>

                                            <!-- Action Button -->
                                            <a href="<?= base_url('admin/hasil-pertandingan/input/' . $match['id_pertandingan']) ?>"
                                                class="btn btn-primary w-100" style="border-radius: 15px; font-weight: 600;">
                                                <i class="fas fa-edit me-2"></i>Input Hasil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>