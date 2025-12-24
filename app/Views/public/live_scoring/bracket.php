<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-primary mb-2">
                        <i class='bx bx-git-branch me-2'></i><?= esc($event['nama_event']) ?> - Bracket
                    </h2>
                    <p class="text-muted mb-0">Struktur pertandingan turnamen</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bracket -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($bracket)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-git-branch display-4 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Bracket belum tersedia</h5>
                        <p class="text-muted">Bracket akan ditampilkan setelah turnamen dimulai</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="bracket-container" style="overflow-x: auto;">
                            <div style="display: flex; gap: 2rem; padding: 1rem;">
                                <?php
                                $currentRound = null;
                                $roundGroups = [];

                                foreach ($bracket as $match) {
                                    if ($match['round'] != $currentRound) {
                                        $currentRound = $match['round'];
                                        $roundGroups[$currentRound] = [];
                                    }
                                    $roundGroups[$currentRound][] = $match;
                                }

                                foreach ($roundGroups as $round => $matches):
                                ?>
                                    <div style="min-width: 250px;">
                                        <h6 class="text-center mb-3 text-primary">
                                            <strong><?= ucfirst($round) ?></strong>
                                        </h6>
                                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                                            <?php foreach ($matches as $match): ?>
                                                <div class="card border-1" style="border-color: #e2e8f0;">
                                                    <div class="card-body p-2">
                                                        <div class="mb-2">
                                                            <small class="text-muted">Match <?= $match['match_number'] ?></small>
                                                        </div>
                                                        <div class="mb-2">
                                                            <small><?= esc($match['atlet_1'] ?? 'TBD') ?></small>
                                                        </div>
                                                        <div class="text-center my-1">
                                                            <small class="text-muted">vs</small>
                                                        </div>
                                                        <div>
                                                            <small><?= esc($match['atlet_2'] ?? 'TBD') ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>