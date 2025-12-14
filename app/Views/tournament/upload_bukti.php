<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-header border-0 text-center" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                    <h3 class="mb-0 text-white" style="font-weight: 900;">
                        <i class="fas fa-upload me-3"></i>Upload Bukti Pembayaran
                    </h3>
                    <p class="mb-0 text-white opacity-75">Turnamen: <?= esc($turnamen['nama_event'] ?? $turnamen['judul']) ?></p>
                </div>
                <div class="card-body p-5">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" style="border-radius: 15px;">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" style="border-radius: 15px;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger" style="border-radius: 15px;">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Informasi Pembayaran -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card p-4" style="background: #f8f9fa; border-radius: 20px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 15px;">
                                    <i class="fas fa-info-circle me-2"></i>Detail Pembayaran
                                </h6>
                                <div class="mb-2">
                                    <strong>Biaya Pendaftaran:</strong>
                                    <span class="text-primary" style="font-weight: 700; font-size: 1.1rem;">
                                        Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?>
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <strong>Status:</strong>
                                    <span class="badge bg-warning">Menunggu Pembayaran</span>
                                </div>
                                <div class="mb-0">
                                    <strong>Tanggal Daftar:</strong>
                                    <?= date('d F Y H:i', strtotime($pendaftaran['tanggal_daftar'])) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-4" style="background: #e3f2fd; border-radius: 20px;">
                                <h6 style="font-weight: 700; color: #003366; margin-bottom: 15px;">
                                    <i class="fas fa-university me-2"></i>Rekening Pembayaran
                                </h6>
                                <div class="mb-2">
                                    <strong>Bank:</strong> BNI
                                </div>
                                <div class="mb-2">
                                    <strong>No. Rekening:</strong> 1234567890
                                </div>
                                <div class="mb-2">
                                    <strong>Atas Nama:</strong> PTMSI Sumatera Barat
                                </div>
                                <div class="alert alert-info mt-3 mb-0" style="border-radius: 10px;">
                                    <small><strong>Catatan:</strong> Pastikan nominal transfer sesuai dengan biaya pendaftaran</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Upload -->
                    <form action="<?= base_url('tournament/upload-bukti/' . $pendaftaran['id_pendaftaran']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label for="bukti_pembayaran" class="form-label" style="font-weight: 700; color: #003366;">
                                <i class="fas fa-file-image me-2"></i>Bukti Pembayaran *
                            </label>
                            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                                accept="image/*,.pdf" required
                                style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format yang diterima: JPG, PNG, PDF. Maksimal 2MB.
                            </div>
                        </div>

                        <!-- Preview Area -->
                        <div id="preview-area" class="mb-4" style="display: none;">
                            <label class="form-label" style="font-weight: 700; color: #003366;">
                                <i class="fas fa-eye me-2"></i>Preview
                            </label>
                            <div class="preview-container p-3" style="background: #f8f9fa; border-radius: 15px; text-align: center;">
                                <img id="image-preview" src="" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 10px; display: none;">
                                <div id="file-info" style="display: none;">
                                    <i class="fas fa-file-pdf" style="font-size: 3rem; color: #dc3545; margin-bottom: 10px;"></i>
                                    <p class="mb-0" style="font-weight: 600;"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Tambahan -->
                        <div class="mb-4">
                            <label for="catatan" class="form-label" style="font-weight: 700; color: #003366;">
                                <i class="fas fa-sticky-note me-2"></i>Catatan (Opsional)
                            </label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                style="border-radius: 15px; border: 2px solid #e0e0e0; padding: 12px 20px; font-weight: 500;"
                                placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg px-5 py-3 me-3"
                                style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border: none; border-radius: 20px; font-weight: 700; transition: all 0.4s ease;">
                                <i class="fas fa-upload me-2"></i>Upload Bukti
                            </button>
                            <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>"
                                class="btn btn-outline-secondary btn-lg px-5 py-3"
                                style="border-radius: 20px; font-weight: 700;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>

                    <!-- Informasi Penting -->
                    <div class="mt-5">
                        <div class="alert alert-warning" style="border-radius: 15px;">
                            <h6 style="font-weight: 700; color: #856404;">
                                <i class="fas fa-exclamation-triangle me-2"></i>Penting!
                            </h6>
                            <ul class="mb-0">
                                <li>Pastikan bukti pembayaran jelas dan dapat dibaca</li>
                                <li>Nominal transfer harus sesuai dengan biaya pendaftaran</li>
                                <li>Bukti pembayaran akan diverifikasi oleh panitia</li>
                                <li>Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                                <li>Anda akan mendapat notifikasi setelah verifikasi selesai</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewArea = document.getElementById('preview-area');
        const imagePreview = document.getElementById('image-preview');
        const fileInfo = document.getElementById('file-info');

        if (file) {
            previewArea.style.display = 'block';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    fileInfo.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                imagePreview.style.display = 'none';
                fileInfo.style.display = 'block';
                fileInfo.querySelector('p').textContent = file.name;
            }
        } else {
            previewArea.style.display = 'none';
        }
    });
</script>

<style>
    .form-control:focus {
        border-color: #1E90FF !important;
        box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25) !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .info-card {
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
<?= $this->endSection() ?>