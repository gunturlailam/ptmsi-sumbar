<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-primary mb-2">
                                <i class='bx bx-bell me-2'></i>Notifikasi - <?= ucfirst(esc($type)) ?>
                            </h2>
                            <p class="text-muted mb-0">Notifikasi tipe <?= ucfirst(esc($type)) ?></p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('notifications') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($notifications)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-4 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Tidak ada notifikasi</h5>
                        <p class="text-muted">Tidak ada notifikasi tipe <?= ucfirst(esc($type)) ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm">
                    <div class="list-group list-group-flush">
                        <?php foreach ($notifications as $notif): ?>
                            <div class="list-group-item px-4 py-3 <?= !$notif['dibaca'] ? 'bg-light' : '' ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <h6 class="mb-0">
                                                <?= esc($notif['judul']) ?>
                                            </h6>
                                            <?php if (!$notif['dibaca']): ?>
                                                <span class="badge bg-primary">Baru</span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-muted small mb-2">
                                            <?= esc($notif['pesan']) ?>
                                        </p>
                                        <small class="text-muted">
                                            <i class='bx bx-time-five'></i>
                                            <?= date('d M Y H:i', strtotime($notif['dibuat_pada'])) ?>
                                        </small>
                                    </div>
                                    <div class="ms-3">
                                        <?php if (!$notif['dibaca']): ?>
                                            <button class="btn btn-sm btn-outline-primary" onclick="markAsRead(<?= $notif['id_notifikasi'] ?>)">
                                                <i class='bx bx-check'></i>
                                            </button>
                                        <?php endif; ?>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteNotif(<?= $notif['id_notifikasi'] ?>)">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function markAsRead(id) {
        fetch('<?= base_url('notifications/mark-as-read') ?>/' + id, {
            method: 'POST'
        }).then(r => r.json()).then(d => {
            if (d.success) location.reload();
        });
    }

    function deleteNotif(id) {
        if (confirm('Hapus notifikasi ini?')) {
            fetch('<?= base_url('notifications/delete') ?>/' + id, {
                method: 'POST'
            }).then(r => r.json()).then(d => {
                if (d.success) location.reload();
            });
        }
    }
</script>
<?= $this->endSection() ?>