<?= $this->include('layouts/header') ?>

<style>
    .ranking-section {
        background: #F0F6FF;
        min-height: 100vh;
        padding: 48px 0 32px 0;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        color: #003366;
        border-radius: 18px 18px 0 0;
        margin-right: 8px;
        background: #E8F2FF;
        transition: background 0.2s, color 0.2s;
    }

    .nav-tabs .nav-link.active {
        background: #1E90FF;
        color: #fff;
        border: none;
    }

    .tab-pane {
        background: #fff;
        border-radius: 0 0 18px 18px;
        box-shadow: 0 2px 16px rgba(30, 144, 255, 0.09);
        padding: 32px 18px;
        margin-bottom: 24px;
    }

    .ranking-list,
    .statistik-list,
    .medali-list {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
    }

    .ranking-card,
    .statistik-card,
    .medali-card {
        background: linear-gradient(135deg, #E8F2FF 60%, #fff 100%);
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.07);
        padding: 22px 28px;
        min-width: 220px;
        max-width: 320px;
        flex: 1 1 220px;
        text-align: left;
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
        position: relative;
    }

    .ranking-card:hover,
    .statistik-card:hover,
    .medali-card:hover {
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
        transform: translateY(-4px) scale(1.04);
    }

    .ranking-posisi {
        position: absolute;
        top: -18px;
        left: -18px;
        background: #1E90FF;
        color: #fff;
        font-weight: bold;
        font-size: 1.2rem;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.13);
        border: 3px solid #fff;
    }

    .ranking-nama {
        font-weight: bold;
        color: #003366;
        font-size: 1.08rem;
        margin-bottom: 4px;
    }

    .ranking-info,
    .statistik-info,
    .medali-info {
        font-size: 0.97rem;
        color: #1E90FF;
        margin-bottom: 6px;
    }

    .statistik-title {
        font-weight: bold;
        color: #1E90FF;
        font-size: 1.07rem;
        margin-bottom: 2px;
    }

    .medali-klub {
        font-weight: bold;
        color: #003366;
        font-size: 1.07rem;
        margin-bottom: 2px;
    }

    .medali-total {
        font-size: 1.2rem;
        color: #fff;
        background: #28a745;
        border-radius: 14px;
        padding: 6px 18px;
        font-weight: bold;
        margin-top: 8px;
        display: inline-block;
    }

    @media (max-width: 991px) {

        .ranking-list,
        .statistik-list,
        .medali-list {
            gap: 12px;
        }

        .ranking-card,
        .statistik-card,
        .medali-card {
            min-width: 180px;
            max-width: 100%;
            padding: 14px 10px;
        }
    }
</style>

<div class="ranking-section">
    <div class="container py-5">
        <h2 class="mb-4 text-primary fw-bold text-center">Ranking & Statistik PTMSI Sumbar</h2>
        <ul class="nav nav-tabs justify-content-center mb-4" id="rankingTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="ranking-tab" data-bs-toggle="tab" data-bs-target="#ranking" type="button" role="tab">Ranking Atlet Provinsi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="statistik-tab" data-bs-toggle="tab" data-bs-target="#statistik" type="button" role="tab">Statistik Pertandingan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="medali-tab" data-bs-toggle="tab" data-bs-target="#medali" type="button" role="tab">Rekap Perolehan Medali</button>
            </li>
        </ul>
        <div class="tab-content" id="rankingTabContent">
            <div class="tab-pane fade show active" id="ranking" role="tabpanel">
                <h5 class="mb-3 text-primary">Ranking Atlet Provinsi per Kategori: <span class="badge bg-info text-dark"><?= esc($kategori) ?></span></h5>
                <div class="ranking-list">
                    <?php foreach ($ranking as $r): ?>
                        <div class="ranking-card position-relative">
                            <div class="ranking-posisi"><?= esc($r['posisi']) ?></div>
                            <div class="ranking-nama">ID Atlet: <?= esc($r['id_atlet']) ?></div>
                            <div class="ranking-info">Kategori: <?= esc($r['kategori_usia']) ?> | Poin: <?= esc($r['poin']) ?></div>
                            <div class="ranking-info">Jenis Kelamin: <?= esc($r['jenis_kelamin']) ?></div>
                            <div class="ranking-info">ID Klub: <?= esc($r['id_klub']) ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="tab-pane fade" id="statistik" role="tabpanel">
                <h5 class="mb-3 text-primary">Statistik Pertandingan</h5>
                <div class="statistik-list">
                    <?php foreach ($statistik as $s): ?>
                        <div class="statistik-card">
                            <div class="statistik-title">Event: <?= esc($s['event']) ?></div>
                            <div class="statistik-info">Babak: <?= esc($s['babak']) ?> | Jadwal: <?= esc($s['jadwal']) ?></div>
                            <div class="statistik-info">Venue: <?= esc($s['venue']) ?></div>
                            <div class="statistik-info">Atlet 1: <span class="badge bg-primary"><?= esc($s['atlet1']) ?></span></div>
                            <div class="statistik-info">Atlet 2: <span class="badge bg-primary"><?= esc($s['atlet2']) ?></span></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="tab-pane fade" id="medali" role="tabpanel">
                <h5 class="mb-3 text-primary">Rekap Perolehan Medali Klub</h5>
                <div class="medali-list">
                    <?php foreach ($rekap_medali as $m): ?>
                        <div class="medali-card text-center">
                            <div class="medali-klub">ID Klub: <?= esc($m['id_klub']) ?></div>
                            <div class="medali-total"><?= esc($m['total_medali']) ?> <i class="bi bi-award"></i></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>