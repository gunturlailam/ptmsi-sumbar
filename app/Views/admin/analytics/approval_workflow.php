<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-2">
                        <i class='bx bx-check-double me-2'></i>Approval Workflow
                    </h3>
                    <p class="text-muted mb-0">Kelola permohonan dan persetujuan sistem</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
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
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h3 class="mb-0"><?= $stats['total_pending'] ?></h3>
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
                            <h3 class="mb-0"><?= $stats['total_approved'] ?></h3>
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
                            <h3 class="mb-0"><?= $stats['total_rejected'] ?></h3>
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
                                <i class='bx bx-alarm-exclamation text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Overdue</h6>
                            <h3 class="mb-0"><?= count($stats['overdue']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-time-five me-2'></i>Pending Requests
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($pending_requests)): ?>
                        <div class="p-4 text-center text-muted">
                            <i class='bx bx-check-circle display-4 mb-3'></i>
                            <p>Tidak ada permohonan yang menunggu</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tipe</th>
                                        <th>Prioritas</th>
                                        <th>Tanggal Permohonan</th>
                                        <th>Deadline</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pending_requests as $request): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary"><?= ucfirst($request['tipe_permohonan']) ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                $prioritasClass = match ($request['prioritas']) {
                                                    'urgent' => 'bg-danger',
                                                    'tinggi' => 'bg-warning',
                                                    'normal' => 'bg-info',
                                                    'rendah' => 'bg-secondary',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $prioritasClass ?>"><?= ucfirst($request['prioritas']) ?></span>
                                            </td>
                                            <td>
                                                <small><?= date('d/m/Y H:i', strtotime($request['tanggal_permohonan'])) ?></small>
                                            </td>
                                            <td>
                                                <?php if ($request['deadline']): ?>
                                                    <small><?= date('d/m/Y H:i', strtotime($request['deadline'])) ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small><?= esc(substr($request['catatan_pemohon'] ?? '', 0, 50)) ?></small>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success" title="Approve">
                                                    <i class='bx bx-check'></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Reject">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </td>
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

    <!-- By Type Statistics -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-pie-chart me-2'></i>Requests by Type
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tipe</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end">Pending</th>
                                    <th class="text-end">Approved</th>
                                    <th class="text-end">Rejected</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stats['by_type'] as $type): ?>
                                    <tr>
                                        <td><?= ucfirst($type['tipe_permohonan']) ?></td>
                                        <td class="text-end"><?= $type['total'] ?></td>
                                        <td class="text-end"><span class="badge bg-warning"><?= $type['pending'] ?></span></td>
                                        <td class="text-end"><span class="badge bg-success"><?= $type['approved'] ?></span></td>
                                        <td class="text-end"><span class="badge bg-danger"><?= $type['rejected'] ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>