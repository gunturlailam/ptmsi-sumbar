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
                                <i class="fas fa-clipboard-list me-3"></i>Form Pendaftaran Turnamen
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                <?= esc($turnamen['nama_event'] ?? $turnamen['judul']) ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('tournament/detail/' . $turnamen['id_event']) ?>" class="btn btn-outline-secondary px-4 py-2"
                                style="border-radius: 20px; font-weight: 600;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="<?= base_url('tournament/proses-pendaftaran/' . $turnamen['id_event']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">
            <!-- Form Pendaftaran -->
            <div class="col-lg-8 mb-4">
                <!-- Informasi Turnamen -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-info-circle me-2"></i>Informasi Turnamen
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-box p-3" style="background: #f8f9fa; border-radius: 15px;">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="fas fa-calendar me-2"></i>Tanggal Pelaksanaan
                                    </h6>
                                    <p class="mb-0"><?= date('d F Y', strtotime($turnamen['tanggal_mulai'])) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-box p-3" style="background: #f8f9fa; border-radius: 15px;">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="fas fa-money-bill me-2"></i>Biaya Pendaftaran
                                    </h6>
                                    <p class="mb-0 fw-bold text-success">
                                        <?php if ($turnamen['biaya_pendaftaran'] > 0): ?>
                                            Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?>
                                        <?php else: ?>
                                            Gratis
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pilihan Atlet (untuk Klub) -->
                <?php if (session()->get('role') === 'klub' || session()->get('role') === 'admin_klub'): ?>
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                        <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                            <h5 class="mb-0 text-white" style="font-weight: 700;">
                                <i class="fas fa-users me-2"></i>Pilih Atlet yang Akan Bertanding
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <?php if (!empty($atlet_klub)): ?>
                                <div class="alert alert-info" style="border-radius: 15px;">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Pilih atlet dari klub Anda yang akan mengikuti turnamen ini. Pastikan atlet memenuhi kriteria kategori.
                                </div>

                                <div class="row">
                                    <?php foreach ($atlet_klub as $atlet): ?>
                                        <div class="col-md-6 mb-3">
                                            <div class="atlet-card p-3" style="border: 2px solid #e9ecef; border-radius: 15px; transition: all 0.3s;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="atlet_terpilih[]"
                                                        value="<?= $atlet['id_atlet'] ?>" id="atlet_<?= $atlet['id_atlet'] ?>">
                                                    <label class="form-check-label w-100" for="atlet_<?= $atlet['id_atlet'] ?>">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1 fw-bold"><?= esc($atlet['nama_lengkap']) ?></h6>
                                                                <small class="text-muted">
                                                                    <?= $atlet['jenis_kelamin'] === 'L' ? 'Putra' : 'Putri' ?> •
                                                                    <?php
                                                                    $umur = date_diff(date_create($atlet['tanggal_lahir']), date_create('today'))->y;
                                                                    echo $umur . ' tahun';
                                                                    ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning text-center" style="border-radius: 15px;">
                                    <i class="fas fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 10px;"></i>
                                    <h6>Tidak Ada Atlet Terdaftar</h6>
                                    <p class="mb-0">Klub Anda belum memiliki atlet yang terdaftar. Silakan daftarkan atlet terlebih dahulu.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Bukti Pembayaran -->
                <?php if ($turnamen['biaya_pendaftaran'] > 0): ?>
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                        <div class="card-header border-0" style="background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 25px 25px 0 0;">
                            <h5 class="mb-0 text-white" style="font-weight: 700;">
                                <i class="fas fa-receipt me-2"></i>Bukti Pembayaran
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-info" style="border-radius: 15px;">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-bank me-2"></i>Informasi Pembayaran
                                </h6>
                                <p class="mb-2">Transfer ke rekening berikut:</p>
                                <div class="bg-light p-3 rounded">
                                    <strong>Bank BRI</strong><br>
                                    No. Rekening: <strong>1234-5678-9012-3456</strong><br>
                                    Atas Nama: <strong>PTMSI Sumatera Barat</strong><br>
                                    Jumlah: <strong>Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?></strong>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="bukti_pembayaran" class="form-label fw-bold">
                                    <i class="fas fa-upload me-2"></i>Upload Bukti Transfer <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                                    accept="image/*,.pdf" required style="border-radius: 15px; padding: 12px;">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Format yang diterima: JPG, PNG, PDF. Maksimal 2MB.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan_pembayaran" class="form-label fw-bold">
                                    <i class="fas fa-comment me-2"></i>Keterangan Pembayaran (Opsional)
                                </label>
                                <textarea class="form-control" id="keterangan_pembayaran" name="keterangan_pembayaran"
                                    rows="3" placeholder="Contoh: Transfer dari rekening atas nama John Doe"
                                    style="border-radius: 15px;"></textarea>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Informasi Tambahan -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-header border-0" style="background: linear-gradient(45deg, #6f42c1, #5a32a3); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-edit me-2"></i>Informasi Tambahan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label fw-bold">
                                <i class="fas fa-phone me-2"></i>Nomor Telepon/WhatsApp <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                placeholder="Contoh: 08123456789" required style="border-radius: 15px; padding: 12px;">
                        </div>

                        <div class="mb-3">
                            <label for="email_kontak" class="form-label fw-bold">
                                <i class="fas fa-envelope me-2"></i>Email Kontak <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="email_kontak" name="email_kontak"
                                placeholder="Contoh: email@example.com" required style="border-radius: 15px; padding: 12px;">
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label fw-bold">
                                <i class="fas fa-sticky-note me-2"></i>Catatan Khusus (Opsional)
                            </label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                placeholder="Catatan atau permintaan khusus untuk panitia..."
                                style="border-radius: 15px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Ringkasan -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-lg sticky-top" style="border-radius: 25px; background: rgba(255,255,255,0.95); top: 20px;">
                    <div class="card-header border-0 text-center" style="background: linear-gradient(45dc3545, #c82333); border-radius: 25px 25px 0 0;">
                        <h5 class="mb-0 text-white" style="font-weight: 700;">
                            <i class="fas fa-clipboard-check me-2"></i>Ringkasan Pendaftaran
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Ringkasan Turnamen -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-trophy me-2"></i>Detail Turnamen
                            </h6>
                            <div class="summary-item mb-2">
                                <small class="text-muted">Nama Turnamen:</small>
                                <div class="fw-bold"><?= esc($turnamen['nama_event'] ?? $turnamen['judul']) ?></div>
                            </div>
                            <div class="summary-item mb-2">
                                <small class="text-muted">Tanggal:</small>
                                <div class="fw-bold"><?= date('d F Y', strtotime($turnamen['tanggal_mulai'])) ?></div>
                            </div>
                            <div class="summary-item mb-2">
                                <small class="text-muted">Biaya:</small>
                                <div class="fw-bold text-success">
                                    <?php if ($turnamen['biaya_pendaftaran'] > 0): ?>
                                        Rp <?= number_format($turnamen['biaya_pendaftaran'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        Gratis
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Syarat dan Ketentuan -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>Syarat & Ketentuan
                            </h6>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="setuju_syarat" name="setuju_syarat" required>
                                <label class="form-check-label small" for="setuju_syarat">
                                    Saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#syaratModal">syarat dan ketentuan</a> yang berlaku
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="data_benar" name="data_benar" required>
                                <label class="form-check-label small" for="data_benar">
                                    Saya menjamin bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan
                                </label>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-lg w-100 mb-3" id="btnSubmit"
                            style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border: none; border-radius: 20px; font-weight: 700;">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                        </button>

                        <div class="alert alert-warning small" style="border-radius: 15px;">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Perhatian:</strong> Setelah mengirim pendaftaran, data tidak dapat diubah. Pastikan semua informasi sudah benar.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Syarat dan Ketentuan -->
<div class="modal fade" id="syaratModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-file-contract me-2"></i>Syarat dan Ketentuan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6 class="fw-bold text-primary">1. Persyaratan Peserta</h6>
                <ul class="mb-3">
                    <li>Peserta harus terdaftar sebagai anggota PTMSI</li>
                    <li>Memiliki kartu identitas yang masih berlaku</li>
                    <li>Sehat jasmani dan rohani</li>
                </ul>

                <h6 class="fw-bold text-primary">2. Pembayaran</h6>
                <ul class="mb-3">
                    <li>Biaya pendaftaran tidak dapat dikembalikan</li>
                    <li>Pembayaran harus dilakukan sebelum batas waktu</li>
                    <li>Bukti pembayaran harus valid dan jelas</li>
                </ul>

                <h6 class="fw-bold text-primary">3. Ketentuan Pertandingan</h6>
                <ul class="mb-3">
                    <li>Mengikuti peraturan ITTF yang berlaku</li>
                    <li>Keputusan wasit tidak dapat diganggu gugat</li>
                    <li>Peserta wajib hadir tepat waktu</li>
                </ul>

                <h6 class="fw-bold text-primary">4. Lain-lain</h6>
                <ul class="mb-0">
                    <li>Panitia berhak mengubah jadwal jika diperlukan</li>
                    <li>Peserta bertanggung jawab atas keamanan barang pribadi</li>
                    <li>Kerusakan fasilitas menjadi tanggung jawab peserta</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .atlet-card:hover {
        border-color: #1E90FF !important;
        background: #f8f9fa;
    }

    .form-check-input:checked~.form-check-label .atlet-card {
        border-color: #28a745 !important;
        background: #e8f5e9;
    }

    .summary-item {
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .info-box {
        transition: all 0.3s ease;
    }

    .info-box:hover {
        background: #e9ecef !important;
        transform: translateY(-2px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi form
        const form = document.querySelector('form');
        const btnSubmit = document.getElementById('btnSubmit');

        form.addEventListener('submit', function(e) {
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
            btnSubmit.disabled = true;
        });

        // Preview file upload
        const fileInput = document.getElementById('bukti_pembayaran');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.value = '';
                    }
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>