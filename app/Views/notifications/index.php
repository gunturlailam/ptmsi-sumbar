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
                                <i class='bx bx-bell me-2'></i>Notifikasi
                            </h2>
                            <p class="text-muted mb-0">Kelola semua notifikasi Anda</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-outline-secondary" onclick="markAllAsRead()">
                                <i class='bx bx-check-double me-2'></i>Tandai Semua Dibaca
                            </button>
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
                        <p class="text-muted">Anda tidak memiliki notifikasi saat ini</p>
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
                                            <span class="badge bg-<?= match ($notif['tipe']) {
                                                                        'event' => 'success',
                                                                        'pertandingan' => 'info',
                                                                        'hasil' => 'warning',
                                                                        'ranking' => 'danger',
                                                                        'sistem' => 'secondary',
                                                                        default => 'secondary'
                                                                    } ?>">
                                                <?= ucfirst($notif['tipe']) ?>
                                            </span>
                                        </div>
                                        <p class="text-muted mb-2">
                                            <?= esc($notif['pesan']) ?>
                                        </p>
                                        <small class="text-muted">
                                            <i class='bx bx-time me-1'></i>
                                            <?= date('d/m/Y H:i', strtotime($notif['dibuat_pada'])) ?>
                                        </small>
                                    </div>
                                    <div class="ms-3">
                                        <?php if (!$notif['dibaca']): ?>
                                            <button class="btn btn-sm btn-outline-primary" onclick="markAsRead(<?= $notif['id_notifikasi'] ?>)">
                                                <i class='bx bx-check'></i>
                                            </button>
                                        <?php endif; ?>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteNotification(<?= $notif['id_notifikasi'] ?>)">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if ($total > $limit): ?>
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=1">First</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <li class="page-item active">
                                <span class="page-link"><?= $page ?></span>
                            </li>

                            <?php if (($page * $limit) < $total): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function markAsRead(id) {
        fetch('<?= base_url('notifications/mark-read') ?>/' + id, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
    }

    function markAllAsRead() {
        fetch('<?= base_url('notifications/mark-all-read') ?>', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
    }

    function deleteNotification(id) {
        if (confirm('Hapus notifikasi ini?')) {
            fetch('<?= base_url('notifications/delete') ?>/' + id, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }
    }
</script>
<?= $this->endSection() ?>