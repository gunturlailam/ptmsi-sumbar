<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                                <i class="fas fa-chart-line me-3"></i>Kelola Ranking Atlet
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Sistem ranking otomatis berdasarkan hasil pertandingan
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <form action="<?= base_url('admin/update-ranking-otomatis') ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-lg px-4 py-2"
                                    style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border: none; border-radius: 20px; font-weight: 700;">
                                    <i class="fas fa-sync-alt me-2"></i>Update Ranking
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ranking Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="fas fa-trophy me-2"></i>Ranking Bulan <?= date('F Y') ?>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" style="border-radius: 15px;">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($ranking_terbaru)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="font-weight: 700; color: #003366; text-align: center;">Peringkat</th>
                                        <th style="font-weight: 700; color: #003366;">Nama Atlet</th>
                                        <th style="font-weight: 700; color: #003366;">Klub</th>
                                        <th style="font-weight: 700; color: #003366; text-align: center;">Total Poin</th>
                                        <th style="font-weight: 700; color: #003366; text-align: center;">Pertandingan</th>
                                        <th style="font-weight: 700; color: #003366; text-align: center;">Menang</th>
                                        <th style="font-weight: 700; color: #003366; text-align: center;">Win Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ranking_terbaru as $index => $ranking): ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if ($ranking['peringkat'] <= 3): ?>
                                                    <?php
                                                    $medals = [1 => 'gold', 2 => 'silver', 3 => '#cd7f32'];
                                                    $medal_color = $medals[$ranking['peringkat']];
                                                    ?>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-medal" style="color: <?= $medal_color ?>; font-size: 1.5rem; margin-right: 8px;"></i>
                                                        <span style="font-weight: 900; font-size: 1.2rem; color: #003366;">
                                                            <?= $ranking['peringkat'] ?>
                                                        </span>
                                                    </div>
                                                <?php else: ?>
                                                    <span style="font-weight: 700; font-size: 1.1rem; color: #666;">
                                                        <?= $ranking['peringkat'] ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                        style="width: 40px; height: 40px; background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; font-weight: 700;">
                                                        <?= strtoupper(substr($ranking['nama_lengkap'], 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0" style="font-weight: 700; color: #003366;">
                                                            <?= esc($ranking['nama_lengkap']) ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="font-weight: 600; color: #666;">
                                                <?= esc($ranking['nama_klub'] ?? 'Tidak ada klub') ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; border-radius: 15px; font-weight: 700; font-size: 0.9rem;">
                                                    <?= number_format($ranking['total_poin'] ?? 0) ?>
                                                </span>
                                            </td>
                                            <td class="text-center" style="font-weight: 600; color: #666;">
                                                <?= $ranking['jumlah_pertandingan'] ?? 0 ?>
                                            </td>
                                            <td class="text-center" style="font-weight: 600; color: #28a745;">
                                                <?= $ranking['menang'] ?? 0 ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $total_pertandingan = $ranking['jumlah_pertandingan'] ?? 0;
                                                $menang = $ranking['menang'] ?? 0;
                                                $win_rate = $total_pertandingan > 0 ? round(($menang / $total_pertandingan) * 100, 1) : 0;
                                                ?>
                                                <div class="progress" style="height: 20px; border-radius: 10px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: <?= $win_rate ?>%; background: linear-gradient(45deg, #28a745, #20c997);"
                                                        aria-valuenow="<?= $win_rate ?>" aria-valuemin="0" aria-valuemax="100">
                                                        <span style="font-weight: 700; font-size: 0.8rem;"><?= $win_rate ?>%</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-chart-line" style="font-size: 4rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                            <h4 style="font-weight: 700; color: #666;">Belum Ada Data Ranking</h4>
                            <p class="text-muted">Ranking akan muncul setelah ada hasil pertandingan bulan ini</p>
                            <form action="<?= base_url('admin/update-ranking-otomatis') ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-lg px-4 py-2"
                                    style="background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; border: none; border-radius: 20px; font-weight: 700;">
                                    <i class="fas fa-sync-alt me-2"></i>Generate Ranking
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Sistem Poin -->
    <div class="row mt-4"></div>
    <div class="col-md-6">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                <h5 class="mb-0 text-white" style="font-weight: 700;">
                    <i class="fas fa-calculator me-2"></i>Sistem Poin
                </h5>
            </div>
            <div class="card-body p-4">
                <h6 style="font-weight: 700; color: #003366;">Poin Kemenangan:</h6>
                <ul class="list-unstyled mb-3">
                    <li class="mb-2">
                        <span class="badge bg-danger me-2">100</span>
                        <strong>Turnamen Nasional</strong>
                    </li>
                    <li class="mb-2">
                        <span class="badge bg-warning me-2">50</span>
                        <strong>Turnamen Provinsi</strong>
                    </li>
                    <li class="mb-2">
                        <span class="badge bg-info me-2">25</span>
                        <strong>Turnamen Kabupaten/Kota</strong>
                    </li>
                </ul>

                <h6 style="font-weight: 700; color: #003366;">Poin Kekalahan:</h6>
                <p class="text-muted mb-0">30% dari poin kemenangan pada tingkat yang sama</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-header border-0" style="background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 25px 25px 0 0;">
                <h5 class="mb-0 text-white" style="font-weight: 700;">
                    <i class="fas fa-info-circle me-2"></i>Cara Kerja Ranking
                </h5>
            </div>
            <div class="card-body p-4">
                <ol class="list-unstyled">
                    <li class="mb-2">
                        <span class="badge bg-primary me-2">1</span>
                        Sistem mengambil hasil pertandingan bulan ini
                    </li>
                    <li class="mb-2">
                        <span class="badge bg-primary me-2">2</span>
                        Menghitung poin berdasarkan tingkat turnamen
                    </li>
                    <li class="mb-2">
                        <span class="badge bg-primary me-2">3</span>
                        Mengurutkan atlet berdasarkan total poin
                    </li>
                    <li class="mb-2">
                        <span class="badge bg-primary me-2">4</span>
                        Update ranking otomatis setiap bulan
                    </li>
                </ol>

                <div class="alert alert-info mt-3" style="border-radius: 15px;">
                    <strong>Tips:</strong> Klik "Update Ranking" untuk memperbarui data terbaru
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .table tbody tr:hover {
        background-color: rgba(30, 144, 255, 0.05);
    }
</style>
<?= $this->endSection() ?>