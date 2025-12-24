<?= $this->extend('user/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #2d3748;">
                                <i class="bx bx-run me-2"></i>Kelola Atlet
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Manajemen atlet klub <?= esc($klub['nama']) ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn btn-success px-4 py-2 me-2"
                                data-bs-toggle="modal" data-bs-target="#tambahAtletModal">
                                <i class="bx bx-plus me-2"></i>Tambah Atlet
                            </button>
                            <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-outline-secondary px-4 py-2">
                                <i class="bx bx-arrow-back me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Box - Password Default -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-1 text-center mb-3 mb-md-0">
                            <i class="bx bx-key" style="font-size: 2rem; color: #667eea;"></i>
                        </div>
                        <div class="col-md-11">
                            <h6 class="mb-2" style="font-weight: 700; color: #2d3748;">
                                Password Default Atlet
                            </h6>
                            <p class="mb-0" style="color: #666; font-size: 0.95rem;">
                                Setiap atlet yang didaftarkan akan mendapatkan akun login otomatis dengan password default: <code style="background: #f0f0f0; padding: 2px 6px; border-radius: 4px; font-weight: 600;">atlet2025</code>
                                <br>
                                <small style="color: #999;">Atlet dapat mengubah password mereka setelah login pertama kali.</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Pending -->
    <div class="card border-0 shadow-lg mb-4">
        <div class="card-header border-0" style="background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 12px 12px 0 0;">
            <h5 class="mb-0 text-white" style="font-weight: 700;">
                <i class="bx bx-time me-2"></i>Pendaftaran Menunggu Verifikasi (<?= count($pendaftaran_pending) ?>)
            </h5>
        </div>
        <div class="card-body p-4">
            <?php if (!empty($pendaftaran_pending)): ?>
                <div class="row">
                    <?php foreach ($pendaftaran_pending as $pendaftaran): ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-circle me-3" style="width: 50px; height: 50px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bx bx-user text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" style="font-weight: 700; color: #003366;">
                                                <?= esc($pendaftaran['nama_lengkap']) ?>
                                            </h6>
                                            <small class="text-muted">
                                                <?= date('d/m/Y', strtotime($pendaftaran['tanggal_daftar'])) ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Usia</small>
                                                <span style="font-weight: 600;"><?= esc($pendaftaran['kategori_usia']) ?></span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Gender</small>
                                                <span style="font-weight: 600;"><?= $pendaftaran['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-info mb-0" style="border-radius: 10px; font-size: 0.875rem;">
                                        <i class="bx bx-info-circle me-1"></i>
                                        <strong>Verifikasi oleh Admin PTMSI</strong>
                                        <br>
                                        <small>Pendaftaran ini akan diverifikasi oleh Admin PTMSI Provinsi. Setelah disetujui, atlet akan menerima email dengan password default: <strong>atlet2025</strong></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="bx bx-inbox" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                    <p class="text-muted mb-0">Tidak ada pendaftaran yang menunggu verifikasi</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Atlet Aktif -->
    <div class="mb-4">
        <h5 class="mb-3" style="font-weight: 700; color: #2d3748;">
            <i class="bx bx-check-circle me-2"></i>Atlet Aktif (<?= count($atlet_aktif) ?>)
        </h5>
        <?php if (!empty($atlet_aktif)): ?>
            <div class="row">
                <?php foreach ($atlet_aktif as $atlet): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow-lg h-100" style="border-radius: 12px; transition: all 0.3s ease;">
                            <div class="card-body p-4 text-center">
                                <!-- Avatar -->
                                <div class="mb-3">
                                    <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                        <i class="bx bx-user text-white" style="font-size: 2.5rem;"></i>
                                    </div>
                                </div>

                                <!-- Nama -->
                                <h6 class="mb-1" style="font-weight: 700; color: #2d3748;">
                                    <?= esc($atlet['nama_lengkap']) ?>
                                </h6>
                                <small class="text-muted d-block mb-3">ID: <?= $atlet['id_atlet'] ?></small>

                                <!-- Info -->
                                <div class="mb-3" style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 1rem 0;">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Kategori</small>
                                            <span style="font-weight: 600; color: #2d3748;"><?= esc($atlet['kategori_usia']) ?></span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Gender</small>
                                            <span style="font-weight: 600; color: #2d3748;"><?= $atlet['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <small class="text-muted d-block mb-3">
                                    <i class="bx bx-envelope me-1"></i><?= esc($atlet['email']) ?>
                                </small>

                                <!-- Aksi -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-sm btn-primary"
                                        onclick="lihatDetailAtlet(<?= $atlet['id_atlet'] ?>)"
                                        style="border-radius: 8px; font-weight: 600;">
                                        <i class="bx bx-show me-1"></i>Lihat Detail
                                    </button>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-warning flex-grow-1"
                                            onclick="editAtlet(<?= $atlet['id_atlet'] ?>)"
                                            style="border-radius: 8px;" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger flex-grow-1"
                                            onclick="nonaktifkanAtlet(<?= $atlet['id_atlet'] ?>)"
                                            style="border-radius: 8px;" title="Nonaktifkan">
                                            <i class="bx bx-user-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4 text-center">
                    <i class="bx bx-user-x" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                    <p class="text-muted mb-0">Belum ada atlet aktif di klub ini</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-check-circle me-2"></i>Verifikasi Pendaftaran Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="verifikasiForm" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" id="pendaftaran_id" name="pendaftaran_id">
                    <input type="hidden" id="action" name="action">

                    <div class="mb-3">
                        <label for="catatan" class="form-label" style="font-weight: 600; color: #003366;">
                            Catatan Verifikasi
                        </label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"
                            style="border-radius: 10px;" placeholder="Berikan catatan untuk keputusan verifikasi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 10px; font-weight: 600;">
                        <i class="bx bx-check me-2"></i>Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Atlet -->
<div class="modal fade" id="tambahAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-user-plus me-2"></i>Tambah Atlet Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('user/klub/tambah-atlet') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label fw-bold">
                                <i class="bx bx-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                required style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">
                                <i class="bx bx-envelope me-2"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                required style="border-radius: 10px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label fw-bold">
                                <i class="bx bx-calendar me-2"></i>Tanggal Lahir <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                required style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label fw-bold">
                                <i class="bx bx-male-female me-2"></i>Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin"
                                required style="border-radius: 10px;">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label fw-bold">
                                <i class="bx bx-phone me-2"></i>No. HP/WhatsApp
                            </label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                placeholder="08xxxxxxxxxx" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kategori_usia" class="form-label fw-bold">
                                <i class="bx bx-cake me-2"></i>Kategori Usia
                            </label>
                            <select class="form-select" id="kategori_usia" name="kategori_usia"
                                style="border-radius: 10px;">
                                <option value="">Otomatis berdasarkan usia</option>
                                <option value="U-12">U-12 (Under 12)</option>
                                <option value="U-15">U-15 (Under 15)</option>
                                <option value="U-18">U-18 (Under 18)</option>
                                <option value="Senior">Senior (18+)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-bold">
                            <i class="bx bx-map me-2"></i>Alamat
                        </label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"
                            style="border-radius: 10px;" placeholder="Alamat lengkap atlet..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label fw-bold">
                            <i class="bx bx-camera me-2"></i>Foto Atlet (Opsional)
                        </label>
                        <input type="file" class="form-control" id="foto" name="foto"
                            accept="image/*" style="border-radius: 10px;">
                        <div class="form-text">
                            <i class="bx bx-info-circle me-1"></i>
                            Format: JPG, PNG. Maksimal 2MB.
                        </div>
                    </div>

                    <div class="alert alert-info" style="border-radius: 10px;">
                        <i class="bx bx-info-circle me-2"></i>
                        <strong>Catatan:</strong> Setelah menambahkan atlet, sistem akan membuat akun login otomatis.
                        Password default akan dikirim ke email atlet.
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                        <i class="bx bx-x me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success" style="border-radius: 10px; font-weight: 600;">
                        <i class="bx bx-plus me-2"></i>Tambah Atlet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Atlet -->
<div class="modal fade" id="editAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-edit me-2"></i>Edit Data Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAtletForm" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4" id="editAtletContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                        <i class="bx bx-x me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning" style="border-radius: 10px; font-weight: 600;">
                        <i class="bx bx-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Atlet -->
<div class="modal fade" id="detailAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-user me-2"></i>Detail Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="detailAtletContent">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Nonaktifkan -->
<div class="modal fade" id="nonaktifkanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 12px 12px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-exclamation-triangle me-2"></i>Konfirmasi Nonaktifkan Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="nonaktifkanForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <i class="bx bx-user-x text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mb-3">
                        Apakah Anda yakin ingin menonaktifkan atlet ini?
                        Atlet yang dinonaktifkan tidak dapat mengikuti turnamen.
                    </p>
                    <div class="mb-3">
                        <label for="alasan_nonaktif" class="form-label fw-bold">Alasan Nonaktifkan:</label>
                        <textarea class="form-control" id="alasan_nonaktif" name="alasan_nonaktif" rows="3"
                            style="border-radius: 10px;" placeholder="Berikan alasan menonaktifkan atlet..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                        <i class="bx bx-x me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger" style="border-radius: 10px; font-weight: 600;">
                        <i class="bx bx-user-x me-2"></i>Nonaktifkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function editAtlet(atletId) {
        const modal = new bootstrap.Modal(document.getElementById('editAtletModal'));
        const content = document.getElementById('editAtletContent');
        const form = document.getElementById('editAtletForm');

        form.action = '<?= base_url('user/klub/update-atlet') ?>/' + atletId;

        content.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        modal.show();

        fetch('<?= base_url('user/klub/get-atlet-data') ?>/' + atletId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const atlet = data.atlet;
                    content.innerHTML = `
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_nama_lengkap" class="form-label fw-bold">
                                    <i class="bx bx-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap" 
                                       value="${atlet.nama_lengkap}" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_email" class="form-label fw-bold">
                                    <i class="bx bx-envelope me-2"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" id="edit_email" name="email" 
                                       value="${atlet.email}" required style="border-radius: 10px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_tanggal_lahir" class="form-label fw-bold">
                                    <i class="bx bx-calendar me-2"></i>Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" 
                                       value="${atlet.tanggal_lahir}" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_jenis_kelamin" class="form-label fw-bold">
                                    <i class="bx bx-male-female me-2"></i>Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="edit_jenis_kelamin" name="jenis_kelamin" 
                                        required style="border-radius: 10px;">
                                    <option value="L" ${atlet.jenis_kelamin === 'L' ? 'selected' : ''}>Laki-laki</option>
                                    <option value="P" ${atlet.jenis_kelamin === 'P' ? 'selected' : ''}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_no_hp" class="form-label fw-bold">
                                    <i class="bx bx-phone me-2"></i>No. HP/WhatsApp
                                </label>
                                <input type="tel" class="form-control" id="edit_no_hp" name="no_hp" 
                                       value="${atlet.no_hp || ''}" style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kategori_usia" class="form-label fw-bold">
                                    <i class="bx bx-cake me-2"></i>Kategori Usia
                                </label>
                                <select class="form-select" id="edit_kategori_usia" name="kategori_usia" 
                                        style="border-radius: 10px;">
                                    <option value="">Otomatis berdasarkan usia</option>
                                    <option value="U-12" ${atlet.kategori_usia === 'U-12' ? 'selected' : ''}>U-12 (Under 12)</option>
                                    <option value="U-15" ${atlet.kategori_usia === 'U-15' ? 'selected' : ''}>U-15 (Under 15)</option>
                                    <option value="U-18" ${atlet.kategori_usia === 'U-18' ? 'selected' : ''}>U-18 (Under 18)</option>
                                    <option value="Senior" ${atlet.kategori_usia === 'Senior' ? 'selected' : ''}>Senior (18+)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label fw-bold">
                                <i class="bx bx-map me-2"></i>Alamat
                            </label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" 
                                      style="border-radius: 10px;">${atlet.alamat || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_foto" class="form-label fw-bold">
                                <i class="bx bx-camera me-2"></i>Foto Atlet (Kosongkan jika tidak ingin mengubah)
                            </label>
                            <input type="file" class="form-control" id="edit_foto" name="foto" 
                                   accept="image/*" style="border-radius: 10px;">
                            ${atlet.foto ? '<div class="form-text">Foto saat ini: <a href="' + atlet.foto + '" target="_blank">Lihat foto</a></div>' : ''}
                        </div>
                    `;
                } else {
                    content.innerHTML = `
                        <div class="text-center py-4">
                            <i class="bx bx-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p class="text-muted">Gagal memuat data atlet</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="bx bx-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                    </div>
                `;
            });
    }

    function nonaktifkanAtlet(atletId) {
        const modal = new bootstrap.Modal(document.getElementById('nonaktifkanModal'));
        const form = document.getElementById('nonaktifkanForm');

        form.action = '<?= base_url('user/klub/nonaktifkan-atlet') ?>/' + atletId;
        modal.show();
    }

    function lihatDetailAtlet(atletId) {
        const modal = new bootstrap.Modal(document.getElementById('detailAtletModal'));
        const content = document.getElementById('detailAtletContent');

        content.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        modal.show();

        fetch('<?= base_url('user/klub/detail-atlet') ?>/' + atletId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const atlet = data.atlet;
                    content.innerHTML = `
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <div class="avatar-circle mx-auto mb-3" style="width: 120px; height: 120px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    ${atlet.foto ? 
                                        '<img src="' + atlet.foto + '" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">' :
                                        '<i class="bx bx-user text-white" style="font-size: 3rem;"></i>'
                                    }
                                </div>
                                <h5 style="font-weight: 700; color: #003366;">${atlet.nama_lengkap}</h5>
                                <span class="badge bg-success" style="border-radius: 10px;">
                                    <i class="bx bx-check me-1"></i>Atlet Aktif
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>ID Atlet:</strong></div>
                                    <div class="col-sm-8">${atlet.id_atlet}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Email:</strong></div>
                                    <div class="col-sm-8">${atlet.email}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Tanggal Lahir:</strong></div>
                                    <div class="col-sm-8">${atlet.tanggal_lahir}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Jenis Kelamin:</strong></div>
                                    <div class="col-sm-8">${atlet.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Kategori Usia:</strong></div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-primary" style="border-radius: 10px;">${atlet.kategori_usia}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>No. HP:</strong></div>
                                    <div class="col-sm-8">${atlet.no_hp || '-'}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Alamat:</strong></div>
                                    <div class="col-sm-8">${atlet.alamat || '-'}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4"><strong>Ranking Provinsi:</strong></div>
                                    <div class="col-sm-8">
                                        ${atlet.ranking_provinsi ? 
                                            '<span class="badge bg-warning text-dark" style="border-radius: 10px;">#' + atlet.ranking_provinsi + '</span>' :
                                            '<span class="text-muted">Belum ada ranking</span>'
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    content.innerHTML = `
                        <div class="text-center py-4">
                            <i class="bx bx-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p class="text-muted">Gagal memuat detail atlet</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="bx bx-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                    </div>
                `;
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
<?= $this->endSection() ?>