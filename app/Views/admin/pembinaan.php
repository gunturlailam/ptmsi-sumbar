<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" style="border-radius: 25px;">
                <div class="card-header bg-primary text-white" style="border-radius: 25px 25px 0 0;">
                    <h4 class="mb-0"><i class="bx bx-chalkboard me-2"></i> Update Program Pembinaan</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/pembinaan/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold">Judul Program</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= esc($pembinaan['judul'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" required><?= esc($pembinaan['deskripsi'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file_pembinaan" class="form-label fw-bold">Upload File (Opsional)</label>
                            <input class="form-control" type="file" id="file_pembinaan" name="file_pembinaan" accept=".pdf,.doc,.docx">
                            <?php if (!empty($pembinaan['file'])): ?>
                                <div class="mt-2">
                                    <a href="<?= base_url($pembinaan['file']) ?>" target="_blank" class="btn btn-outline-info btn-sm" title="Lihat File Sebelumnya">
                                        <i class="bx bx-show"></i> Lihat File Sebelumnya
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4" title="Simpan Pembinaan">
                                <i class="bx bx-save me-2"></i> Simpan Pembinaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>