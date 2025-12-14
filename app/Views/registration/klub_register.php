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

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            font-weight: bold;
        }

        .step.active {
            background: #1E90FF;
            color: white;
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
                            <h2><i class="bi bi-people-fill"></i> Daftar Klub Tenis Meja</h2>
                            <p class="mb-0">Bergabunglah dengan PTMSI Sumatera Barat</p>
                        </div>

                        <div class="p-4">
                            <!-- Step Indicator -->
                            <div class="step-indicator">
                                <div class="step active">1</div>
                                <div class="step">2</div>
                                <div class="step">3</div>
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

                            <form action="<?= base_url('registration/klub-register') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <!-- Step 1: Informasi Klub -->
                                <div class="step-content" id="step1">
                                    <h5 class="mb-4"><i class="bi bi-building"></i> Informasi Klub</h5>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_klub" class="form-label">Nama Klub <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama_klub" name="nama_klub"
                                                value="<?= old('nama_klub') ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="id_organisasi" class="form-label">Organisasi <span class="text-danger">*</span></label>
                                            <select class="form-select" id="id_organisasi" name="id_organisasi" required>
                                                <option value="">Pilih Organisasi</option>
                                                <?php foreach ($organisasi as $org): ?>
                                                    <option value="<?= $org['id_organisasi'] ?>" <?= old('id_organisasi') == $org['id_organisasi'] ? 'selected' : '' ?>>
                                                        <?= esc($org['nama_organisasi']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                                value="<?= old('penanggung_jawab') ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="telepon" name="telepon"
                                                value="<?= old('telepon') ?>" required>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                            Selanjutnya <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 2: Akun Login -->
                                <div class="step-content d-none" id="step2">
                                    <h5 class="mb-4"><i class="bi bi-person-circle"></i> Akun Login</h5>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="<?= old('email') ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="<?= old('username') ?>" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <small class="text-muted">Minimal 8 karakter</small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password_confirm" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
                                            <i class="bi bi-arrow-left"></i> Sebelumnya
                                        </button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                            Selanjutnya <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 3: Upload Dokumen -->
                                <div class="step-content d-none" id="step3">
                                    <h5 class="mb-4"><i class="bi bi-file-earmark-arrow-up"></i> Upload Dokumen</h5>

                                    <div class="mb-4">
                                        <label for="sk_klub" class="form-label">SK Klub <span class="text-danger">*</span></label>
                                        <div class="upload-area">
                                            <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                            <p class="mt-2">Klik untuk upload SK Klub</p>
                                            <input type="file" class="form-control" id="sk_klub" name="sk_klub"
                                                accept=".pdf,.jpg,.jpeg,.png" required>
                                            <small class="text-muted">Format: PDF, JPG, PNG. Maksimal 5MB</small>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="identitas_pengurus" class="form-label">Identitas Pengurus <span class="text-danger">*</span></label>
                                        <div class="upload-area">
                                            <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                            <p class="mt-2">Klik untuk upload Identitas Pengurus</p>
                                            <input type="file" class="form-control" id="identitas_pengurus" name="identitas_pengurus"
                                                accept=".pdf,.jpg,.jpeg,.png" required>
                                            <small class="text-muted">Format: PDF, JPG, PNG. Maksimal 5MB</small>
                                        </div>
                                    </div>

                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle"></i>
                                        <strong>Proses Verifikasi:</strong><br>
                                        1. Data akan diperiksa oleh Admin Provinsi<br>
                                        2. Jika lengkap, klub akan diaktifkan<br>
                                        3. Anda akan menerima notifikasi via email
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                                            <i class="bi bi-arrow-left"></i> Sebelumnya
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i> Daftar Klub
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <p>Sudah punya akun? <a href="<?= base_url('auth/login') ?>" class="text-decoration-none">Login di sini</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function nextStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('d-none'));
            document.querySelectorAll('.step').forEach(el => el.classList.remove('active'));

            // Show target step
            document.getElementById('step' + step).classList.remove('d-none');
            document.querySelectorAll('.step')[step - 1].classList.add('active');
        }

        function prevStep(step) {
            nextStep(step);
        }

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
    </script>
</body>

</html>