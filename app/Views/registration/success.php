<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .success-container {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .success-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 3rem;
            max-width: 600px;
        }

        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #003366, #1E90FF);
            border: none;
            border-radius: 20px;
            padding: 0.75rem 2rem;
            font-weight: 700;
        }

        .btn-outline-primary {
            border: 2px solid #1E90FF;
            color: #1E90FF;
            border-radius: 20px;
            padding: 0.75rem 2rem;
            font-weight: 700;
        }

        .btn-outline-primary:hover {
            background: #1E90FF;
            border-color: #1E90FF;
        }

        .process-steps {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }

        .step-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .step-number {
            background: #1E90FF;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1rem;
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="success-card">
                        <i class="bi bi-check-circle-fill success-icon"></i>

                        <h2 class="mb-3">Pendaftaran Berhasil!</h2>

                        <?php if (session()->getFlashdata('success')): ?>
                            <p class="lead text-muted mb-4">
                                <?= session()->getFlashdata('success') ?>
                            </p>
                        <?php else: ?>
                            <p class="lead text-muted mb-4">
                                Terima kasih telah mendaftar. Data Anda telah berhasil disimpan dan akan segera diproses.
                            </p>
                        <?php endif; ?>

                        <div class="process-steps">
                            <h5 class="mb-3"><i class="bi bi-list-check"></i> Langkah Selanjutnya:</h5>

                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div>
                                    <strong>Verifikasi Data</strong><br>
                                    <small class="text-muted">Tim kami akan memverifikasi data dan dokumen yang Anda kirimkan</small>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div>
                                    <strong>Notifikasi Email</strong><br>
                                    <small class="text-muted">Anda akan menerima email konfirmasi status verifikasi</small>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div>
                                    <strong>Aktivasi Akun</strong><br>
                                    <small class="text-muted">Setelah disetujui, akun Anda akan diaktifkan dan dapat digunakan</small>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Penting:</strong> Proses verifikasi membutuhkan waktu 1-3 hari kerja.
                            Pastikan email yang Anda daftarkan aktif untuk menerima notifikasi.
                        </div>

                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="<?= base_url('/') ?>" class="btn btn-primary">
                                <i class="bi bi-house"></i> Kembali ke Beranda
                            </a>
                            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted mb-0">
                                <small>
                                    Butuh bantuan? Hubungi kami di
                                    <a href="<?= base_url('hubungi-kami') ?>" class="text-decoration-none">halaman kontak</a>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>