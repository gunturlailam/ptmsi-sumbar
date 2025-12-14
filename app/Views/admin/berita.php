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
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahBerita"><i class="bi bi-plus-circle"></i> Tambah Berita</button>
        </div>
        <?php if (!empty($berita)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($berita as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($item['judul']) ?></td>
                                <td><span class="badge bg-<?= getBadgeColor($item['kategori'] ?? '') ?>"><?= ucfirst(esc($item['kategori'] ?? '')) ?></span></td>
                                <td><?= esc($item['nama_penulis'] ?? '-') ?></td>
                                <td><?= date('d/m/Y', strtotime($item['tanggal_publikasi'])) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditBerita<?= $item['id_berita'] ?>"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusBerita<?= $item['id_berita'] ?>"><i class="bi bi-trash"></i></button>
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
                                                    <label for="isi<?= $item['id_berita'] ?>" class="form-label">Isi Berita</label>
                                                    <textarea class="form-control" id="isi<?= $item['id_berita'] ?>" name="isi" rows="5" required><?= esc($item['isi']) ?></textarea>
                                                    <div class="invalid-feedback">Isi berita wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar<?= $item['id_berita'] ?>" class="form-label">Ganti Gambar (opsional)</label>
                                                    <input class="form-control" type="file" id="gambar<?= $item['id_berita'] ?>" name="gambar" accept="image/*">
                                                    <?php if (!empty($item['gambar'])): ?>
                                                        <div class="mt-2">
                                                            <img src="<?= base_url($item['gambar']) ?>" alt="Gambar Berita" class="img-thumbnail" style="max-width: 200px;">
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
                                <label for="isi" class="form-label">Isi Berita</label>
                                <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                                <div class="invalid-feedback">Isi berita wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar (opsional)</label>
                                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
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
// ...existing code...
<?= $this->endSection() ?>