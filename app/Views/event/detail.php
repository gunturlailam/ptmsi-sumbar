<?php $title = isset($title) ? $title : 'Detail Event - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
.event-detail-section {
    background: #E8F2FF;
    min-height: 100vh;
    padding: 48px 0 32px 0;
}

.detail-header {
    background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
    color: #fff;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(30, 144, 255, 0.2);
}

.detail-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 16px;
}

.detail-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-right: 10px;
    margin-bottom: 10px;
}

.detail-content {
    background: #fff;
    border-radius: 18px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 2px 12px rgba(30, 144, 255, 0.08);
}

.detail-content h4 {
    color: #003366;
    font-weight: bold;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #E8F2FF;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.info-item {
    display: flex;
    align-items: start;
    padding: 12px;
    background: #F8F9FA;
    border-radius: 12px;
}

.info-item i {
    color: #1E90FF;
    margin-right: 12px;
    margin-top: 4px;
    font-size: 1.2rem;
}

.info-item-content {
    flex: 1;
}

.info-item-label {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 4px;
}

.info-item-value {
    font-weight: 600;
    color: #003366;
}

.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

.table {
    margin-bottom: 0;
}

.table thead {
    background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
    color: #fff;
}

.table thead th {
    border: none;
    padding: 14px;
    font-weight: 600;
}

.table tbody tr {
    transition: background 0.2s;
}

.table tbody tr:hover {
    background: #E8F2FF;
}

.btn-back {
    background: #fff;
    color: #003366;
    border: 2px solid #003366;
    padding: 10px 24px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-back:hover {
    background: #003366;
    color: #fff;
}

@media (max-width: 767px) {
    .detail-title {
        font-size: 1.5rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="event-detail-section">
    <div class="container">
        <a href="<?= base_url('event') ?>" class="btn-back mb-4">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
        </a>

        <?php if ($event): ?>
        <div class="detail-header">
            <h1 class="detail-title"><?= esc($event['judul']) ?></h1>
            <div>
                <span class="detail-badge">
                    <i class="bi bi-trophy"></i> <?= esc($event['nama_turnamen']) ?>
                </span>
                <span class="detail-badge">
                    <i class="bi bi-star"></i> <?= esc($event['tingkat']) ?>
                </span>
                <span class="detail-badge">
                    <i class="bi bi-calendar"></i> <?= esc($event['tahun_musim']) ?>
                </span>
                <span class="detail-badge">
                    Status: <?= esc(ucfirst($event['status'] ?? 'mendatang')) ?>
                </span>
            </div>
        </div>

        <div class="detail-content">
            <h4><i class="bi bi-info-circle"></i> Informasi Event</h4>
            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-calendar-event"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Tanggal Mulai</div>
                        <div class="info-item-value"><?= date('d M Y', strtotime($event['tanggal_mulai'])) ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="bi bi-calendar-check"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Tanggal Selesai</div>
                        <div class="info-item-value"><?= date('d M Y', strtotime($event['tanggal_selesai'])) ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Lokasi</div>
                        <div class="info-item-value"><?= esc($event['lokasi'] ?? 'Belum ditentukan') ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="bi bi-building"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Penyelenggara</div>
                        <div class="info-item-value"><?= esc($event['nama_klub_penyelenggara'] ?? '-') ?></div>
                    </div>
                </div>
                <?php if (!empty($event['batas_pendaftaran'])): ?>
                <div class="info-item">
                    <i class="bi bi-clock-fill"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Batas Pendaftaran</div>
                        <div class="info-item-value"><?= date('d M Y', strtotime($event['batas_pendaftaran'])) ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($pendaftaran)): ?>
        <div class="detail-content">
            <h4><i class="bi bi-people-fill"></i> Daftar Pendaftaran</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pendaftar</th>
                            <th>Tipe</th>
                            <th>Tanggal Daftar</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                                foreach ($pendaftaran as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($p['nama_pendaftar'] ?? '-') ?></td>
                            <td>
                                <span class="badge bg-<?= $p['tipe_pendaftar'] == 'klub' ? 'primary' : 'success' ?>">
                                    <?= esc(ucfirst($p['tipe_pendaftar'])) ?>
                                </span>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($p['tanggal_daftar'])) ?></td>
                            <td>
                                <span class="badge bg-<?=
                                                                    ($p['status_pembayaran'] == 'lunas') ? 'success' : (($p['status_pembayaran'] == 'pending') ? 'warning' : 'secondary')
                                                                    ?>">
                                    <?= esc(ucfirst($p['status_pembayaran'] ?? 'belum dibayar')) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($pertandingan)): ?>
        <div class="detail-content">
            <h4><i class="bi bi-trophy-fill"></i> Daftar Pertandingan</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Babak</th>
                            <th>Atlet 1</th>
                            <th>Atlet 2</th>
                            <th>Jadwal</th>
                            <th>Venue</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                                foreach ($pertandingan as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($p['babak'] ?? '-') ?></td>
                            <td><?= esc($p['nama_atlet1'] ?? 'Atlet ID: ' . $p['id_atlet1']) ?></td>
                            <td><?= esc($p['nama_atlet2'] ?? 'Atlet ID: ' . $p['id_atlet2']) ?></td>
                            <td><?= $p['jadwal'] ? date('d M Y H:i', strtotime($p['jadwal'])) : '-' ?></td>
                            <td><?= esc($p['venue'] ?? '-') ?></td>
                            <td>
                                <a href="<?= base_url('event/hasil/' . $p['id_pertandingan']) ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Lihat Hasil
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="detail-content text-center">
            <h4>Event tidak ditemukan</h4>
            <p>Event yang Anda cari tidak tersedia.</p>
            <a href="<?= base_url('event') ?>" class="btn-back mt-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('layouts/footer') ?>