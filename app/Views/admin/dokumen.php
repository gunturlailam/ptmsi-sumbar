<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
        <span class="text-muted fw-light">Manajemen Data /</span> Dokumen
    </h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen">
        <i class="bx bx-plus me-1"></i> Tambah Dokumen
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

<!-- Document Categories Overview -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Peraturan</h6>
                        <h4 class="mb-0"><?= count(array_filter($dokumen ?? [], fn($d) => $d['kategori'] === 'Peraturan')) ?></h4>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-light">
                            <i class="bx bx-file-blank bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Formulir</h6>
                        <h4 class="mb-0"><?= count(array_filter($dokumen ?? [], fn($d) => $d['kategori'] === 'Formulir')) ?></h4>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-light">
                            <i class="bx bx-edit bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Panduan</h6>
                        <h4 class="mb-0"><?= count(array_filter($dokumen ?? [], fn($d) => $d['kategori'] === 'Panduan')) ?></h4>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-light">
                            <i class="bx bx-book bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Laporan</h6>
                        <h4 class="mb-0"><?= count(array_filter($dokumen ?? [], fn($d) => $d['kategori'] === 'Laporan')) ?></h4>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-light">
                            <i class="bx bx-chart bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Dokumen</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari dokumen..." id="searchInput" style="width: 250px;">
            <select class="form-select form-select-sm" id="filterKategori" style="width: 150px;">
                <option value="">Semua Kategori</option>
                <option value="Peraturan">Peraturan</option>
                <option value="Formulir">Formulir</option>
                <option value="Panduan">Panduan</option>
                <option value="Laporan">Laporan</option>
                <option value="Sertifikat">Sertifikat</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Judul Dokumen</th>
                    <th width="15%">Kategori</th>
                    <th width="15%">Pengunggah</th>
                    <th width="12%">Tanggal Upload</th>
                    <th width="10%">Ukuran File</th>
                    <th width="8%">File</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($dokumen)): ?>
                    <?php foreach ($dokumen as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <?php
                                        $extension = pathinfo($item['file_url'] ?? '', PATHINFO_EXTENSION);
                                        $iconClass = match (strtolower($extension)) {
                                            'pdf' => 'bx-file-pdf text-danger',
                                            'doc', 'docx' => 'bx-file-doc text-primary',
                                            'xls', 'xlsx' => 'bx-file text-success',
                                            'ppt', 'pptx' => 'bx-file text-warning',
                                            default => 'bx-file text-secondary'
                                        };
                                        ?>
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx <?= $iconClass ?> bx-sm"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <strong><?= esc($item['judul']) ?></strong>
                                        <br>
                                        <small class="text-muted"><?= strtoupper($extension) ?> File</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php
                                $badgeClass = match ($item['kategori']) {
                                    'Peraturan' => 'bg-label-primary',
                                    'Formulir' => 'bg-label-success',
                                    'Panduan' => 'bg-label-info',
                                    'Laporan' => 'bg-label-warning',
                                    'Sertifikat' => 'bg-label-secondary',
                                    default => 'bg-label-dark'
                                };
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= esc($item['kategori']) ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xs me-2">
                                        <span class="avatar-initial rounded-circle bg-label-info">
                                            <?= strtoupper(substr($item['nama_pengunggah'] ?? 'A', 0, 1)) ?>
                                        </span>
                                    </div>
                                    <span><?= esc($item['nama_pengunggah'] ?? 'Admin') ?></span>
                                </div>
                            </td>
                            <td>
                                <small><?= date('d M Y', strtotime($item['diunggah_pada'])) ?></small>
                                <br>
                                <small class="text-muted"><?= date('H:i', strtotime($item['diunggah_pada'])) ?></small>
                            </td>
                            <td>
                                <?php if (!empty($item['file_url']) && file_exists($item['file_url'])): ?>
                                    <small><?= number_format(filesize($item['file_url']) / 1024, 1) ?> KB</small>
                                <?php else: ?>
                                    <small class="text-muted">-</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($item['file_url'])): ?>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url($item['file_url']) ?>" target="_blank" class="btn btn-outline-info btn-sm" title="Lihat File">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="<?= base_url($item['file_url']) ?>" download class="btn btn-outline-success btn-sm" title="Download File">
                                            <i class="bx bx-download"></i>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="editDokumen(<?= $item['id_dokumen'] ?>)" title="Edit Dokumen">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteDokumen(<?= $item['id_dokumen'] ?>)" title="Hapus Dokumen">
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
                                <i class="bx bx-file bx-lg mb-2"></i>
                                <p>Belum ada dokumen. <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen">Tambah dokumen pertama</a></p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Dokumen -->
<div class="modal fade" id="modalTambahDokumen" tabindex="-1" aria-labelledby="modalTambahDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahDokumenLabel">Tambah Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addDokumenForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Peraturan">Peraturan</option>
                                    <option value="Formulir">Formulir</option>
                                    <option value="Panduan">Panduan</option>
                                    <option value="Laporan">Laporan</option>
                                    <option value="Sertifikat">Sertifikat</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File Dokumen <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                        <div class="form-text">Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB.</div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang dokumen ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Batal">
                        <i class="bx bx-x"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" title="Simpan Dokumen">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="bx bx-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Dokumen -->
<div class="modal fade" id="editDokumenModal" tabindex="-1" aria-labelledby="editDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDokumenModalLabel">Edit Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDokumenForm" enctype="multipart/form-data">
                <input type="hidden" id="edit_id_dokumen" name="id_dokumen">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="edit_judul" class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_judul" name="judul" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Peraturan">Peraturan</option>
                                    <option value="Formulir">Formulir</option>
                                    <option value="Panduan">Panduan</option>
                                    <option value="Laporan">Laporan</option>
                                    <option value="Sertifikat">Sertifikat</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_file" class="form-label">Ganti File (Opsional)</label>
                        <input class="form-control" type="file" id="edit_file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                        <div class="form-text">Kosongkan jika tidak ingin mengganti file. Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB.</div>
                        <div id="current_file_info" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang dokumen ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Batal">
                        <i class="bx bx-x"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" title="Update Dokumen">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <i class="bx bx-save"></i> Update
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

    // Filter by kategori
    document.getElementById('filterKategori').addEventListener('change', function() {
        const filterValue = this.value;
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            if (!filterValue) {
                row.style.display = '';
            } else {
                const kategoriCell = row.querySelector('td:nth-child(3)');
                if (kategoriCell) {
                    const kategoriText = kategoriCell.textContent.toLowerCase();
                    row.style.display = kategoriText.includes(filterValue.toLowerCase()) ? '' : 'none';
                }
            }
        });
    });

    // Add Dokumen Form Submit
    document.getElementById('addDokumenForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch('<?= base_url('admin/dokumen/store') ?>', {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalTambahDokumen'));
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

    // Edit Dokumen Form Submit
    document.getElementById('editDokumenForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = this.querySelector('button[type="submit"]');
        const spinner = submitBtn.querySelector('.spinner-border');
        const dokumenId = document.getElementById('edit_id_dokumen').value;

        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch(`<?= base_url('admin/dokumen/update') ?>/${dokumenId}`, {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editDokumenModal'));
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

    // Edit Dokumen Function
    function editDokumen(id) {
        fetch(`<?= base_url('admin/dokumen/get') ?>/${id}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const dokumen = data.data;

                    document.getElementById('edit_id_dokumen').value = dokumen.id_dokumen;
                    document.getElementById('edit_judul').value = dokumen.judul || '';
                    document.getElementById('edit_kategori').value = dokumen.kategori || '';
                    document.getElementById('edit_deskripsi').value = dokumen.deskripsi || '';

                    // Show current file info
                    const fileInfo = document.getElementById('current_file_info');
                    if (dokumen.file_url) {
                        fileInfo.innerHTML = `
                            <div class="alert alert-info">
                                <i class="bx bx-file me-2"></i>
                                File saat ini: <a href="${dokumen.file_url}" target="_blank">${dokumen.judul}</a>
                            </div>
                        `;
                    } else {
                        fileInfo.innerHTML = '';
                    }

                    const modal = new bootstrap.Modal(document.getElementById('editDokumenModal'));
                    modal.show();
                } else {
                    showAlert('error', 'Gagal mengambil data dokumen');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan sistem');
            });
    }

    // Delete Dokumen Function
    function deleteDokumen(id) {
        if (confirm('Yakin ingin menghapus dokumen ini?')) {
            fetch(`<?= base_url('admin/dokumen/delete') ?>/${id}`, {
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
                        showAlert('error', data.message || 'Gagal menghapus dokumen');
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