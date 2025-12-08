<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-0">
        <span class="text-muted fw-light">Manajemen Konten /</span> Berita
    </h4>
    <a href="<?= base_url('admin/berita/create') ?>" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Tambah Berita
    </a>
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
        <h5 class="mb-0">Daftar Berita</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari berita..." id="searchInput" style="width: 250px;">
            <select class="form-select form-select-sm" id="filterKategori" style="width: 150px;">
                <option value="">Semua Kategori</option>
                <option value="pengumuman">Pengumuman</option>
                <option value="prestasi">Prestasi</option>
                <option value="kegiatan">Kegiatan</option>
                <option value="umum">Umum</option>
            </select>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Gambar</th>
                    <th width="30%">Judul</th>
                    <th width="12%">Kategori</th>
                    <th width="12%">Tanggal</th>
                    <th width="10%">Status</th>
                    <th width="8%">Views</th>
                    <th width="13%">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($berita)): ?>
                    <?php foreach ($berita as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <?php if ($item['gambar']): ?>
                                    <img src="<?= base_url($item['gambar']) ?>" alt="<?= esc($item['judul']) ?>" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-label-secondary rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                        <i class="bx bx-image"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= esc($item['judul']) ?></strong>
                                <br>
                                <small class="text-muted"><?= esc(substr(strip_tags($item['konten']), 0, 60)) ?>...</small>
                            </td>
                            <td>
                                <span class="badge bg-label-info"><?= esc(ucfirst($item['kategori'])) ?></span>
                            </td>
                            <td><?= date('d M Y', strtotime($item['tanggal_publikasi'])) ?></td>
                            <td>
                                <?php if ($item['status'] === 'published'): ?>
                                    <span class="badge bg-label-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-label-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $item['views'] ?? 0 ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= base_url('berita/' . $item['slug']) ?>" target="_blank">
                                            <i class="bx bx-show me-1"></i> Lihat
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('admin/berita/edit/' . $item['id']) ?>">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('admin/berita/delete/' . $item['id']) ?>" onclick="return confirm('Yakin ingin menghapus berita ini?')">
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
                                <i class="bx bx-news bx-lg mb-2"></i>
                                <p>Belum ada berita. <a href="<?= base_url('admin/berita/create') ?>">Tambah berita pertama</a></p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Simple filter functionality
    document.getElementById('filterKategori').addEventListener('change', function() {
        const filterValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            if (!filterValue) {
                row.style.display = '';
            } else {
                const kategori = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                row.style.display = kategori.includes(filterValue) ? '' : 'none';
            }
        });
    });
</script>
<?= $this->endSection() ?>