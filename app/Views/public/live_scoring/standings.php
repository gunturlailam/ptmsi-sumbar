<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-primary mb-2">
                        <i class='bx bx-bar-chart me-2'></i><?= esc($event['nama_event']) ?> - Standings
                    </h2>
                    <p class="text-muted mb-0">Peringkat peserta berdasarkan poin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Standings Table -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($standings)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-bar-chart display-4 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada data</h5>
                        <p class="text-muted">Standings akan ditampilkan setelah ada hasil pertandingan</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Atlet</th>
                                    <th>Klub</th>
                                    <th>Menang</th>
                                    <th>Kalah</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($standings as $stand): ?>
                                    <tr>
                                        <td>
                                            <strong>
                                                <?php if ($no == 1): ?>
                                                    <span class="badge bg-warning text-dark">🥇</span>
                                                <?php elseif ($no == 2): ?>
                                                    <span class="badge bg-secondary">🥈</span>
                                                <?php elseif ($no == 3): ?>
                                                    <span class="badge bg-danger">🥉</span>
                                                <?php else: ?>
                                                    <?= $no ?>
                                                <?php endif; ?>
                                            </strong>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('live-scoring/atlet/' . $stand['id_atlet']) ?>" class="text-decoration-none">
                                                <?= esc($stand['nama_lengkap']) ?>
                                            </a>
                                        </td>
                                        <td><?= esc($stand['nama_klub'] ?? '-') ?></td>
                                        <td><span class="badge bg-success"><?= $stand['menang'] ?></span></td>
                                        <td><span class="badge bg-danger"><?= $stand['kalah'] ?></span></td>
                                        <td><strong><?= $stand['poin'] ?? 0 ?></strong></td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>