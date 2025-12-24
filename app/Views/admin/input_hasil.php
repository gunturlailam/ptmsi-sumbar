<?= $this->extend('layouts/main') ?>

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
                                <i class="fas fa-edit me-3"></i>Input Hasil Pertandingan
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Catat hasil dan scoring pertandingan
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('admin/hasil-pertandingan') ?>" class="btn btn-outline-secondary px-4 py-2"
                                style="border-radius: 20px; font-weight: 600;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="<?= base_url('admin/hasil-pertandingan/simpan/' . $match['id_pertandingan']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8 mb-4">
                <!-- Match Info -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-info-circle me-2"></i>Informasi Pertandingan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Jadwal</small>
                                <div class="fw-bold"><?= date('d/m/Y H:i', strtotime($match['jadwal'])) ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Venue</small>
                                <div class="fw-bold"><?= esc($match['venue']) ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Babak</small>
                                <div class="fw-bold"><?= esc($match['babak']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Atlet & Scoring -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-users me-2"></i>Hasil Pertandingan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Atlet 1 -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= esc($atlet1['nama_lengkap'] ?? 'N/A') ?></h6>
                                    <small class="text-muted">Atlet 1</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="skor_atlet1" class="form-label fw-bold">
                                    <i class="fas fa-trophy me-2"></i>Skor Atlet 1
                                </label>
                                <input type="number" class="form-control" id="skor_atlet1" name="skor_atlet1"
                                    min="0" max="3" required style="border-radius: 15px; padding: 12px; font-size: 1.2rem; text-align: center;">
                            </div>
                        </div>

                        <!-- VS Divider -->
                        <div class="text-center mb-4">
                            <div style="border-top: 2px dashed #ccc; position: relative; padding: 10px 0;">
                                <span class="badge bg-secondary" style="position: relative; top: -15px; background: white; color: #666; border: 2px solid #ccc;">VS</span>
                            </div>
                        </div>

                        <!-- Atlet 2 -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= esc($atlet2['nama_lengkap'] ?? 'N/A') ?></h6>
                                    <small class="text-muted">Atlet 2</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="skor_atlet2" class="form-label fw-bold">
                                    <i class="fas fa-trophy me-2"></i>Skor Atlet 2
                                </label>
                                <input type="number" class="form-control" id="skor_atlet2" name="skor_atlet2"
                                    min="0" max="3" required style="border-radius: 15px; padding: 12px; font-size: 1.2rem; text-align: center;">
                            </div>
                        </div>

                        <!-- Pemenang Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-crown me-2"></i>Pilih Pemenang
                            </label>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pemenang" id="pemenang1" value="1" required>
                                        <label class="form-check-label w-100" for="pemenang1">
                                            <div class="p-3" style="background: #f8f9fa; border-radius: 15px; border: 2px solid transparent; cursor: pointer;">
                                                <i class="fas fa-check-circle me-2 text-success"></i>
                                                <strong><?= esc($atlet1['nama_lengkap'] ?? 'Atlet 1') ?></strong>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pemenang" id="pemenang2" value="2" required>
                                        <label class="form-check-label w-100" for="pemenang2">
                                            <div class="p-3" style="background: #f8f9fa; border-radius: 15px; border: 2px solid transparent; cursor: pointer;">
                                                <i class="fas fa-check-circle me-2 text-success"></i>
                                                <strong><?= esc($atlet2['nama_lengkap'] ?? 'Atlet 2') ?></strong>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-lg" id="btnSubmit"
                        style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border: none; border-radius: 20px; font-weight: 700;">
                        <i class="fas fa-save me-2"></i>Simpan Hasil & Update Ranking
                    </button>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-lg sticky-top" style="border-radius: 25px; background: rgba(255,255,255,0.95); top: 20px;">
                    <div class="card-header border-0" style="background: linear-gradient(45deg, #6f42c1, #5a32a3); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-lightbulb me-2"></i>Informasi Penting
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info" style="border-radius: 15px;">
                            <h6 class="fw-bold mb-2">
                                <i class="fas fa-info-circle me-2"></i>Sistem Poin
                            </h6>
                            <ul class="mb-0" style="font-size: 0.9rem;">
                                <li><strong>Menang:</strong> +10 poin</li>
                                <li><strong>Kalah:</strong> +3 poin</li>
                                <li><strong>Ranking:</strong> Update otomatis</li>
                            </ul>
                        </div>

                        <div class="alert alert-warning" style="border-radius: 15px;">
                            <h6 class="fw-bold mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>Catatan
                            </h6>
                            <p class="mb-0" style="font-size: 0.9rem;">
                                Pastikan skor dan pemenang sudah benar sebelum menyimpan. Data tidak dapat diubah setelah disimpan.
                            </p>
                        </div>

                        <div class="card border-0" style="background: #f8f9fa; border-radius: 15px;">
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-chart-line me-2"></i>Preview Poin
                                </h6>
                                <div class="mb-2">
                                    <small class="text-muted">Atlet 1:</small>
                                    <div class="fw-bold" id="preview_poin_1">-</div>
                                </div>
                                <div>
                                    <small class="text-muted">Atlet 2:</small>
                                    <div class="fw-bold" id="preview_poin_2">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pemenang1 = document.getElementById('pemenang1');
        const pemenang2 = document.getElementById('pemenang2');
        const preview1 = document.getElementById('preview_poin_1');
        const preview2 = document.getElementById('preview_poin_2');

        function updatePreview() {
            if (pemenang1.checked) {
                preview1.textContent = '+10 poin (Menang)';
                preview1.style.color = '#28a745';
                preview2.textContent = '+3 poin (Kalah)';
                preview2.style.color = '#dc3545';
            } else if (pemenang2.checked) {
                preview1.textContent = '+3 poin (Kalah)';
                preview1.style.color = '#dc3545';
                preview2.textContent = '+10 poin (Menang)';
                preview2.style.color = '#28a745';
            }
        }

        pemenang1.addEventListener('change', updatePreview);
        pemenang2.addEventListener('change', updatePreview);

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const skor1 = parseInt(document.getElementById('skor_atlet1').value);
            const skor2 = parseInt(document.getElementById('skor_atlet2').value);

            if (skor1 === skor2) {
                e.preventDefault();
                alert('Skor tidak boleh sama! Harus ada pemenang.');
                return false;
            }

            document.getElementById('btnSubmit').disabled = true;
            document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        });
    });
</script>

<?= $this->endSection() ?>