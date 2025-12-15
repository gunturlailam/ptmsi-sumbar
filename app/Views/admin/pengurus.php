<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
        <span class="text-muted fw-light">Manajemen Data /</span> Pengurus
    </h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPengurusModal">
        <i class="bx bx-plus me-1"></i> Tambah Pengurus
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
        <h5 class="mb-0">Daftar Pengurus</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari pengurus..." id="searchInput" style="width: 250px;">
            <select class="form-select form-select-sm" id="filterStatus" style="width: 150px;">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
            </select>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th width="15%">Jabatan</th>
                    <th width="15%">Organisasi</th>
                    <th width="12%">Kontak</th>
                    <th width="15%">Periode</th>
                    <th width="8%">Status</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($pengurus)): ?>
                    <?php foreach ($pengurus as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial rounded-circle bg-label-primary">
                                            <?= strtoupper(substr($item['nama'] ?? 'P', 0, 1)) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <strong><?= esc($item['nama']) ?></strong>
                                        <?php if (isset($item['email']) && $item['email']): ?>
                                            <br><small class="text-muted"><?= esc($item['email']) ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-label-info"><?= esc($item['jabatan']) ?></span>
                            </td>
                            <td><?= esc($item['nama_organisasi'] ?? 'Belum terdaftar') ?></td>
                            <td>
                                <?php if (isset($item['telepon']) && $item['telepon']): ?>
                                    <small><i class="bx bx-phone"></i> <?= esc($item['telepon']) ?></small>
                                    <br>
                                <?php endif; ?>
                                <?php if (isset($item['email']) && $item['email']): ?>
                                    <small><i class="bx bx-envelope"></i> <?= esc($item['email']) ?></small>
                                <?php endif; ?>
                                <?php if ((!isset($item['telepon']) || !$item['telepon']) && (!isset($item['email']) || !$item['email'])): ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['periode_mulai']) && $item['periode_mulai']): ?>
                                    <small><?= date('Y', strtotime($item['periode_mulai'])) ?></small>
                                    <?php if (isset($item['periode_selesai']) && $item['periode_selesai']): ?>
                                        <small> - <?= date('Y', strtotime($item['periode_selesai'])) ?></small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['status']) && $item['status'] === 'aktif'): ?>
                                    <span class="badge bg-label-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-label-secondary">Non-Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="editPengurus(<?= $item['id_pengurus'] ?>)" title="Edit Pengurus">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="deletePengurus(<?= $item['id_pengurus'] ?>)" title="Hapus Pengurus">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bx bx-user-check bx-lg mb-2"></i>
                                <p>Belum ada pengurus. <a href="#" data-bs-toggle="modal" data-bs-target="#addPengurusModal">Tambah pengurus pertama</a></p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Pengurus Modal -->
<div class="modal fade" id="addPengurusModal" tabindex="-1" aria-labelledby="addPengurusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPengurusModalLabel">Tambah Pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addPengurusForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_organisasi" class="form-label">Organisasi</label>
                                <select class="form-select" id="id_organisasi" name="id_organisasi">
                                    <option value="">Pilih Organisasi</option>
                                    <?php if (!empty($organisasi)): ?>
                                        <?php foreach ($organisasi as $org): ?>
                                            <option value="<?= $org['id_organisasi'] ?>"><?= esc($org['nama_organisasi']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="periode_mulai" class="form-label">Periode Mulai</label>
                                <input type="date" class="form-control" id="periode_mulai" name="periode_mulai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="periode_selesai" class="form-label">Periode Selesai</label>
                                <input type="date" class="form-control" id="periode_selesai" name="periode_selesai">
                            </div>
                        </div>
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

<!-- Edit Pengurus Modal -->
<div class="modal fade" id="editPengurusModal" tabindex="-1" aria-labelledby="editPengurusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPengurusModalLabel">Edit Pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPengurusForm">
                <input type="hidden" id="edit_id_pengurus" name="id_pengurus">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_nama" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_jabatan" name="jabatan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_organisasi" class="form-label">Organisasi</label>
                                <select class="form-select" id="edit_id_organisasi" name="id_organisasi">
                                    <option value="">Pilih Organisasi</option>
                                    <?php if (!empty($organisasi)): ?>
                                        <?php foreach ($organisasi as $org): ?>
                                            <option value="<?= $org['id_organisasi'] ?>"><?= esc($org['nama_organisasi']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="edit_telepon" name="telepon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_periode_mulai" class="form-label">Periode Mulai</label>
                                <input type="date" class="form-control" id="edit_periode_mulai" name="periode_mulai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_periode_selesai" class="form-label">Periode Selesai</label>
                                <input type="date" class="form-control" id="edit_periode_selesai" name="periode_selesai">
                            </div>
                        </div>
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

    // Filter by status
    document.getElementById('filterStatus').addEventListener('change', function() {
        const filterValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            if (!filterValue) {
                row.style.display = '';
            } else {
                const statusCell = row.querySelector('td:nth-child(7)');
                if (statusCell) {
                    const statusText = statusCell.textContent.toLowerCase();
                    row.style.display = statusText.includes(filterValue) ? '' : 'none';
                }
            }
        });
    });

    // Add Pengurus Form Submit
    document.getElementById('addPengurusForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch('<?= base_url('admin/pengurus/store') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addPengurusModal'));
                    modal.hide();
                    this.reset();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            })
            .finally(() => {
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
            });
    });

    // Edit Pengurus Form Submit
    document.getElementById('editPengurusForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');
        const pengurusId = document.getElementById('edit_id_pengurus').value;

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch(`<?= base_url('admin/pengurus/update') ?>/${pengurusId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editPengurusModal'));
                    modal.hide();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            })
            .finally(() => {
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
            });
    });

    // Edit Pengurus Function
    function editPengurus(id) {
        fetch(`<?= base_url('admin/pengurus/get') ?>/${id}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pengurus = data.data;

                    document.getElementById('edit_id_pengurus').value = pengurus.id_pengurus;
                    document.getElementById('edit_nama').value = pengurus.nama || '';
                    document.getElementById('edit_jabatan').value = pengurus.jabatan || '';
                    document.getElementById('edit_id_organisasi').value = pengurus.id_organisasi || '';
                    document.getElementById('edit_telepon').value = pengurus.telepon || '';
                    document.getElementById('edit_email').value = pengurus.email || '';
                    document.getElementById('edit_periode_mulai').value = pengurus.periode_mulai || '';
                    document.getElementById('edit_periode_selesai').value = pengurus.periode_selesai || '';
                    document.getElementById('edit_status').value = pengurus.status || 'aktif';

                    const modal = new bootstrap.Modal(document.getElementById('editPengurusModal'));
                    modal.show();
                } else {
                    showAlert('error', 'Gagal mengambil data pengurus');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            });
    }

    // Delete Pengurus Function
    function deletePengurus(id) {
        if (confirm('Yakin ingin menghapus pengurus ini?')) {
            fetch(`<?= base_url('admin/pengurus/delete') ?>/${id}`, {
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
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showAlert('error', data.message || 'Gagal menghapus pengurus');
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

        const contentDiv = document.querySelector('.d-flex.justify-content-between.align-items-center.mb-4');
        contentDiv.insertAdjacentHTML('afterend', alertHtml);

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