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
                                <i class='bx bx-user-circle me-2'></i><?= esc($atlet['nama_lengkap']) ?>
                            </h2>
                            <p class="text-muted mb-0">
                                <i class='bx bx-building me-1'></i><?= esc($atlet['nama_klub'] ?? 'Klub -') ?>
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

    <!-- Profile Info -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informasi Atlet</h5>
                    <div class="mb-3">
                        <small class="text-muted">Email</small>
                        <p class="mb-0"><?= esc($atlet['email']) ?></p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Kategori Usia</small>
                        <p class="mb-0"><?= esc($atlet['kategori_usia'] ?? '-') ?></p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Jenis Kelamin</small>
                        <p class="mb-0">
                            <?= $atlet['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                        </p>
                    </div>
                    <?php if ($ranking): ?>
                        <div class="mb-3">
                            <small class="text-muted">Ranking</small>
                            <p class="mb-0">
                                <span class="badge bg-primary">#<?= $ranking['posisi'] ?></span>
                                <strong><?= $ranking['poin'] ?> poin</strong>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Rating Summary -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-4">Rating Atlet</h5>

                    <!-- Average Rating -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="display-4 fw-bold text-warning mb-2">
                                    <?= number_format($avg_rating['rata_rata'], 1) ?>
                                </div>
                                <div class="mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class='bx bxs-star <?= $i <= round($avg_rating['rata_rata']) ? 'text-warning' : 'text-muted' ?>'></i>
                                    <?php endfor; ?>
                                </div>
                                <small class="text-muted">
                                    Berdasarkan <?= $avg_rating['total_rating'] ?> rating
                                </small>
                            </div>
                        </div>

                        <!-- Rating by Category -->
                        <div class="col-md-6">
                            <?php if (!empty($rating_by_category)): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($rating_by_category as $cat): ?>
                                        <div class="list-group-item border-0 px-0 py-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small><?= ucfirst($cat['kategori']) ?></small>
                                                <div>
                                                    <small class="text-muted me-2">
                                                        <?= number_format($cat['rata_rata'], 1) ?>/5
                                                    </small>
                                                    <small class="text-muted">
                                                        (<?= $cat['total'] ?>)
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-warning" style="width: <?= ($cat['rata_rata'] / 5) * 100 ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted text-center">Belum ada rating</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Rating Form -->
                    <?php if (session()->get('logged_in')): ?>
                        <hr>
                        <h6 class="mb-3">Berikan Rating</h6>
                        <form id="ratingForm">
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="teknik">Teknik</option>
                                    <option value="kecepatan">Kecepatan</option>
                                    <option value="ketahanan">Ketahanan</option>
                                    <option value="mental">Mental</option>
                                    <option value="sportivitas">Sportivitas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rating (1-5)</label>
                                <div class="rating-input">
                                    <input type="hidden" name="rating" id="ratingValue" value="0">
                                    <div class="d-flex gap-2">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <button type="button" class="btn btn-outline-warning rating-btn" data-rating="<?= $i ?>">
                                                <i class='bx bxs-star'></i>
                                            </button>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Komentar (Opsional)</label>
                                <textarea class="form-control" name="komentar" rows="3" placeholder="Berikan komentar Anda..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-send me-2'></i>Kirim Rating
                            </button>
                        </form>
                    <?php else: ?>
                        <hr>
                        <p class="text-muted text-center">
                            <a href="<?= base_url('auth/login') ?>">Login</a> untuk memberikan rating
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Ratings -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">Rating Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($ratings)): ?>
                        <div class="p-4 text-center text-muted">
                            Belum ada rating
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($ratings as $rating): ?>
                                <div class="list-group-item px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">
                                                <?= esc($rating['nama_lengkap'] ?? 'Anonim') ?>
                                                <span class="badge bg-<?= $rating['rating'] >= 4 ? 'success' : ($rating['rating'] >= 3 ? 'warning' : 'danger') ?>">
                                                    <?= $rating['rating'] ?>/5
                                                </span>
                                            </h6>
                                            <small class="text-muted">
                                                <?= ucfirst($rating['kategori']) ?> -
                                                <?= date('d/m/Y H:i', strtotime($rating['dibuat_pada'])) ?>
                                            </small>
                                            <?php if ($rating['komentar']): ?>
                                                <p class="mb-0 mt-2">
                                                    <em><?= esc($rating['komentar']) ?></em>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.rating-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const rating = this.dataset.rating;
            document.getElementById('ratingValue').value = rating;

            document.querySelectorAll('.rating-btn').forEach(b => {
                b.classList.remove('btn-warning');
                b.classList.add('btn-outline-warning');
            });

            for (let i = 0; i < rating; i++) {
                document.querySelectorAll('.rating-btn')[i].classList.remove('btn-outline-warning');
                document.querySelectorAll('.rating-btn')[i].classList.add('btn-warning');
            }
        });
    });

    document.getElementById('ratingForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('id_atlet', '<?= $atlet['id_atlet'] ?>');

        fetch('<?= base_url('live-scoring/atlet/rate') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
    });
</script>
<?= $this->endSection() ?>