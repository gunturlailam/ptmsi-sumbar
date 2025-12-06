<?php $title = isset($title) ? $title : 'Detail Sertifikasi - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
.detail-section {
    background: #E8F2FF;
    min-height: 100vh;
    padding: 48px 0 32px 0;
}

.detail-header {
    background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
    color: #fff;
    border-radius: 20px;
    padding: 40px;
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
    padding: 16px;
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
    font-size: 1rem;
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
    margin-bottom: 24px;
}

.btn-back:hover {
    background: #003366;
    color: #fff;
}

.file-download {
    background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
    color: #fff;
    padding: 16px 24px;
    border-radius: 12px;
    text-align: center;
    margin-top: 20px;
}

.file-download a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.file-download a:hover {
    text-decoration: underline;
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

<section class="detail-section">
    <div class="container">
        <a href="<?= base_url('pembinaan') ?>" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pembinaan
        </a>

        <?php if ($sertifikasi): ?>
        <div class="detail-header">
            <h1 class="detail-title"><?= esc($sertifikasi['jenis_sertifikasi']) ?></h1>
            <div>
                <span class="detail-badge">
                    <i class="bi bi-award"></i> <?= esc($sertifikasi['tingkat_pelatih'] ?? 'N/A') ?>
                </span>
                <?php
                    $isAktif = true;
                    if ($sertifikasi['tanggal_kadaluarsa']) {
                        $isAktif = strtotime($sertifikasi['tanggal_kadaluarsa']) >= strtotime('today');
                    }
                    ?>
                <span class="detail-badge">
                    Status: <?= $isAktif ? 'Aktif' : 'Kadaluarsa' ?>
                </span>
            </div>
        </div>

        <div class="detail-content">
            <h4><i class="bi bi-info-circle"></i> Informasi Sertifikasi</h4>
            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-person"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Nama Pelatih</div>
                        <div class="info-item-value"><?= esc($sertifikasi['nama_pelatih'] ?? 'N/A') ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="bi bi-building"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Klub</div>
                        <div class="info-item-value"><?= esc($sertifikasi['nama_klub'] ?? 'Belum ada klub') ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <i class="bi bi-calendar-check"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Tanggal Dikeluarkan</div>
                        <div class="info-item-value">
                            <?= date('d M Y', strtotime($sertifikasi['tanggal_dikeluarkan'])) ?></div>
                    </div>
                </div>
                <?php if (!empty($sertifikasi['tanggal_kadaluarsa'])): ?>
                <div class="info-item">
                    <i class="bi bi-calendar-x"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Tanggal Kadaluarsa</div>
                        <div class="info-item-value"><?= date('d M Y', strtotime($sertifikasi['tanggal_kadaluarsa'])) ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($sertifikasi['email'])): ?>
                <div class="info-item">
                    <i class="bi bi-envelope"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">Email</div>
                        <div class="info-item-value"><?= esc($sertifikasi['email']) ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($sertifikasi['nohp'])): ?>
                <div class="info-item">
                    <i class="bi bi-telephone"></i>
                    <div class="info-item-content">
                        <div class="info-item-label">No. Telepon</div>
                        <div class="info-item-value"><?= esc($sertifikasi['nohp']) ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($sertifikasi['file_url'])): ?>
        <div class="file-download">
            <a href="<?= base_url($sertifikasi['file_url']) ?>" target="_blank">
                <i class="bi bi-download"></i> Unduh Dokumen Sertifikasi
            </a>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="detail-content text-center">
            <h4>Sertifikasi tidak ditemukan</h4>
            <p>Sertifikasi yang Anda cari tidak tersedia.</p>
            <a href="<?= base_url('pembinaan') ?>" class="btn-back mt-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pembinaan
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('layouts/footer') ?>