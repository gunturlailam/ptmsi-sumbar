<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 1100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Daftar Galeri</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahGaleri"><i class="bi bi-plus-circle"></i> Tambah Galeri</button>
        </div>
        <?php if (!empty($galeri)): ?>
            <div class="row g-3">
                <?php foreach ($galeri as $item): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="<?= base_url($item['file'] ?? 'assets/img/no-image.png') ?>" class="card-img-top" alt="<?= esc($item['judul']) ?>">
                            <div class="card-body">
                                <h5 class="card-title mb-2"><?= esc($item['judul']) ?></h5>
                                <span class="badge bg-primary mb-2"><?= esc($item['jenis_media']) ?></span>
                                <p class="mb-0"><small><?= esc($item['nama_event'] ?? '-') ?></small></p>
                                <div class="d-flex justify-content-end mt-2">
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditGaleri<?= $item['id_galeri'] ?>"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusGaleri<?= $item['id_galeri'] ?>"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit Galeri -->
                    <div class="modal fade" id="modalEditGaleri<?= $item['id_galeri'] ?>" tabindex="-1" aria-labelledby="modalEditGaleriLabel<?= $item['id_galeri'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?= base_url('admin/galeri/update/' . $item['id_galeri']) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <?= csrf_field() ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditGaleriLabel<?= $item['id_galeri'] ?>">Edit Galeri</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul<?= $item['id_galeri'] ?>" class="form-label">Judul</label>
                                            <input type="text" class="form-control" id="judul<?= $item['id_galeri'] ?>" name="judul" value="<?= esc($item['judul']) ?>" required>
                                            <div class="invalid-feedback">Judul wajib diisi.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_media<?= $item['id_galeri'] ?>" class="form-label">Jenis Media</label>
                                            <select class="form-select" id="jenis_media<?= $item['id_galeri'] ?>" name="jenis_media" required>
                                                <option value="">Pilih Jenis</option>
                                                <option value="foto" <?= $item['jenis_media'] === 'foto' ? 'selected' : '' ?>>Foto</option>
                                                <option value="video" <?= $item['jenis_media'] === 'video' ? 'selected' : '' ?>>Video</option>
                                            </select>
                                            <div class="invalid-feedback">Jenis media wajib dipilih.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file<?= $item['id_galeri'] ?>" class="form-label">Ganti File (opsional)</label>
                                            <input class="form-control" type="file" id="file<?= $item['id_galeri'] ?>" name="file">
                                            <?php if (!empty($item['file'])): ?>
                                                <div class="mt-2">
                                                    <img src="<?= base_url($item['file']) ?>" alt="File Galeri" class="img-thumbnail" style="max-width: 200px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_event<?= $item['id_galeri'] ?>" class="form-label">Nama Event (opsional)</label>
                                            <input type="text" class="form-control" id="nama_event<?= $item['id_galeri'] ?>" name="nama_event" value="<?= esc($item['nama_event']) ?>">
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
                    <!-- Modal Hapus Galeri -->
                    <div class="modal fade" id="modalHapusGaleri<?= $item['id_galeri'] ?>" tabindex="-1" aria-labelledby="modalHapusGaleriLabel<?= $item['id_galeri'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="<?= base_url('admin/galeri/delete/' . $item['id_galeri']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHapusGaleriLabel<?= $item['id_galeri'] ?>">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus galeri <strong><?= esc($item['judul']) ?></strong>?</p>
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
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">Belum ada data galeri.</div>
        <?php endif; ?>

        <!-- Modal Tambah Galeri -->
        <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-labelledby="modalTambahGaleriLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('admin/galeri/store') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahGaleriLabel">Tambah Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                                <div class="invalid-feedback">Judul wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_media" class="form-label">Jenis Media</label>
                                <select class="form-select" id="jenis_media" name="jenis_media" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="foto">Foto</option>
                                    <option value="video">Video</option>
                                </select>
                                <div class="invalid-feedback">Jenis media wajib dipilih.</div>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input class="form-control" type="file" id="file" name="file" required>
                                <div class="invalid-feedback">File wajib diunggah.</div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_event" class="form-label">Nama Event (opsional)</label>
                                <input type="text" class="form-control" id="nama_event" name="nama_event">
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