<?php $title = isset($title) ? $title : 'Daftar Turnamen - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    .turnamen-section {
        background: #E8F2FF;
        min-height: 100vh;
        padding: 48px 0 32px 0;
    }

    .turnamen-title {
        color: #003366;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 36px;
        text-align: center;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .turnamen-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }

    .turnamen-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        padding: 28px;
        transition: transform 0.3s, box-shadow 0.3s;
        border-left: 4px solid #1E90FF;
    }

    .turnamen-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.15);
    }

    .turnamen-card h3 {
        color: #003366;
        font-weight: bold;
        margin-bottom: 16px;
        font-size: 1.4rem;
    }

    .turnamen-badge {
        display: inline-block;
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .turnamen-info {
        color: #555;
        margin-bottom: 8px;
    }

    .turnamen-info i {
        color: #1E90FF;
        margin-right: 8px;
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
</style>

<section class="turnamen-section">
    <div class="container">
        <div class="turnamen-title">
            <i class="bi bi-trophy-fill"></i> Daftar Turnamen
        </div>

        <?php if (!empty($turnamen)): ?>
            <div class="turnamen-grid">
                <?php foreach ($turnamen as $t): ?>
                    <div class="turnamen-card">
                        <h3><?= esc($t['nama']) ?></h3>
                        <span class="turnamen-badge"><?= esc(ucfirst($t['tingkat'])) ?></span>
                        <div class="turnamen-info">
                            <i class="bi bi-calendar"></i>
                            <strong>Tahun Musim:</strong> <?= esc($t['tahun_musim']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-trophy"></i>
                <h4>Tidak ada turnamen tersedia</h4>
                <p>Belum ada turnamen yang terdaftar saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->include('layouts/footer') ?>