<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;"></div> <!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                            <i class="fas fa-users me-3"></i>Kelola Atlet
                        </h1>
                        <p class="mb-0" style="font-weight: 500; color: #666;">
                            Manajemen atlet klub <?= esc($klub['nama']) ?>
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="button" class="btn btn-success px-4 py-2 me-2"
                            style="border-radius: 20px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#tambahAtletModal">
                            <i class="fas fa-plus me-2"></i>Tambah Atlet
                        </button>
                        <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-outline-secondary px-4 py-2"
                            style="border-radius: 20px; font-weight: 600;">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pendaftaran Pending -->
    <div class="col-12 mb-4">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-header border-0" style="background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 25px 25px 0 0;">
                <h5 class="mb-0 text-white" style="font-weight: 700;">
                    <i class="fas fa-clock me-2"></i>Pendaftaran Menunggu Verifikasi (<?= count($pendaftaran_pending) ?>)
                </h5>
            </div>
            <div class="card-body p-4">


                <?php if (!empty($pendaftaran_pending)): ?>
                    <div class="row">
                        <?php foreach ($pendaftaran_pending as $pendaftaran): ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-circle me-3" style="width: 50px; height: 50px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user text-white"></i>
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
                                                    <span style="font-weight: 600;"><?= esc($pendaftaran['jenis_kelamin']) ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="verifikasiAtlet(<?= $pendaftaran['id_pendaftaran_atlet'] ?>, 'approve')"
                                                style="border-radius: 10px; font-weight: 600;">
                                                <i class="fas fa-check me-1"></i>Setujui
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="verifikasiAtlet(<?= $pendaftaran['id_pendaftaran_atlet'] ?>, 'reject')"
                                                style="border-radius: 10px; font-weight: 600;">
                                                <i class="fas fa-times me-1"></i>Tolak
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                        <p class="text-muted mb-0">Tidak ada pendaftaran yang menunggu verifikasi</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Atlet Aktif -->
    <div class="col-12">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                <h5 class="mb-0 text-white" style="font-weight: 700;">
                    <i class="fas fa-check-circle me-2"></i>Atlet Aktif (<?= count($atlet_aktif) ?>)
                </h5>
            </div>
            <div class="card-body p-4">


                <?php if (!empty($atlet_aktif)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="background: #f8f9fa;">
                                <tr>
                                    <th style="font-weight: 700; color: #003366; border-radius: 10px 0 0 10px;">Nama</th>
                                    <th style="font-weight: 700; color: #003366;">Email</th>
                                    <th style="font-weight: 700; color: #003366;">Kategori</th>
                                    <th style="font-weight: 700; color: #003366;">Gender</th>
                                    <th style="font-weight: 700; color: #003366;">Status</th>
                                    <th style="font-weight: 700; color: #003366; border-radius: 0 10px 10px 0;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($atlet_aktif as $atlet): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3" style="width: 40px; height: 40px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: #003366;">
                                                        <?= esc($atlet['nama_lengkap']) ?>
                                                    </div>
                                                    <small class="text-muted">ID: <?= $atlet['id_atlet'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="font-weight: 500;"><?= esc($atlet['email']) ?></td>
                                        <td>
                                            <span class="badge bg-primary" style="border-radius: 10px;">
                                                <?= esc($atlet['kategori_usia']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?= $atlet['jenis_kelamin'] === 'L' ? 'bg-info' : 'bg-warning' ?>" style="border-radius: 10px;">
                                                <?= $atlet['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="border-radius: 10px;">
                                                <i class="fas fa-check me-1"></i>Aktif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    onclick="lihatDetailAtlet(<?= $atlet['id_atlet'] ?>)"
                                                    style="border-radius: 8px 0 0 8px;" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning"
                                                    onclick="editAtlet(<?= $atlet['id_atlet'] ?>)"
                                                    style="border-radius: 0;" title="Edit Atlet">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="nonaktifkanAtlet(<?= $atlet['id_atlet'] ?>)"
                                                    style="border-radius: 0 8px 8px 0;" title="Nonaktifkan">
                                                    <i class="fas fa-user-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-users-slash" style="font-size: 3rem; color: #e0e0e0; margin-bottom: 1rem;"></i>
                        <p class="text-muted mb-0">Belum ada atlet aktif di klub ini</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-check-circle me-2"></i>Verifikasi Pendaftaran Atlet
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
                            style="border-radius: 15px;" placeholder="Berikan catatan untuk keputusan verifikasi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 15px;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 15px; font-weight: 600;">
                        <i class="fas fa-check me-2"></i>Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Atlet -->
<div class="modal fade" id="tambahAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-user-plus me-2"></i>Tambah Atlet Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('user/klub/tambah-atlet') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label fw-bold">
                                <i class="fas fa-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                required style="border-radius: 15px; padding: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">
                                <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                required style="border-radius: 15px; padding: 12px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label fw-bold">
                                <i class="fas fa-calendar me-2"></i>Tanggal Lahir <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                required style="border-radius: 15px; padding: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label fw-bold">
                                <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin"
                                required style="border-radius: 15px; padding: 12px;">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label fw-bold">
                                <i class="fas fa-phone me-2"></i>No. HP/WhatsApp
                            </label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                placeholder="08xxxxxxxxxx" style="border-radius: 15px; padding: 12px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kategori_usia" class="form-label fw-bold">
                                <i class="fas fa-birthday-cake me-2"></i>Kategori Usia
                            </label>
                            <select class="form-select" id="kategori_usia" name="kategori_usia"
                                style="border-radius: 15px; padding: 12px;">
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
                            <i class="fas fa-map-marker-alt me-2"></i>Alamat
                        </label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"
                            style="border-radius: 15px;" placeholder="Alamat lengkap atlet..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label fw-bold">
                            <i class="fas fa-camera me-2"></i>Foto Atlet (Opsional)
                        </label>
                        <input type="file" class="form-control" id="foto" name="foto"
                            accept="image/*" style="border-radius: 15px; padding: 12px;">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Format: JPG, PNG. Maksimal 2MB.
                        </div>
                    </div>

                    <div class="alert alert-info" style="border-radius: 15px;">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Setelah menambahkan atlet, sistem akan membuat akun login otomatis.
                        Password default akan dikirim ke email atlet.
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 15px;">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success" style="border-radius: 15px; font-weight: 600;">
                        <i class="fas fa-plus me-2"></i>Tambah Atlet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Atlet -->
<div class="modal fade" id="editAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-edit me-2"></i>Edit Data Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAtletForm" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4" id="editAtletContent">
                    <!-- Content will be loaded via AJAX -->
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 15px;">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning" style="border-radius: 15px; font-weight: 600;">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Atlet -->
<div class="modal fade" id="detailAtletModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-user me-2"></i>Detail Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="detailAtletContent">
                <!-- Content will be loaded via AJAX -->
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
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Nonaktifkan Atlet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="nonaktifkanForm" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-times text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mb-3">
                        Apakah Anda yakin ingin menonaktifkan atlet ini?
                        Atlet yang dinonaktifkan tidak dapat mengikuti turnamen.
                    </p>
                    <div class="mb-3">
                        <label for="alasan_nonaktif" class="form-label fw-bold">Alasan Nonaktifkan:</label>
                        <textarea class="form-control" id="alasan_nonaktif" name="alasan_nonaktif" rows="3"
                            style="border-radius: 15px;" placeholder="Berikan alasan menonaktifkan atlet..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 15px;">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger" style="border-radius: 15px; font-weight: 600;">
                        <i class="fas fa-user-times me-2"></i>Nonaktifkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function verifikasiAtlet(pendaftaranId, action) {
        document.getElementById('pendaftaran_id').value = pendaftaranId;
        document.getElementById('action').value = action;

        // Update modal title and form action based on action type
        const modal = document.getElementById('verifikasiModal');
        const title = modal.querySelector('.modal-title');
        const form = document.getElementById('verifikasiForm');

        if (action === 'approve') {
            title.innerHTML = '<i class="fas fa-check-circle me-2"></i>Setujui Pendaftaran Atlet';
            form.action = '<?= base_url('user/klub/approve-atlet') ?>';
            modal.querySelector('.btn-primary').innerHTML = '<i class="fas fa-check me-2"></i>Setujui';
            modal.querySelector('.btn-primary').className = 'btn btn-success';
        } else {
            title.innerHTML = '<i class="fas fa-times-circle me-2"></i>Tolak Pendaftaran Atlet';
            form.action = '<?= base_url('user/klub/reject-atlet') ?>';
            modal.querySelector('.btn-primary').innerHTML = '<i class="fas fa-times me-2"></i>Tolak';
            modal.querySelector('.btn-primary').className = 'btn btn-danger';
        }

        // Show modal
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    function editAtlet(atletId) {
        const modal = new bootstrap.Modal(document.getElementById('editAtletModal'));
        const content = document.getElementById('editAtletContent');
        const form = document.getElementById('editAtletForm');

        // Set form action
        form.action = '<?= base_url('user/klub/update-atlet') ?>/' + atletId;

        // Show loading
        content.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        modal.show();

        // Load atlet data for editing
        fetch('<?= base_url('user/klub/get-atlet-data') ?>/' + atletId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const atlet = data.atlet;
                    content.innerHTML = `
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_nama_lengkap" class="form-label fw-bold">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap" 
                                       value="${atlet.nama_lengkap}" required style="border-radius: 15px; padding: 12px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" id="edit_email" name="email" 
                                       value="${atlet.email}" required style="border-radius: 15px; padding: 12px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_tanggal_lahir" class="form-label fw-bold">
                                    <i class="fas fa-calendar me-2"></i>Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" 
                                       value="${atlet.tanggal_lahir}" required style="border-radius: 15px; padding: 12px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_jenis_kelamin" class="form-label fw-bold">
                                    <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="edit_jenis_kelamin" name="jenis_kelamin" 
                                        required style="border-radius: 15px; padding: 12px;">
                                    <option value="L" ${atlet.jenis_kelamin === 'L' ? 'selected' : ''}>Laki-laki</option>
                                    <option value="P" ${atlet.jenis_kelamin === 'P' ? 'selected' : ''}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_no_hp" class="form-label fw-bold">
                                    <i class="fas fa-phone me-2"></i>No. HP/WhatsApp
                                </label>
                                <input type="tel" class="form-control" id="edit_no_hp" name="no_hp" 
                                       value="${atlet.no_hp || ''}" style="border-radius: 15px; padding: 12px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kategori_usia" class="form-label fw-bold">
                                    <i class="fas fa-birthday-cake me-2"></i>Kategori Usia
                                </label>
                                <select class="form-select" id="edit_kategori_usia" name="kategori_usia" 
                                        style="border-radius: 15px; padding: 12px;">
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
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat
                            </label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" 
                                      style="border-radius: 15px;">${atlet.alamat || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_foto" class="form-label fw-bold">
                                <i class="fas fa-camera me-2"></i>Foto Atlet (Kosongkan jika tidak ingin mengubah)
                            </label>
                            <input type="file" class="form-control" id="edit_foto" name="foto" 
                                   accept="image/*" style="border-radius: 15px; padding: 12px;">
                            ${atlet.foto ? '<div class="form-text">Foto saat ini: <a href="' + atlet.foto + '" target="_blank">Lihat foto</a></div>' : ''}
                        </div>
                    `;
                } else {
                    content.innerHTML = `
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p class="text-muted">Gagal memuat data atlet</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
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

        // Show loading
        content.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

        modal.show();

        // Load atlet detail via AJAX
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
                                    '<i class="fas fa-user text-white" style="font-size: 3rem;"></i>'
                                }
                            </div>
                            <h5 style="font-weight: 700; color: #003366;">${atlet.nama_lengkap}</h5>
                            <span class="badge bg-success" style="border-radius: 10px;">
                                <i class="fas fa-check me-1"></i>Atlet Aktif
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
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p class="text-muted">Gagal memuat detail atlet</p>
                    </div>
                `;
                }
            })
            .catch(error => {
                content.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                </div>
            `;
            });
    }

    // Auto-hide alerts
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