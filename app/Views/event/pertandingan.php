<?php $title = isset($title) ? $title : 'Jadwal Pertandingan - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
.pertandingan-section {
    background: #E8F2FF;
    min-height: 100vh;
    padding: 48px 0 32px 0;
}

.pertandingan-title {
    color: #003366;
    font-weight: bold;
    font-size: 2rem;
    margin-bottom: 36px;
    text-align: center;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.table-responsive {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
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

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
    background: #fff;
    border-radius: 18px;
}

.empty-state i {
    font-size: 4rem;
    color: #ccc;
    margin-bottom: 20px;
}
</style>

<section class="pertandingan-section">
    <div class="container">
        <div class="pertandingan-title">
            <i class="bi bi-calendar-event"></i> Jadwal Pertandingan
        </div>

        <?php if (!empty($pertandingan)): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Event</th>
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
                        <td><?= esc($p['nama_event'] ?? '-') ?></td>
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
        <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <h4>Tidak ada pertandingan tersedia</h4>
            <p>Belum ada jadwal pertandingan yang terdaftar saat ini.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('layouts/footer') ?>