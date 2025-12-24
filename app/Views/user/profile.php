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
                                <i class="bx bx-user me-2"></i>Profil Pengguna
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Kelola informasi profil Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-outline-secondary px-4 py-2">
                                <i class="bx bx-arrow-back me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="avatar-circle mx-auto mb-3" style="width: 120px; height: 120px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bx bx-user text-white" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h5 class="mb-1" style="font-weight: 700; color: #2d3748;">
                        <?= esc($user['nama_lengkap'] ?? 'User') ?>
                    </h5>
                    <p class="mb-3" style="color: #667eea; font-weight: 600;">
                        <?= ucfirst(esc($user['peran'] ?? 'user')) ?>
                    </p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bx bx-edit me-2"></i>Edit Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #667eea, #764ba2);">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="bx bx-info-circle me-2"></i>Informasi Profil
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong style="color: #2d3748;">Nama Lengkap</strong>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0" style="color: #666;">
                                <?= esc($user['nama_lengkap'] ?? '-') ?>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong style="color: #2d3748;">Email</strong>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0" style="color: #666;">
                                <?= esc($user['email'] ?? '-') ?>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong style="color: #2d3748;">Peran</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge bg-primary" style="border-radius: 10px;">
                                <?= ucfirst(esc($user['peran'] ?? 'user')) ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong style="color: #2d3748;">Status</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge bg-success" style="border-radius: 10px;">
                                <i class="bx bx-check-circle me-1"></i>Aktif
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong style="color: #2d3748;">Bergabung Sejak</strong>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0" style="color: #666;">
                                <?= isset($user['dibuat_pada']) ? date('d F Y', strtotime($user['dibuat_pada'])) : 'Tidak tersedia' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header border-0" style="background: linear-gradient(45deg, #dc3545, #c82333);">
                    <h5 class="mb-0 text-white" style="font-weight: 700;">
                        <i class="bx bx-lock me-2"></i>Keamanan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 style="font-weight: 700; color: #2d3748;">Ubah Password</h6>
                            <p style="color: #666; margin-bottom: 0;">
                                Perbarui password Anda secara berkala untuk menjaga keamanan akun
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bx bx-key me-2"></i>Ubah Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-edit me-2"></i>Edit Profil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600;">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namaLengkap" value="<?= esc($user['nama_lengkap'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600;">Email</label>
                        <input type="email" class="form-control" id="email" value="<?= esc($user['email'] ?? '') ?>" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveProfile()">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white" style="font-weight: 700;">
                    <i class="bx bx-key me-2"></i>Ubah Password
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600;">Password Lama</label>
                        <input type="password" class="form-control" id="oldPassword" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600;">Password Baru</label>
                        <input type="password" class="form-control" id="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600;">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="changePassword()">Ubah Password</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function saveProfile() {
        const namaLengkap = document.getElementById('namaLengkap').value;
        const email = document.getElementById('email').value;

        if (!namaLengkap || !email) {
            alert('Semua field harus diisi');
            return;
        }

        // TODO: Implement save profile functionality
        alert('Fitur ini akan segera tersedia');
    }

    function changePassword() {
        const oldPassword = document.getElementById('oldPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (!oldPassword || !newPassword || !confirmPassword) {
            alert('Semua field harus diisi');
            return;
        }

        if (newPassword !== confirmPassword) {
            alert('Password baru tidak cocok');
            return;
        }

        if (newPassword.length < 6) {
            alert('Password minimal 6 karakter');
            return;
        }

        // TODO: Implement change password functionality
        alert('Fitur ini akan segera tersedia');
    }
</script>
<?= $this->endSection() ?>