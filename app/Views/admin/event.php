<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 1100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Daftar Event & Kejuaraan</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahEvent"><i class="bi bi-plus-circle"></i> Tambah Event</button>
        </div>
        <?php if (!empty($events)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Turnamen</th>
                            <th>Penyelenggara</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($item['judul']) ?></td>
                                <td><?= esc($item['nama_turnamen'] ?? '-') ?></td>
                                <td><?= esc($item['nama_klub'] ?? '-') ?></td>
                                <td><span class="badge bg-info"><?= esc($item['status']) ?></span></td>
                                <td><?= date('d/m/Y', strtotime($item['tanggal_mulai'])) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditEvent<?= $item['id_event'] ?>"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusEvent<?= $item['id_event'] ?>"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Modal Edit Event -->
                            <div class="modal fade" id="modalEditEvent<?= $item['id_event'] ?>" tabindex="-1" aria-labelledby="modalEditEventLabel<?= $item['id_event'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/event/update/' . $item['id_event']) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditEventLabel<?= $item['id_event'] ?>">Edit Event</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="judul<?= $item['id_event'] ?>" class="form-label">Judul</label>
                                                    <input type="text" class="form-control" id="judul<?= $item['id_event'] ?>" name="judul" value="<?= esc($item['judul']) ?>" required>
                                                    <div class="invalid-feedback">Judul wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_turnamen<?= $item['id_event'] ?>" class="form-label">Turnamen</label>
                                                    <input type="text" class="form-control" id="nama_turnamen<?= $item['id_event'] ?>" name="nama_turnamen" value="<?= esc($item['nama_turnamen']) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_klub<?= $item['id_event'] ?>" class="form-label">Penyelenggara</label>
                                                    <input type="text" class="form-control" id="nama_klub<?= $item['id_event'] ?>" name="nama_klub" value="<?= esc($item['nama_klub']) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status<?= $item['id_event'] ?>" class="form-label">Status</label>
                                                    <input type="text" class="form-control" id="status<?= $item['id_event'] ?>" name="status" value="<?= esc($item['status']) ?>" required>
                                                    <div class="invalid-feedback">Status wajib diisi.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tanggal_mulai<?= $item['id_event'] ?>" class="form-label">Tanggal Mulai</label>
                                                    <input type="date" class="form-control" id="tanggal_mulai<?= $item['id_event'] ?>" name="tanggal_mulai" value="<?= date('Y-m-d', strtotime($item['tanggal_mulai'])) ?>" required>
                                                    <div class="invalid-feedback">Tanggal mulai wajib diisi.</div>
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
                            <!-- Modal Hapus Event -->
                            <div class="modal fade" id="modalHapusEvent<?= $item['id_event'] ?>" tabindex="-1" aria-labelledby="modalHapusEventLabel<?= $item['id_event'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/event/delete/' . $item['id_event']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusEventLabel<?= $item['id_event'] ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin ingin menghapus event <strong><?= esc($item['judul']) ?></strong>?</p>
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
            <div class="alert alert-info text-center">Belum ada data event.</div>
        <?php endif; ?>

        <!-- Modal Tambah Event -->
        <div class="modal fade" id="modalTambahEvent" tabindex="-1" aria-labelledby="modalTambahEventLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('admin/event/store') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahEventLabel">Tambah Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                                <div class="invalid-feedback">Judul wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_turnamen" class="form-label">Turnamen</label>
                                <input type="text" class="form-control" id="nama_turnamen" name="nama_turnamen">
                            </div>
                            <div class="mb-3">
                                <label for="nama_klub" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control" id="nama_klub" name="nama_klub">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" required>
                                <div class="invalid-feedback">Status wajib diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                <div class="invalid-feedback">Tanggal mulai wajib diisi.</div>
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