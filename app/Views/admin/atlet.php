<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
        <span class="text-muted fw-light">Manajemen Data /</span> Atlet
    </h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAtletModal">
        <i class="bx bx-plus me-1"></i> Tambah Atlet
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Atlet</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari atlet..." id="searchInput" style="width: 250px;">
            <select class="form-select form-select-sm" id="filterGender" style="width: 150px;">
                <option value="">Semua Gender</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Foto</th>
                    <th width="20%">Nama Lengkap</th>
                    <th width="15%">Nomor Lisensi</th>
                    <th width="15%">Klub</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Umur</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($atlet)): ?>
                    <?php foreach ($atlet as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <?php if (isset($item['foto_profil']) && $item['foto_profil']): ?>
                                    <img src="<?= base_url($item['foto_profil']) ?>" alt="<?= esc($item['nama_lengkap']) ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded-circle bg-label-primary">
                                            <?= strtoupper(substr($item['nama_lengkap'] ?? 'A', 0, 1)) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= esc($item['nama_lengkap']) ?></strong>
                                <br>
                                <small class="text-muted"><?= esc($item['email']) ?></small>
                            </td>
                            <td>
                                <?php if (isset($item['nomor_lisensi']) && $item['nomor_lisensi']): ?>
                                    <span class="badge bg-label-info"><?= esc($item['nomor_lisensi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">Belum ada</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($item['nama_klub'] ?? 'Belum terdaftar') ?></td>
                            <td>
                                <?php if (isset($item['jenis_kelamin']) && $item['jenis_kelamin'] === 'L'): ?>
                                    <span class="badge bg-label-primary">Laki-laki</span>
                                <?php elseif (isset($item['jenis_kelamin']) && $item['jenis_kelamin'] === 'P'): ?>
                                    <span class="badge bg-label-success">Perempuan</span>
                                <?php else: ?>
                                    <span class="text-muted">Belum diisi</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['tanggal_lahir']) && $item['tanggal_lahir']): ?>
                                    <?= date_diff(date_create($item['tanggal_lahir']), date_create('today'))->y ?> tahun
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="editAtlet(<?= $item['id_atlet'] ?>)">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="deleteAtlet(<?= $item['id_atlet'] ?>)">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bx bx-user bx-lg mb-2"></i>
                                <p>Belum ada atlet. <a href="<?= base_url('admin/atlet/create') ?>">Tambah atlet pertama</a></p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Atlet Modal -->
<div class="modal fade" id="addAtletModal" tabindex="-1" aria-labelledby="addAtletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAtletModalLabel">Tambah Atlet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAtletForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_user" class="form-label">Pilih User <span class="text-danger">*</span></label>
                                <select class="form-select" id="id_user" name="id_user" required>
                                    <option value="">Pilih User</option>
                                    <?php if (!empty($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id_user'] ?>"><?= esc($user['nama_lengkap']) ?> (<?= esc($user['email']) ?>)</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_klub" class="form-label">Klub</label>
                                <select class="form-select" id="id_klub" name="id_klub">
                                    <option value="">Pilih Klub</option>
                                    <?php if (!empty($klub)): ?>
                                        <?php foreach ($klub as $k): ?>
                                            <option value="<?= $k['id_klub'] ?>"><?= esc($k['nama']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori_usia" class="form-label">Kategori Usia</label>
                                <select class="form-select" id="kategori_usia" name="kategori_usia">
                                    <option value="">Pilih Kategori</option>
                                    <option value="U-12">U-12</option>
                                    <option value="U-15">U-15</option>
                                    <option value="U-18">U-18</option>
                                    <option value="U-21">U-21</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ranking_provinsi" class="form-label">Ranking Provinsi</label>
                                <input type="number" class="form-control" id="ranking_provinsi" name="ranking_provinsi" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                            <option value="Pensiun">Pensiun</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Atlet Modal -->
<div class="modal fade" id="editAtletModal" tabindex="-1" aria-labelledby="editAtletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAtletModalLabel">Edit Atlet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAtletForm" enctype="multipart/form-data">
                <input type="hidden" id="edit_id_atlet" name="id_atlet">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_user" class="form-label">Pilih User <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_id_user" name="id_user" required>
                                    <option value="">Pilih User</option>
                                    <?php if (!empty($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id_user'] ?>"><?= esc($user['nama_lengkap']) ?> (<?= esc($user['email']) ?>)</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_klub" class="form-label">Klub</label>
                                <select class="form-select" id="edit_id_klub" name="id_klub">
                                    <option value="">Pilih Klub</option>
                                    <?php if (!empty($klub)): ?>
                                        <?php foreach ($klub as $k): ?>
                                            <option value="<?= $k['id_klub'] ?>"><?= esc($k['nama']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kategori_usia" class="form-label">Kategori Usia</label>
                                <select class="form-select" id="edit_kategori_usia" name="kategori_usia">
                                    <option value="">Pilih Kategori</option>
                                    <option value="U-12">U-12</option>
                                    <option value="U-15">U-15</option>
                                    <option value="U-18">U-18</option>
                                    <option value="U-21">U-21</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_ranking_provinsi" class="form-label">Ranking Provinsi</label>
                                <input type="number" class="form-control" id="edit_ranking_provinsi" name="ranking_provinsi" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                            <option value="Pensiun">Pensiun</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Filter by gender
    document.getElementById('filterGender').addEventListener('change', function() {
        const filterValue = this.value;
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            if (!filterValue) {
                row.style.display = '';
            } else {
                const genderCell = row.querySelector('td:nth-child(6)');
                if (genderCell) {
                    const genderText = genderCell.textContent.toLowerCase();
                    const showRow = (filterValue === 'L' && genderText.includes('laki')) ||
                        (filterValue === 'P' && genderText.includes('perempuan'));
                    row.style.display = showRow ? '' : 'none';
                }
            }
        });
    });

    // Add Atlet Form Submit
    document.getElementById('addAtletForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');

        // Show loading
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch('<?= base_url('admin/atlet/store') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success alert
                    showAlert('success', data.message);

                    // Close modal and reset form
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addAtletModal'));
                    modal.hide();
                    this.reset();

                    // Reload page to show new data
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            })
            .finally(() => {
                // Hide loading
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
            });
    });

    // Edit Atlet Form Submit
    document.getElementById('editAtletForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');
        const atletId = document.getElementById('edit_id_atlet').value;

        // Show loading
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch(`<?= base_url('admin/atlet/update') ?>/${atletId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success alert
                    showAlert('success', data.message);

                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editAtletModal'));
                    modal.hide();

                    // Reload page to show updated data
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            })
            .finally(() => {
                // Hide loading
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
            });
    });

    // Edit Atlet Function
    function editAtlet(id) {
        fetch(`<?= base_url('admin/atlet/get') ?>/${id}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const atlet = data.data;

                    // Fill form fields
                    document.getElementById('edit_id_atlet').value = atlet.id_atlet;
                    document.getElementById('edit_id_user').value = atlet.id_user || '';
                    document.getElementById('edit_id_klub').value = atlet.id_klub || '';
                    document.getElementById('edit_tanggal_lahir').value = atlet.tanggal_lahir || '';
                    document.getElementById('edit_jenis_kelamin').value = atlet.jenis_kelamin || '';
                    document.getElementById('edit_kategori_usia').value = atlet.kategori_usia || '';
                    document.getElementById('edit_ranking_provinsi').value = atlet.ranking_provinsi || '';
                    document.getElementById('edit_status').value = atlet.status || '';

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editAtletModal'));
                    modal.show();
                } else {
                    showAlert('error', 'Gagal mengambil data atlet');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            });
    }

    // Delete Atlet Function
    function deleteAtlet(id) {
        if (confirm('Yakin ingin menghapus atlet ini?')) {
            fetch(`<?= base_url('admin/atlet/delete') ?>/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert('error', data.message || 'Gagal menghapus atlet');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Terjadi kesalahan sistem');
                });
        }
    }

    // Show Alert Function
    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        // Insert alert at the top of content
        const contentDiv = document.querySelector('.d-flex.justify-content-between.align-items-center.mb-4');
        contentDiv.insertAdjacentHTML('afterend', alertHtml);

        // Auto dismiss after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector(`.${alertClass}`);
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    }
</script>
<?= $this->endSection() ?>