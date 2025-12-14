<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0 text-center" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h3 class="mb-0 text-white" style="font-weight: 900;">
                        <i class="fas fa-user-edit me-3"></i>Lengkapi Profil Atlet
                    </h3>
                    <p class="mb-0 text-white opacity-75">Silakan lengkapi data profil Anda untuk mengakses semua fitur</p>
                </div>
                <div class="card-body p-5">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger" style="border-radius: 15px;">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('user/atlet/update-profil') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_lengkap" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap *
                                </label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    value="<?= esc($user['nama_lengkap']) ?>" required
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-calendar me-2"></i>Tanggal Lahir *
                                </label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="<?= esc($atlet['tanggal_lahir'] ?? '') ?>" required
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin *
                                </label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" <?= ($atlet['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= ($atlet['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori_usia" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-layer-group me-2"></i>Kategori Usia *
                                </label>
                                <select class="form-select" id="kategori_usia" name="kategori_usia" required
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;">
                                    <option value="">Pilih Kategori</option>
                                    <option value="U-12" <?= ($atlet['kategori_usia'] ?? '') == 'U-12' ? 'selected' : '' ?>>U-12 (Under 12)</option>
                                    <option value="U-15" <?= ($atlet['kategori_usia'] ?? '') == 'U-15' ? 'selected' : '' ?>>U-15 (Under 15)</option>
                                    <option value="U-18" <?= ($atlet['kategori_usia'] ?? '') == 'U-18' ? 'selected' : '' ?>>U-18 (Under 18)</option>
                                    <option value="Senior" <?= ($atlet['kategori_usia'] ?? '') == 'Senior' ? 'selected' : '' ?>>Senior</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label" style="font-weight: 700; color: #003366;">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap *
                            </label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required
                                style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;"
                                placeholder="Masukkan alamat lengkap..."><?= esc($atlet['alamat'] ?? '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-phone me-2"></i>Nomor HP *
                                </label>
                                <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                    value="<?= esc($atlet['no_hp'] ?? '') ?>" required
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;"
                                    placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="berat_badan" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-weight me-2"></i>Berat Badan (kg)
                                </label>
                                <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                    value="<?= esc($atlet['berat_badan'] ?? '') ?>" step="0.1"
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;"
                                    placeholder="Contoh: 65.5">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tinggi_badan" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-ruler-vertical me-2"></i>Tinggi Badan (cm)
                                </label>
                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                    value="<?= esc($atlet['tinggi_badan'] ?? '') ?>"
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;"
                                    placeholder="Contoh: 170">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto" class="form-label" style="font-weight: 700; color: #003366;">
                                    <i class="fas fa-camera me-2"></i>Foto Profil
                                </label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                                    style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;">
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="riwayat_prestasi" class="form-label" style="font-weight: 700; color: #003366;">
                                <i class="fas fa-trophy me-2"></i>Riwayat Prestasi
                            </label>
                            <textarea class="form-control" id="riwayat_prestasi" name="riwayat_prestasi" rows="4"
                                style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;"
                                placeholder="Tuliskan prestasi yang pernah diraih (opsional)..."><?= esc($atlet['riwayat_prestasi'] ?? '') ?></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg px-5 py-3 me-3"
                                style="background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; border: none; border-radius: 20px; font-weight: 700; transition: all 0.4s ease;">
                                <i class="fas fa-save me-2"></i>Simpan Profil
                            </button>
                            <a href="<?= base_url('user/atlet/dashboard') ?>" class="btn btn-outline-secondary btn-lg px-5 py-3"
                                style="border-radius: 20px; font-weight: 700;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus,
    .form-select:focus {
        border-color: #1E90FF !important;
        box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25) !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
<?= $this->endSection() ?>