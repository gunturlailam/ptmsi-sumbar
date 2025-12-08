<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
        <span class="text-muted fw-light">Manajemen Data /</span> Pelatih
    </h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPelatihModal">
        <i class="bx bx-plus me-1"></i> Tambah Pelatih
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
        <h5 class="mb-0">Daftar Pelatih</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari pelatih..." id="searchInput" style="width: 250px;">
            <select class="form-select form-select-sm" id="filterLevel" style="width: 150px;">
                <option value="">Semua Level</option>
                <option value="Dasar">Dasar</option>
                <option value="Menengah">Menengah</option>
                <option value="Lanjut">Lanjut</option>
                <option value="Nasional">Nasional</option>
                <option value="Internasional">Internasional</option>
            </select>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Lengkap</th>
                    <th width="15%">Nomor Lisensi</th>
                    <th width="15%">Klub</th>
                    <th width="12%">Level Sertifikasi</th>
                    <th width="10%">Pengalaman</th>
                    <th width="10%">Spesialisasi</th>
                    <th width="13%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($pelatih)): ?>
                    <?php foreach ($pelatih as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial rounded-circle bg-label-success">
                                            <?= strtoupper(substr($item['nama_lengkap'] ?? 'P', 0, 1)) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <strong><?= esc($item['nama_lengkap']) ?></strong>
                                        <br>
                                        <small class="text-muted"><?= esc($item['email']) ?></small>
                                    </div>
                                </div>
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
                                <?php if (isset($item['level_sertifikasi']) && $item['level_sertifikasi']): ?>
                                    <?php
                                    $badgeClass = match ($item['level_sertifikasi']) {
                                        'Dasar' => 'bg-label-secondary',
                                        'Menengah' => 'bg-label-primary',
                                        'Lanjut' => 'bg-label-info',
                                        'Nasional' => 'bg-label-warning',
                                        'Internasional' => 'bg-label-success',
                                        default => 'bg-label-secondary'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= esc($item['level_sertifikasi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">Belum ada</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['pengalaman_tahun']) && $item['pengalaman_tahun']): ?>
                                    <?= $item['pengalaman_tahun'] ?> tahun
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['spesialisasi']) && $item['spesialisasi']): ?>
                                    <small><?= esc(substr($item['spesialisasi'], 0, 20)) ?>...</small>
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
                                        <a class="dropdown-item" href="#" onclick="editPelatih(<?= $item['id_pelatih'] ?>)">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="deletePelatih(<?= $item['id_pelatih'] ?>)">
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
                                <i class="bx bx-user-check bx-lg mb-2"></i>
                                <p>Belum ada pelatih. <a href="<?= base_url('admin/pelatih/create') ?>">Tambah pelatih pertama</a></p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Pelatih Modal -->
<div class="modal fade" id="addPelatihModal" tabindex="-1" aria-labelledby="addPelatihModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPelatihModalLabel">Tambah Pelatih</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addPelatihForm" enctype="multipart/form-data">
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
                                <label for="tingkat_sertifikasi" class="form-label">Tingkat Sertifikasi</label>
                                <select class="form-select" id="tingkat_sertifikasi" name="tingkat_sertifikasi">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="Dasar">Dasar</option>
                                    <option value="Menengah">Menengah</option>
                                    <option value="Lanjut">Lanjut</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_sertifikasi" class="form-label">Tanggal Sertifikasi</label>
                                <input type="date" class="form-control" id="tanggal_sertifikasi" name="tanggal_sertifikasi">
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

<!-- Edit Pelatih Modal -->
<div class="modal fade" id="editPelatihModal" tabindex="-1" aria-labelledby="editPelatihModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPelatihModalLabel">Edit Pelatih</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPelatihForm" enctype="multipart/form-data">
                <input type="hidden" id="edit_id_pelatih" name="id_pelatih">
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
                                <label for="edit_tingkat_sertifikasi" class="form-label">Tingkat Sertifikasi</label>
                                <select class="form-select" id="edit_tingkat_sertifikasi" name="tingkat_sertifikasi">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="Dasar">Dasar</option>
                                    <option value="Menengah">Menengah</option>
                                    <option value="Lanjut">Lanjut</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tanggal_sertifikasi" class="form-label">Tanggal Sertifikasi</label>
                                <input type="date" class="form-control" id="edit_tanggal_sertifikasi" name="tanggal_sertifikasi">
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

    // Filter by level
    document.getElementById('filterLevel').addEventListener('change', function() {
        const filterValue = this.value;
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            if (!filterValue) {
                row.style.display = '';
            } else {
                const levelCell = row.querySelector('td:nth-child(5)');
                if (levelCell) {
                    const levelText = levelCell.textContent.toLowerCase();
                    row.style.display = levelText.includes(filterValue.toLowerCase()) ? '' : 'none';
                }
            }
        });
    });

    // Add Pelatih Form Submit
    document.getElementById('addPelatihForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch('<?= base_url('admin/pelatih/store') ?>', {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addPelatihModal'));
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

    // Edit Pelatih Form Submit
    document.getElementById('editPelatihForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');
        const pelatihId = document.getElementById('edit_id_pelatih').value;

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch(`<?= base_url('admin/pelatih/update') ?>/${pelatihId}`, {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editPelatihModal'));
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

    // Edit Pelatih Function
    function editPelatih(id) {
        fetch(`<?= base_url('admin/pelatih/get') ?>/${id}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const pelatih = data.data;

                    document.getElementById('edit_id_pelatih').value = pelatih.id_pelatih;
                    document.getElementById('edit_id_user').value = pelatih.id_user || '';
                    document.getElementById('edit_id_klub').value = pelatih.id_klub || '';
                    document.getElementById('edit_tingkat_sertifikasi').value = pelatih.tingkat_sertifikasi || '';
                    document.getElementById('edit_tanggal_sertifikasi').value = pelatih.tanggal_sertifikasi || '';

                    const modal = new bootstrap.Modal(document.getElementById('editPelatihModal'));
                    modal.show();
                } else {
                    showAlert('error', 'Gagal mengambil data pelatih');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            });
    }

    // Delete Pelatih Function
    function deletePelatih(id) {
        if (confirm('Yakin ingin menghapus pelatih ini?')) {
            fetch(`<?= base_url('admin/pelatih/delete') ?>/${id}`, {
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
                        showAlert('error', data.message || 'Gagal menghapus pelatih');
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