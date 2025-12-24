<?= $this->extend('user/atlet/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-id-card me-2'></i>Kartu Atlet
                            </h3>
                            <p class="text-muted mb-0">
                                Kartu identitas resmi atlet PTMSI
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/atlet/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Atlet -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <!-- Header Kartu -->
                <div class="card-header bg-primary bg-gradient border-0 p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="text-center text-white">
                        <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI" style="width: 60px; height: 60px; margin-bottom: 1rem;">
                        <h5 class="mb-1">KARTU ATLET</h5>
                        <small>PTMSI Sumatera Barat</small>
                    </div>
                </div>

                <!-- Body Kartu -->
                <div class="card-body p-5">
                    <!-- Foto Atlet -->
                    <div class="text-center mb-4">
                        <div style="width: 120px; height: 150px; background: #f0f0f0; border-radius: 8px; margin: 0 auto; display: flex; align-items: center; justify-content: center; border: 2px solid #e0e0e0;">
                            <i class='bx bx-user' style="font-size: 3rem; color: #999;"></i>
                        </div>
                    </div>

                    <!-- Data Atlet -->
                    <div class="mb-4">
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">NAMA LENGKAP</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= esc($atlet['nama_lengkap'] ?? '-') ?>
                            </h6>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">ID ATLET</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= esc($atlet['id_atlet'] ?? '-') ?>
                            </h6>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">KLUB</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= esc($atlet['nama_klub'] ?? 'Belum ada') ?>
                            </h6>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">KATEGORI USIA</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= esc($atlet['kategori_usia'] ?? '-') ?>
                            </h6>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">JENIS KELAMIN</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= $atlet['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                            </h6>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">TANGGAL LAHIR</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= isset($atlet['tanggal_lahir']) ? date('d/m/Y', strtotime($atlet['tanggal_lahir'])) : '-' ?>
                            </h6>
                        </div>

                        <div>
                            <small class="text-muted d-block mb-1">BERLAKU HINGGA</small>
                            <h6 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <?= date('d/m/Y', strtotime('+1 year')) ?>
                            </h6>
                        </div>
                    </div>

                    <!-- Garis Pemisah -->
                    <hr class="my-4">

                    <!-- Footer Kartu -->
                    <div class="text-center">
                        <small class="text-muted d-block mb-2">Kartu ini berlaku sebagai identitas resmi atlet</small>
                        <small class="text-muted d-block">Dikeluarkan oleh PTMSI Sumatera Barat</small>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="row g-2 mt-4">
                <div class="col-6">
                    <button type="button" class="btn btn-primary w-100" onclick="printKartu()">
                        <i class='bx bx-printer me-2'></i>Cetak
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-outline-secondary w-100" onclick="downloadKartu()">
                        <i class='bx bx-download me-2'></i>Unduh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Info -->
    <div class="row mt-5">
        <div class="col-lg-6 mx-auto">
            <div class="alert alert-info border-0" role="alert">
                <i class='bx bx-info-circle me-2'></i>
                <strong>Informasi:</strong> Kartu atlet ini adalah identitas resmi Anda sebagai atlet terdaftar di PTMSI Sumatera Barat. Gunakan kartu ini saat mengikuti turnamen atau acara resmi.
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%) !important;
    }

    @media print {
        body {
            background: white;
        }

        .btn,
        .alert,
        .row:last-child {
            display: none;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>

<script>
    function printKartu() {
        window.print();
    }

    function downloadKartu() {
        alert('Fitur unduh akan segera tersedia. Gunakan tombol Cetak untuk menyimpan sebagai PDF.');
    }
</script>
<?= $this->endSection() ?>