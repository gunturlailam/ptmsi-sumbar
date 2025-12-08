<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
        <span class="text-muted fw-light">Manajemen Data /</span> Klub
    </h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKlubModal">
        <i class="bx bx-plus me-1"></i> Tambah Klub
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
        <h5 class="mb-0">Daftar Klub</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari klub..." id="searchInput" style="width: 250px;">
            <select class="form-select form-select-sm" id="filterKota" style="width: 150px;">
                <option value="">Semua Kota</option>
                <option value="Padang">Padang</option>
                <option value="Bukittinggi">Bukittinggi</option>
                <option value="Payakumbuh">Payakumbuh</option>
                <option value="Solok">Solok</option>
                <option value="Sawahlunto">Sawahlunto</option>
            </select>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Logo</th>
                    <th width="20%">Nama Klub</th>
                    <th width="15%">Organisasi</th>
                    <th width="15%">Alamat</th>
                    <th width="10%">Tahun Berdiri</th>
                    <th width="12%">Kontak/Status</th>
                    <th width="13%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($klub)): ?>
                    <?php foreach ($klub as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <?php if (isset($item['logo_klub']) && $item['logo_klub']): ?>
                                    <img src="<?= base_url($item['logo_klub']) ?>" alt="<?= esc($item['nama']) ?>" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-info">
                                            <?= strtoupper(substr($item['nama'] ?? 'KL', 0, 2)) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= esc($item['nama']) ?></strong>
                                <br>
                                <?php if (isset($item['penanggung_jawab']) && $item['penanggung_jawab']): ?>
                                    <small class="text-muted">PJ: <?= esc($item['penanggung_jawab']) ?></small>
                                <?php else: ?>
                                    <small class="text-muted">PJ belum diisi</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['nama_organisasi']) && $item['nama_organisasi']): ?>
                                    <span class="badge bg-label-primary"><?= esc($item['nama_organisasi']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">Belum terdaftar</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['alamat']) && $item['alamat']): ?>
                                    <small><?= esc(substr($item['alamat'], 0, 50)) ?>...</small>
                                <?php else: ?>
                                    <span class="text-muted">Alamat belum diisi</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['tanggal_berdiri']) && $item['tanggal_berdiri']): ?>
                                    <?= date('Y', strtotime($item['tanggal_berdiri'])) ?>
                                    <br>
                                    <small class="text-muted"><?= date('Y') - date('Y', strtotime($item['tanggal_berdiri'])) ?> tahun</small>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($item['telepon']) && $item['telepon']): ?>
                                    <small><i class="bx bx-phone"></i> <?= esc($item['telepon']) ?></small>
                                    <br>
                                <?php endif; ?>
                                <?php if (isset($item['status']) && $item['status']): ?>
                                    <small><i class="bx bx-info-circle"></i> Status: <?= esc($item['status']) ?></small>
                                <?php endif; ?>
                                <?php if (!isset($item['telepon']) || !$item['telepon']): ?>
                                    <?php if (!isset($item['status']) || !$item['status']): ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="editKlub(<?= $item['id_klub'] ?>)">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="deleteKlub(<?= $item['id_klub'] ?>)">
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
                                <i class="bx bx-buildings bx-lg mb-2"></i>
                                <p>Belum ada klub. <a href="<?= base_url('admin/klub/create') ?>">Tambah klub pertama</a></p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Klub Modal -->
<div class="modal fade" id="addKlubModal" tabindex="-1" aria-labelledby="addKlubModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKlubModalLabel">Tambah Klub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addKlubForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Klub <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_organisasi" class="form-label">Organisasi <span class="text-danger">*</span></label>
                                <select class="form-select" id="id_organisasi" name="id_organisasi" required>
                                    <option value="">Pilih Organisasi</option>
                                    <?php if (!empty($organisasi)): ?>
                                        <?php foreach ($organisasi as $org): ?>
                                            <option value="<?= $org['id_organisasi'] ?>"><?= esc($org['nama_organisasi']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_berdiri" class="form-label">Tanggal Berdiri</label>
                                <input type="date" class="form-control" id="tanggal_berdiri" name="tanggal_berdiri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
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

<!-- Edit Klub Modal -->
<div class="modal fade" id="editKlubModal" tabindex="-1" aria-labelledby="editKlubModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKlubModalLabel">Edit Klub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKlubForm">
                <input type="hidden" id="edit_id_klub" name="id_klub">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_nama" class="form-label">Nama Klub <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_nama" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_id_organisasi" class="form-label">Organisasi <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_id_organisasi" name="id_organisasi" required>
                                    <option value="">Pilih Organisasi</option>
                                    <?php if (!empty($organisasi)): ?>
                                        <?php foreach ($organisasi as $org): ?>
                                            <option value="<?= $org['id_organisasi'] ?>"><?= esc($org['nama_organisasi']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" id="edit_penanggung_jawab" name="penanggung_jawab">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="edit_telepon" name="telepon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tanggal_berdiri" class="form-label">Tanggal Berdiri</label>
                                <input type="date" class="form-control" id="edit_tanggal_berdiri" name="tanggal_berdiri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3"></textarea>
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

    // Filter by kota
    document.getElementById('filterKota').addEventListener('change', function() {
        const filterValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            if (!filterValue) {
                row.style.display = '';
            } else {
                const alamatCell = row.querySelector('td:nth-child(5)');
                if (alamatCell) {
                    const alamatText = alamatCell.textContent.toLowerCase();
                    row.style.display = alamatText.includes(filterValue) ? '' : 'none';
                }
            }
        });
    });

    // Add Klub Form Submit
    document.getElementById('addKlubForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch('<?= base_url('admin/klub/store') ?>', {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addKlubModal'));
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

    // Edit Klub Form Submit
    document.getElementById('editKlubForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');
        const klubId = document.getElementById('edit_id_klub').value;

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch(`<?= base_url('admin/klub/update') ?>/${klubId}`, {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editKlubModal'));
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

    // Edit Klub Function
    function editKlub(id) {
        fetch(`<?= base_url('admin/klub/get') ?>/${id}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const klub = data.data;

                    document.getElementById('edit_id_klub').value = klub.id_klub;
                    document.getElementById('edit_nama').value = klub.nama || '';
                    document.getElementById('edit_id_organisasi').value = klub.id_organisasi || '';
                    document.getElementById('edit_penanggung_jawab').value = klub.penanggung_jawab || '';
                    document.getElementById('edit_telepon').value = klub.telepon || '';
                    document.getElementById('edit_tanggal_berdiri').value = klub.tanggal_berdiri || '';
                    document.getElementById('edit_status').value = klub.status || '';
                    document.getElementById('edit_alamat').value = klub.alamat || '';

                    const modal = new bootstrap.Modal(document.getElementById('editKlubModal'));
                    modal.show();
                } else {
                    showAlert('error', 'Gagal mengambil data klub');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            });
    }

    // Delete Klub Function
    function deleteKlub(id) {
        if (confirm('Yakin ingin menghapus klub ini?')) {
            fetch(`<?= base_url('admin/klub/delete') ?>/${id}`, {
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
                        showAlert('error', data.message || 'Gagal menghapus klub');
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