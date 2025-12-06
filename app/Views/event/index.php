<?php $title = isset($title) ? $title : 'Kejuaraan & Event - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    .event-section {
        background: #E8F2FF;
        min-height: 100vh;
        padding: 48px 0 32px 0;
    }

    .event-title {
        color: #003366;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 36px;
        text-align: center;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .event-filter {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 32px;
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.08);
    }

    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .event-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        padding: 24px;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 2px solid transparent;
    }

    .event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.15);
        border-color: #1E90FF;
    }

    .event-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 2px solid #E8F2FF;
    }

    .event-card-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.3rem;
        margin: 0;
        flex: 1;
    }

    .event-badge {
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
        margin-left: 12px;
    }

    .event-info {
        margin-bottom: 12px;
    }

    .event-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: #555;
        font-size: 0.95rem;
    }

    .event-info-item i {
        color: #1E90FF;
        margin-right: 10px;
        width: 20px;
    }

    .event-footer {
        margin-top: 20px;
        padding-top: 16px;
        border-top: 2px solid #E8F2FF;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .event-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-aktif {
        background: #d4edda;
        color: #155724;
    }

    .status-selesai {
        background: #f8d7da;
        color: #721c24;
    }

    .status-mendatang {
        background: #fff3cd;
        color: #856404;
    }

    .btn-detail {
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: transform 0.2s;
    }

    .btn-detail:hover {
        color: #fff;
        transform: scale(1.05);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 20px;
    }

    @media (max-width: 767px) {
        .event-title {
            font-size: 1.5rem;
        }

        .event-grid {
            grid-template-columns: 1fr;
        }

        .event-card {
            padding: 18px;
        }
    }
</style>

<section class="event-section">
    <div class="container">
        <div class="event-title">
            <i class="bi bi-trophy-fill"></i> Kejuaraan & Event
        </div>

        <?php if (!empty($turnamen)): ?>
            <div class="event-filter">
                <h5 class="mb-3" style="color: #003366;">
                    <i class="bi bi-funnel-fill"></i> Filter berdasarkan Turnamen
                </h5>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= base_url('event') ?>" class="btn btn-outline-primary btn-sm">
                        Semua
                    </a>
                    <?php foreach ($turnamen as $t): ?>
                        <a href="<?= base_url('event?turnamen=' . $t['id_turnamen']) ?>" class="btn btn-outline-primary btn-sm">
                            <?= esc($t['nama']) ?> (<?= esc($t['tahun_musim']) ?>)
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($events)): ?>
            <div class="event-grid">
                <?php foreach ($events as $event): ?>
                    <div class="event-card">
                        <div class="event-card-header">
                            <h3 class="event-card-title"><?= esc($event['judul']) ?></h3>
                            <span class="event-badge"><?= esc($event['nama_turnamen']) ?></span>
                        </div>

                        <div class="event-info">
                            <div class="event-info-item">
                                <i class="bi bi-calendar-event"></i>
                                <span>
                                    <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?> -
                                    <?= date('d M Y', strtotime($event['tanggal_selesai'])) ?>
                                </span>
                            </div>
                            <div class="event-info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span><?= esc($event['lokasi'] ?? 'Lokasi belum ditentukan') ?></span>
                            </div>
                            <div class="event-info-item">
                                <i class="bi bi-trophy"></i>
                                <span><?= esc($event['tingkat']) ?> - <?= esc($event['tahun_musim']) ?></span>
                            </div>
                            <div class="event-info-item">
                                <i class="bi bi-building"></i>
                                <span>Penyelenggara: <?= esc($event['nama_klub_penyelenggara'] ?? '-') ?></span>
                            </div>
                            <?php if (!empty($event['batas_pendaftaran'])): ?>
                                <div class="event-info-item">
                                    <i class="bi bi-clock-fill"></i>
                                    <span>Batas Pendaftaran: <?= date('d M Y', strtotime($event['batas_pendaftaran'])) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="event-footer">
                            <span class="event-status <?=
                                                        ($event['status'] == 'aktif' || $event['status'] == 'berlangsung') ? 'status-aktif' : (($event['status'] == 'selesai') ? 'status-selesai' : 'status-mendatang')
                                                        ?>">
                                <?= esc(ucfirst($event['status'] ?? 'mendatang')) ?>
                            </span>
                            <a href="<?= base_url('event/detail/' . $event['id_event']) ?>" class="btn-detail">
                                <i class="bi bi-arrow-right-circle"></i> Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-calendar-x"></i>
                <h4>Tidak ada event tersedia</h4>
                <p>Belum ada kejuaraan atau event yang terdaftar saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('layouts/footer') ?>