<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 1100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Daftar Dokumen</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen"><i class="bi bi-plus-circle"></i> Tambah Dokumen</button>
        </div>
        <?php if (!empty($dokumen)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengunggah</th>
                            <th>Diunggah Pada</th>
                            <th>File</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dokumen as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($item['judul']) ?></td>
                                <td><?= esc($item['kategori']) ?></td>
                                <td><?= esc($item['nama_pengunggah'] ?? '-') ?></td>
                                <td><?= date('d/m/Y', strtotime($item['diunggah_pada'])) ?></td>
                                <td>
                                    <?php if (!empty($item['file_url'])): ?>
                                        <a href="<?= base_url($item['file_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-earmark-arrow-down"></i> Download</a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditDokumen<?= $item['id_dokumen'] ?>"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusDokumen<?= $item['id_dokumen'] ?>"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Modal Edit Dokumen -->
                            <div class="modal fade" id="modalEditDokumen<?= $item['id_dokumen'] ?>" tabindex="-1" aria-labelledby="modalEditDokumenLabel<?= $item['id_dokumen'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/dokumen/update/' . $item['id_dokumen']) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditDokumenLabel<?= $item['id_dokumen'] ?>">Edit Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="judul<?= $item['id_dokumen'] ?>" class="form-label">Judul</label>
                                                    <input type="text" class="form-control" id="judul<?= $item['id_dokumen'] ?>" name="judul" value="<?= esc($item['judul']) ?>" required>
                                                    <div class="invalid-feedback">Judul wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori<?= $item['id_dokumen'] ?>" class="form-label">Kategori</label>
                                                    <input type="text" class="form-control" id="kategori<?= $item['id_dokumen'] ?>" name="kategori" value="<?= esc($item['kategori']) ?>" required>
                                                    <div class="invalid-feedback">Kategori wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file<?= $item['id_dokumen'] ?>" class="form-label">Ganti File (opsional)</label>
                                                    <input class="form-control" type="file" id="file<?= $item['id_dokumen'] ?>" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                                    <?php if (!empty($item['file_url'])): ?>
                                                        <div class="mt-2">
                                                            <a href="<?= base_url($item['file_url']) ?>" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark"></i> Lihat File</a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Hapus Dokumen -->
                            <div class="modal fade" id="modalHapusDokumen<?= $item['id_dokumen'] ?>" tabindex="-1" aria-labelledby="modalHapusDokumenLabel<?= $item['id_dokumen'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/dokumen/delete/' . $item['id_dokumen']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusDokumenLabel<?= $item['id_dokumen'] ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin ingin menghapus dokumen <strong><?= esc($item['judul']) ?></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">Belum ada data dokumen.</div>
        <?php endif; ?>

        <!-- Modal Tambah Dokumen -->
        <div class="modal fade" id="modalTambahDokumen" tabindex="-1" aria-labelledby="modalTambahDokumenLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('admin/dokumen/store') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahDokumenLabel">Tambah Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                                <div class="invalid-feedback">Judul wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="kategori" name="kategori" required>
                                <div class="invalid-feedback">Kategori wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input class="form-control" type="file" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                                <div class="invalid-feedback">File wajib diunggah.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Bootstrap validation
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }
                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    </div>
</div>
<?= $this->endSection() ?>