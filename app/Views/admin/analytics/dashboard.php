<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-2">
                                <i class='bx bx-bar-chart me-2'></i>Analytics Dashboard
                            </h3>
                            <p class="text-muted mb-0">Analisis mendalam aktivitas sistem PTMSI</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <form method="GET" class="d-flex gap-2">
                                <input type="date" name="start_date" class="form-control form-control-sm" value="<?= $start_date ?>">
                                <input type="date" name="end_date" class="form-control form-control-sm" value="<?= $end_date ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approval Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-gradient rounded-3 p-3">
                                <i class='bx bx-time-five text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pending Approval</h6>
                            <h3 class="mb-0"><?= $approval_stats['total_pending'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-gradient rounded-3 p-3">
                                <i class='bx bx-check-circle text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Approved</h6>
                            <h3 class="mb-0"><?= $approval_stats['total_approved'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-gradient rounded-3 p-3">
                                <i class='bx bx-x-circle text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Rejected</h6>
                            <h3 class="mb-0"><?= $approval_stats['total_rejected'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-gradient rounded-3 p-3">
                                <i class='bx bx-edit text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Revision</h6>
                            <h3 class="mb-0"><?= $approval_stats['total_revision'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Growth Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-trending-up me-2'></i>Growth Statistics
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>New Athletes</span>
                            <strong><?= $growth_stats['new_atlet'] ?></strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: <?= ($growth_stats['new_atlet'] / max($growth_stats['total_atlet'], 1)) * 100 ?>%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>New Clubs</span>
                            <strong><?= $growth_stats['new_klub'] ?></strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: <?= ($growth_stats['new_klub'] / max($growth_stats['total_klub'], 1)) * 100 ?>%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>New Events</span>
                            <strong><?= $growth_stats['new_event'] ?></strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: <?= ($growth_stats['new_event'] / max($growth_stats['total_event'], 1)) * 100 ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity by Module -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-list-check me-2'></i>Activity by Module
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Module</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end">Success</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($activity_by_module as $activity): ?>
                                    <tr>
                                        <td><?= esc($activity['modul']) ?></td>
                                        <td class="text-end"><?= $activity['total'] ?></td>
                                        <td class="text-end">
                                            <span class="badge bg-success"><?= $activity['sukses'] ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Users -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-user-circle me-2'></i>Top Users by Activity
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php foreach ($top_users as $user): ?>
                            <div class="list-group-item px-4 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><?= esc($user['nama_lengkap']) ?></span>
                                    <span class="badge bg-primary"><?= $user['total_aksi'] ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Failed Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class='bx bx-error-circle me-2'></i>Failed Actions
                    </h5>
                    <a href="<?= base_url('admin/analytics/audit-log?status=gagal') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($failed_actions)): ?>
                        <div class="p-4 text-center text-muted">
                            No failed actions
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Aksi</th>
                                        <th>Modul</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($failed_actions as $action): ?>
                                        <tr>
                                            <td><?= date('d/m/Y H:i', strtotime($action['dibuat_pada'])) ?></td>
                                            <td><?= esc($action['nama_lengkap'] ?? 'System') ?></td>
                                            <td><span class="badge bg-danger"><?= esc($action['aksi']) ?></span></td>
                                            <td><?= esc($action['modul']) ?></td>
                                            <td><?= esc(substr($action['deskripsi'] ?? '', 0, 50)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class='bx bx-link me-2'></i>Quick Links
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="<?= base_url('admin/analytics/audit-log') ?>" class="btn btn-outline-primary w-100">
                                <i class='bx bx-history me-2'></i>Audit Log
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= base_url('admin/analytics/approval-workflow') ?>" class="btn btn-outline-success w-100">
                                <i class='bx bx-check-double me-2'></i>Approval Workflow
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= base_url('admin/analytics/export-audit-log') ?>" class="btn btn-outline-info w-100">
                                <i class='bx bx-download me-2'></i>Export Audit Log
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= base_url('admin/analytics/backup') ?>" class="btn btn-outline-warning w-100">
                                <i class='bx bx-save me-2'></i>Backup & Export
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>