<?php
if (!function_exists('getBadgeColor')) {
    function getBadgeColor($kategori)
    {
        switch ($kategori) {
            case 'kejuaraan':
                return 'primary';
            case 'atlet':
                return 'success';
            case 'pengumuman':
                return 'danger';
            case 'artikel':
                return 'info';
            default:
                return 'secondary';
        }
    }
}
?>
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 1100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Daftar Berita</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBerita" title="Tambah Berita">
                <i class="bx bx-plus"></i>
            </button>
        </div>
        <?php if (!empty($berita)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($berita as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if (!empty($item['foto'])): ?>
                                            <img src="<?= base_url($item['foto']) ?>" alt="Foto" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bx bx-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-semibold"><?= esc($item['judul']) ?></div>
                                            <small class="text-muted"><?= esc(substr($item['konten'], 0, 50)) ?>...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-<?= getBadgeColor($item['kategori'] ?? '') ?>"><?= ucfirst(esc($item['kategori'] ?? '')) ?></span></td>
                                <td>
                                    <span class="badge bg-<?= $item['status'] === 'published' ? 'success' : 'warning' ?>">
                                        <?= $item['status'] === 'published' ? 'Published' : 'Draft' ?>
                                    </span>
                                </td>
                                <td><?= esc($item['nama_penulis'] ?? '-') ?></td>
                                <td><?= date('d/m/Y', strtotime($item['tanggal_publikasi'])) ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-info btn-sm" onclick="previewBerita('<?= esc($item['judul']) ?>', '<?= esc($item['konten']) ?>', '<?= $item['foto'] ? base_url($item['foto']) : '' ?>')" title="Lihat Preview">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditBerita<?= $item['id_berita'] ?>" title="Edit Berita">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusBerita<?= $item['id_berita'] ?>" title="Hapus Berita">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit Berita -->
                            <div class="modal fade" id="modalEditBerita<?= $item['id_berita'] ?>" tabindex="-1" aria-labelledby="modalEditBeritaLabel<?= $item['id_berita'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/berita/update/' . $item['id_berita']) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditBeritaLabel<?= $item['id_berita'] ?>">Edit Berita</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="judul<?= $item['id_berita'] ?>" class="form-label">Judul</label>
                                                    <input type="text" class="form-control" id="judul<?= $item['id_berita'] ?>" name="judul" value="<?= esc($item['judul']) ?>" required>
                                                    <div class="invalid-feedback">Judul wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="slug<?= $item['id_berita'] ?>" class="form-label">Slug</label>
                                                    <input type="text" class="form-control" id="slug<?= $item['id_berita'] ?>" name="slug" value="<?= esc($item['slug']) ?>" required>
                                                    <div class="invalid-feedback">Slug wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori<?= $item['id_berita'] ?>" class="form-label">Kategori</label>
                                                    <select class="form-select" id="kategori<?= $item['id_berita'] ?>" name="kategori" required>
                                                        <option value="">Pilih Kategori</option>
                                                        <option value="kejuaraan" <?= $item['kategori'] === 'kejuaraan' ? 'selected' : '' ?>>Kejuaraan</option>
                                                        <option value="atlet" <?= $item['kategori'] === 'atlet' ? 'selected' : '' ?>>Atlet</option>
                                                        <option value="pengumuman" <?= $item['kategori'] === 'pengumuman' ? 'selected' : '' ?>>Pengumuman</option>
                                                        <option value="artikel" <?= $item['kategori'] === 'artikel' ? 'selected' : '' ?>>Artikel</option>
                                                    </select>
                                                    <div class="invalid-feedback">Kategori wajib dipilih.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="konten<?= $item['id_berita'] ?>" class="form-label">Isi Berita</label>
                                                    <textarea class="form-control" id="konten<?= $item['id_berita'] ?>" name="konten" rows="5" required><?= esc($item['konten']) ?></textarea>
                                                    <div class="invalid-feedback">Isi berita wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status<?= $item['id_berita'] ?>" class="form-label">Status</label>
                                                    <select class="form-select" id="status<?= $item['id_berita'] ?>" name="status" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="draft" <?= $item['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                                                        <option value="published" <?= $item['status'] === 'published' ? 'selected' : '' ?>>Published</option>
                                                    </select>
                                                    <div class="invalid-feedback">Status wajib dipilih.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tanggal_publikasi<?= $item['id_berita'] ?>" class="form-label">Tanggal Publikasi</label>
                                                    <input type="datetime-local" class="form-control" id="tanggal_publikasi<?= $item['id_berita'] ?>" name="tanggal_publikasi" value="<?= date('Y-m-d\TH:i', strtotime($item['tanggal_publikasi'])) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="foto<?= $item['id_berita'] ?>" class="form-label">Ganti Gambar (opsional)</label>
                                                    <input class="form-control" type="file" id="foto<?= $item['id_berita'] ?>" name="foto" accept="image/*">
                                                    <?php if (!empty($item['foto'])): ?>
                                                        <div class="mt-2">
                                                            <img src="<?= base_url($item['foto']) ?>" alt="Gambar Berita" class="img-thumbnail" style="max-width: 200px;">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Batal">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary" title="Update Berita">
                                                    <i class="bx bx-save"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Hapus Berita -->
                            <div class="modal fade" id="modalHapusBerita<?= $item['id_berita'] ?>" tabindex="-1" aria-labelledby="modalHapusBeritaLabel<?= $item['id_berita'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/berita/delete/' . $item['id_berita']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusBeritaLabel<?= $item['id_berita'] ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin ingin menghapus berita <strong><?= esc($item['judul']) ?></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Batal">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                                <button type="submit" class="btn btn-danger" title="Hapus Berita">
                                                    <i class="bx bx-trash"></i>
                                                </button>
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
            <div class="alert alert-info text-center">Belum ada data berita.</div>
        <?php endif; ?>

        <!-- Modal Tambah Berita -->
        <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('admin/berita/store') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                                <div class="invalid-feedback">Judul wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                                <div class="invalid-feedback">Slug wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="kejuaraan">Kejuaraan</option>
                                    <option value="atlet">Atlet</option>
                                    <option value="pengumuman">Pengumuman</option>
                                    <option value="artikel">Artikel</option>
                                </select>
                                <div class="invalid-feedback">Kategori wajib dipilih.</div>
                            </div>
                            <div class="mb-3">
                                <label for="konten" class="form-label">Isi Berita</label>
                                <textarea class="form-control" id="konten" name="konten" rows="5" required></textarea>
                                <div class="invalid-feedback">Isi berita wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                                <div class="invalid-feedback">Status wajib dipilih.</div>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                                <input type="datetime-local" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi" value="<?= date('Y-m-d\TH:i') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Gambar (opsional)</label>
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Batal">
                                <i class="bx bx-x"></i>
                            </button>
                            <button type="submit" class="btn btn-primary" title="Simpan Berita">
                                <i class="bx bx-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Preview Berita -->
        <div class="modal fade" id="modalPreviewBerita" tabindex="-1" aria-labelledby="modalPreviewBeritaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPreviewBeritaLabel">Preview Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="previewContent">
                            <h4 id="previewJudul"></h4>
                            <div id="previewFoto" class="mb-3"></div>
                            <div id="previewKonten"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Tutup">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
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

            // Auto generate slug from title
            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
            }

            // For add form
            document.getElementById('judul').addEventListener('input', function() {
                document.getElementById('slug').value = generateSlug(this.value);
            });

            // For edit forms
            <?php foreach ($berita as $item): ?>
                document.getElementById('judul<?= $item['id_berita'] ?>').addEventListener('input', function() {
                    document.getElementById('slug<?= $item['id_berita'] ?>').value = generateSlug(this.value);
                });
            <?php endforeach; ?>

            // Preview berita function
            function previewBerita(judul, konten, foto) {
                document.getElementById('previewJudul').textContent = judul;
                document.getElementById('previewKonten').innerHTML = konten.replace(/\n/g, '<br>');

                const fotoContainer = document.getElementById('previewFoto');
                if (foto) {
                    fotoContainer.innerHTML = '<img src="' + foto + '" class="img-fluid rounded" alt="Foto Berita">';
                } else {
                    fotoContainer.innerHTML = '';
                }

                const modal = new bootstrap.Modal(document.getElementById('modalPreviewBerita'));
                modal.show();
            }
        </script>
    </div>
</div>
// ...existing code...
<?= $this->endSection() ?>