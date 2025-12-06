<?php $title = isset($title) ? $title : 'Hasil Pertandingan - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
.hasil-section {
    background: #E8F2FF;
    min-height: 100vh;
    padding: 48px 0 32px 0;
}

.hasil-title {
    color: #003366;
    font-weight: bold;
    font-size: 2rem;
    margin-bottom: 36px;
    text-align: center;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.hasil-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
    padding: 32px;
    margin-bottom: 24px;
}

.hasil-card h4 {
    color: #003366;
    font-weight: bold;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #E8F2FF;
}

.hasil-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
}

.hasil-info-item {
    padding: 16px;
    background: #F8F9FA;
    border-radius: 12px;
}

.hasil-info-item-label {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 6px;
}

.hasil-info-item-value {
    font-weight: 600;
    color: #003366;
    font-size: 1.1rem;
}

.skor-box {
    background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
    color: #fff;
    padding: 24px;
    border-radius: 12px;
    text-align: center;
    margin-top: 20px;
}

.skor-box h5 {
    margin-bottom: 12px;
    font-weight: 600;
}

.skor-content {
    font-size: 1.2rem;
    white-space: pre-line;
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

<section class="hasil-section">
    <div class="container">
        <div class="hasil-title">
            <i class="bi bi-trophy-fill"></i> Hasil Pertandingan
        </div>

        <?php if (!empty($hasil)): ?>
        <?php if (is_array($hasil) && isset($hasil[0])): ?>
        <?php foreach ($hasil as $h): ?>
        <div class="hasil-card">
            <h4><i class="bi bi-info-circle"></i> Detail Hasil Pertandingan</h4>
            <div class="hasil-info">
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Event</div>
                    <div class="hasil-info-item-value"><?= esc($h['nama_event'] ?? '-') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Babak</div>
                    <div class="hasil-info-item-value"><?= esc($h['babak'] ?? '-') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Pemenang</div>
                    <div class="hasil-info-item-value"><?= esc($h['nama_pemenang'] ?? 'Belum ditentukan') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Pelapor</div>
                    <div class="hasil-info-item-value"><?= esc($h['nama_pelapor'] ?? '-') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Dicatat Pada</div>
                    <div class="hasil-info-item-value"><?= date('d M Y H:i', strtotime($h['dicatat_pada'])) ?></div>
                </div>
            </div>
            <?php if (!empty($h['skor'])): ?>
            <div class="skor-box">
                <h5>Skor Pertandingan</h5>
                <div class="skor-content"><?= esc($h['skor']) ?></div>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="hasil-card">
            <h4><i class="bi bi-info-circle"></i> Detail Hasil Pertandingan</h4>
            <div class="hasil-info">
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Event</div>
                    <div class="hasil-info-item-value"><?= esc($hasil['nama_event'] ?? '-') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Babak</div>
                    <div class="hasil-info-item-value"><?= esc($hasil['babak'] ?? '-') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Pemenang</div>
                    <div class="hasil-info-item-value"><?= esc($hasil['nama_pemenang'] ?? 'Belum ditentukan') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Pelapor</div>
                    <div class="hasil-info-item-value"><?= esc($hasil['nama_pelapor'] ?? '-') ?></div>
                </div>
                <div class="hasil-info-item">
                    <div class="hasil-info-item-label">Dicatat Pada</div>
                    <div class="hasil-info-item-value"><?= date('d M Y H:i', strtotime($hasil['dicatat_pada'])) ?></div>
                </div>
            </div>
            <?php if (!empty($hasil['skor'])): ?>
            <div class="skor-box">
                <h5>Skor Pertandingan</h5>
                <div class="skor-content"><?= esc($hasil['skor']) ?></div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-trophy"></i>
            <h4>Hasil pertandingan belum tersedia</h4>
            <p>Hasil pertandingan akan ditampilkan setelah pertandingan selesai.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('layouts/footer') ?>