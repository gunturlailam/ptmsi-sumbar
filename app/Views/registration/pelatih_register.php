<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .registration-container {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .registration-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .registration-header {
            background: linear-gradient(135deg, #003366, #1E90FF);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .form-control,
        .form-select {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #003366, #1E90FF);
            border: none;
            border-radius: 20px;
            padding: 0.75rem 2rem;
            font-weight: 700;
        }

        .btn-secondary {
            border-radius: 20px;
            padding: 0.75rem 2rem;
        }

        .upload-area {
            border: 2px dashed #1E90FF;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            background: #f8f9fa;
        }

        .klub-info {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="registration-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="registration-card">
                        <div class="registration-header">
                            <h2><i class="bi bi-person-workspace"></i> Daftar Pelatih/Wasit Baru</h2>
                            <p class="mb-0">Klub: <?= esc($klub['nama']) ?></p>
                        </div>

                        <div class="p-4">
                            <!-- Klub Info -->
                            <div class="klub-info">
                                <h6><i class="bi bi-building"></i> Informasi Klub</h6>
                                <p class="mb-1"><strong>Nama Klub:</strong> <?= esc($klub['nama']) ?></p>
                                <p class="mb-1"><strong>Penanggung Jawab:</strong> <?= esc($klub['penanggung_jawab']) ?></p>
                                <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success">Aktif</span></p>
                            </div>

                            <!-- Flash Messages -->
                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('registration/pelatih-register') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <h5 class="mb-4"><i class="bi bi-person-circle"></i> Data Pelatih/Wasit</h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            value="<?= old('nama_lengkap') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="<?= old('nik') ?>" maxlength="16" required>
                                        <small class="text-muted">16 digit NIK sesuai KTP</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            value="<?= old('tempat_lahir') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="<?= old('tanggal_lahir') ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_pelatih" class="form-label">Jenis <span class="text-danger">*</span></label>
                                        <select class="form-select" id="jenis_pelatih" name="jenis_pelatih" required>
                                            <option value="">Pilih Jenis</option>
                                            <option value="pelatih" <?= old('jenis_pelatih') == 'pelatih' ? 'selected' : '' ?>>Pelatih</option>
                                            <option value="wasit" <?= old('jenis_pelatih') == 'wasit' ? 'selected' : '' ?>>Wasit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                            value="<?= old('no_hp') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="<?= old('email') ?>" required>
                                    </div>
                                </div>

                                <h5 class="mb-4 mt-4"><i class="bi bi-file-earmark-arrow-up"></i> Upload Dokumen</h5>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="foto_pelatih" class="form-label">Foto Pelatih/Wasit <span class="text-danger">*</span></label>
                                        <div class="upload-area">
                                            <i class="bi bi-camera fs-1 text-primary"></i>
                                            <p class="mt-2">Klik untuk upload foto</p>
                                            <input type="file" class="form-control" id="foto_pelatih" name="foto_pelatih"
                                                accept=".jpg,.jpeg,.png" required>
                                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="sertifikat" class="form-label">Sertifikat Pelatih/Wasit <span class="text-danger">*</span></label>
                                        <div class="upload-area">
                                            <i class="bi bi-award fs-1 text-primary"></i>
                                            <p class="mt-2">Klik untuk upload sertifikat</p>
                                            <input type="file" class="form-control" id="sertifikat" name="sertifikat"
                                                accept=".jpg,.jpeg,.png,.pdf" required>
                                            <small class="text-muted">Format: JPG, PNG, PDF. Maksimal 5MB</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Proses Verifikasi:</strong><br>
                                    1. Data akan langsung dikirim ke Admin Provinsi<br>
                                    2. Admin Provinsi akan memverifikasi sertifikat dan data<br>
                                    3. Jika valid, pelatih/wasit akan diaktifkan<br>
                                    4. Anda akan menerima notifikasi via email
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('user/dashboard') ?>" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i> Daftar Pelatih/Wasit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // File upload preview
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    const uploadArea = this.closest('.upload-area');
                    uploadArea.querySelector('p').textContent = fileName;
                    uploadArea.style.borderColor = '#28a745';
                    uploadArea.style.backgroundColor = '#d4edda';
                }
            });
        });

        // NIK validation
        document.getElementById('nik').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>

</html>