<?php $title = 'Atlet & Pelatih PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    .atlet-pelatih-section {
        background: #E8F2FF;
        min-height: 100vh;
        padding: 48px 0 32px 0;
    }

    .atlet-pelatih-title {
        color: #003366;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 36px;
        text-align: center;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .ap-grid {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 32px;
    }

    .ap-col {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 4px 24px rgba(30, 144, 255, 0.09);
        padding: 32px 24px;
        min-width: 320px;
        max-width: 480px;
        flex: 1 1 320px;
    }

    .ap-col h3 {
        color: #1E90FF;
        font-weight: bold;
        margin-bottom: 24px;
        text-align: center;
        letter-spacing: 1px;
    }

    .ap-list {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        justify-content: center;
    }

    .ap-card {
        background: #E8F2FF;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.07);
        padding: 18px 12px;
        min-width: 140px;
        max-width: 180px;
        text-align: center;
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ap-card:hover {
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
        transform: translateY(-4px) scale(1.04);
    }

    .ap-card img {
        border-radius: 50%;
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.09);
        width: 64px;
        height: 64px;
        object-fit: cover;
        margin-bottom: 10px;
        border: 2px solid #1E90FF;
        background: #fff;
    }

    .ap-card .ap-nama {
        font-weight: bold;
        color: #003366;
        font-size: 1.07rem;
        margin-bottom: 2px;
    }

    .ap-card .ap-klub {
        color: #1E90FF;
        font-size: 0.97rem;
        margin-bottom: 0;
    }

    @media (max-width: 991px) {
        .ap-grid {
            flex-direction: column;
            gap: 18px;
        }

        .ap-col {
            max-width: 100%;
        }
    }

    @media (max-width: 767px) {
        .atlet-pelatih-title {
            font-size: 1.2rem;
        }

        .ap-col {
            padding: 16px 6px;
        }

        .ap-list {
            gap: 10px;
        }
    }
</style>

<section class="atlet-pelatih-section">
    <div class="container">
        <div class="atlet-pelatih-title">Atlet & Pelatih PTMSI Sumbar</div>
        <div class="ap-grid">
            <div class="ap-col">
                <h3>Atlet</h3>
                <div class="ap-list">
                    <?php foreach ($atlet as $a): ?>
                        <div class="ap-card">
                            <img src="<?= base_url($a['foto'] ?? 'assets/img/orang.jpg') ?>" alt="<?= esc($a['nama']) ?>">
                            <div class="ap-nama"><?= esc($a['nama']) ?></div>
                            <div class="ap-klub"><?= esc($a['klub']) ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="ap-col">
                <h3>Pelatih</h3>
                <div class="ap-list">
                    <?php foreach ($pelatih as $p): ?>
                        <div class="ap-card">
                            <img src="<?= base_url($p['foto'] ?? 'assets/img/orang.jpg') ?>" alt="<?= esc($p['nama']) ?>">
                            <div class="ap-nama"><?= esc($p['nama']) ?></div>
                            <div class="ap-klub"><?= esc($p['klub']) ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('layouts/footer') ?>