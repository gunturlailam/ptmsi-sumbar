<?= $this->extend('layouts/public_main') ?>

<?= $this->section('css') ?>
<style>
    :root {
        --primary: #f59e0b;
        --secondary: #d97706;
        --primary-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-gradient: linear-gradient(135deg, #111827 0%, #0f172a 100%);
        --gold-gradient: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        --silver-gradient: linear-gradient(135deg, #C0C0C0 0%, #A0A0A0 100%);
        --bronze-gradient: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
        --text-primary: #e5e7eb;
        --text-secondary: #9ca3af;
        --border-color: rgba(245, 158, 11, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #0f172a 0%, #111827 100%);
    }

    .hero-section {
        background: var(--primary-gradient);
        color: white;
        padding: 6rem 0 4rem;
        text-align: center;
        position: relative;
        border-bottom: 1px solid rgba(245, 158, 11, 0.1);
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="200" cy="200" r="100" fill="rgba(255,255,255,0.1)"/><circle cx="800" cy="300" r="150" fill="rgba(255,255,255,0.1)"/></svg>');
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .nav-tabs-modern {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .nav-tab {
        padding: 1rem 2rem;
        border-radius: 50px;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .nav-tab:hover,
    .nav-tab.active {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .section-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: #667eea;
    }

    .filter-box {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-box select {
        border-radius: 10px;
        border: 2px solid var(--border-color);
        padding: 0.75rem 1rem;
        width: 100%;
    }

    .filter-box select:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .table-modern {
        width: 100%;
        border-collapse: collapse;
    }

    .table-modern thead {
        background: var(--primary-gradient);
        color: white;
    }

    .table-modern th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .table-modern td {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .badge-rank {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        display: inline-block;
        min-width: 50px;
        text-align: center;
    }

    .badge-gold {
        background: var(--gold-gradient);
        color: #000;
    }

    .badge-silver {
        background: var(--silver-gradient);
        color: #000;
    }

    .badge-bronze {
        background: var(--bronze-gradient);
        color: white;
    }

    .badge-default {
        background: var(--primary-gradient);
        color: white;
    }

    .stat-card {
        background: var(--primary-gradient);
        color: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
    }

    .stat-card h3 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        opacity: 0.9;
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 4rem;
        color: #667eea;
        opacity: 0.5;
        margin-bottom: 1rem;
        display: block;
    }

    .medal-icon {
        font-size: 1.25rem;
    }

    .medal-gold {
        color: #FFD700;
    }

    .medal-silver {
        color: #C0C0C0;
    }

    .medal-bronze {
        color: #CD7F32;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .tab-content>div {
        display: none;
    }

    .tab-content>div.active {
        display: block;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 2rem;
        }

        .table-modern th,
        .table-modern td {
            padding: 0.75rem 0.5rem;
            font-size: 0.9rem;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <h1 class="hero-title"><i class="bx bx-trophy"></i> Ranking & Statistik</h1>
            <p class="hero-subtitle">Peringkat Atlet, Statistik Pertandingan, dan Rekap Medali PTMSI Sumbar</p>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="nav-tabs-modern fade-in">
        <a href="#ranking" class="nav-tab active" data-tab="ranking"><i class="bx bx-list-ol"></i> Ranking Atlet</a>
        <a href="#statistik" class="nav-tab" data-tab="statistik"><i class="bx bx-bar-chart"></i> Statistik</a>
        <a href="#medali" class="nav-tab" data-tab="medali"><i class="bx bx-medal"></i> Rekap Medali</a>
    </div>

    <div class="tab-content">
        <!-- Ranking Atlet -->
        <div id="ranking" class="active fade-in">
            <div class="section-card">
                <h2 class="section-title"><i class="bx bx-list-ol"></i> Ranking Atlet Provinsi</h2>
                <div class="filter-box">
                    <form method="get" action="<?= base_url('ranking') ?>">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Filter Kategori:</label>
                                <select name="kategori" class="form-select" onchange="this.form.submit()">
                                    <?php foreach ($allKategori as $key => $label): ?>
                                        <option value="<?= esc($key) ?>" <?= $selectedKategori === $key ? 'selected' : '' ?>><?= esc($label) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100" style="background: var(--primary-gradient); border: none; border-radius: 10px; padding: 0.75rem;">
                                    <i class="bx bx-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if (!empty($rankings)): ?>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Posisi</th>
                                    <th>Nama Atlet</th>
                                    <th>Klub</th>
                                    <th>Kategori</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rankings as $rank): ?>
                                    <tr>
                                        <td>
                                            <?php if ($rank['posisi'] == 1): ?>
                                                <span class="badge-rank badge-gold">#1</span>
                                            <?php elseif ($rank['posisi'] == 2): ?>
                                                <span class="badge-rank badge-silver">#2</span>
                                            <?php elseif ($rank['posisi'] == 3): ?>
                                                <span class="badge-rank badge-bronze">#3</span>
                                            <?php else: ?>
                                                <span class="badge-rank badge-default">#<?= $rank['posisi'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?= esc($rank['nama_lengkap']) ?></strong></td>
                                        <td><?= esc($rank['nama_klub'] ?? '-') ?></td>
                                        <td><?= esc($rank['kategori_usia']) ?></td>
                                        <td><strong><?= number_format($rank['poin'] ?? 0) ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bx bx-trophy"></i>
                        <h5>Belum Ada Data Ranking</h5>
                        <p>Data ranking atlet akan ditampilkan di sini</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Statistik Pertandingan -->
        <div id="statistik" class="fade-in">
            <div class="section-card">
                <h2 class="section-title"><i class="bx bx-bar-chart"></i> Statistik Pertandingan</h2>
                <?php if (!empty($statistikPertandingan)): ?>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Event</th>
                                    <th>Total Pertandingan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($statistikPertandingan as $stat): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= esc($stat['nama_event']) ?></strong></td>
                                        <td><span class="badge-rank badge-default"><?= number_format($stat['total_pertandingan']) ?></span></td>
                                        <td><?= date('d M Y', strtotime($stat['tanggal_mulai'])) ?></td>
                                        <td><?= date('d M Y', strtotime($stat['tanggal_selesai'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bx bx-bar-chart"></i>
                        <h5>Belum Ada Data Statistik</h5>
                        <p>Statistik pertandingan akan ditampilkan di sini</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Rekap Medali -->
        <div id="medali" class="fade-in">
            <div class="section-card">
                <h2 class="section-title"><i class="bx bx-medal"></i> Rekap Perolehan Medali</h2>

                <h4 class="mb-3" style="color: var(--text-primary);"><i class="bx bx-buildings"></i> Per Klub</h4>
                <?php if (!empty($rekapMedaliKlub)): ?>
                    <div class="table-responsive mb-5">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Klub</th>
                                    <th class="text-center"><i class="bx bxs-medal medal-icon medal-gold"></i> Emas</th>
                                    <th class="text-center"><i class="bx bxs-medal medal-icon medal-silver"></i> Perak</th>
                                    <th class="text-center"><i class="bx bxs-medal medal-icon medal-bronze"></i> Perunggu</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rekapMedaliKlub as $medali): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= esc($medali['nama_klub']) ?></strong></td>
                                        <td class="text-center"><span class="badge-rank badge-gold"><?= $medali['emas'] ?></span></td>
                                        <td class="text-center"><span class="badge-rank badge-silver"><?= $medali['perak'] ?></span></td>
                                        <td class="text-center"><span class="badge-rank badge-bronze"><?= $medali['perunggu'] ?></span></td>
                                        <td class="text-center"><strong><?= $medali['emas'] + $medali['perak'] + $medali['perunggu'] ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state mb-4">
                        <i class="bx bx-medal"></i>
                        <h5>Belum Ada Data Medali Klub</h5>
                    </div>
                <?php endif; ?>

                <h4 class="mb-3" style="color: var(--text-primary);"><i class="bx bx-user"></i> Per Atlet</h4>
                <?php if (!empty($rekapMedaliAtlet)): ?>
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Atlet</th>
                                    <th>Klub</th>
                                    <th class="text-center"><i class="bx bxs-medal medal-icon medal-gold"></i> Emas</th>
                                    <th class="text-center"><i class="bx bxs-medal medal-icon medal-silver"></i> Perak</th>
                                    <th class="text-center"><i class="bx bxs-medal medal-icon medal-bronze"></i> Perunggu</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($rekapMedaliAtlet as $medali): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= esc($medali['nama_lengkap']) ?></strong></td>
                                        <td><?= esc($medali['nama_klub'] ?? '-') ?></td>
                                        <td class="text-center"><span class="badge-rank badge-gold"><?= $medali['emas'] ?></span></td>
                                        <td class="text-center"><span class="badge-rank badge-silver"><?= $medali['perak'] ?></span></td>
                                        <td class="text-center"><span class="badge-rank badge-bronze"><?= $medali['perunggu'] ?></span></td>
                                        <td class="text-center"><strong><?= $medali['emas'] + $medali['perak'] + $medali['perunggu'] ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bx bx-medal"></i>
                        <h5>Belum Ada Data Medali Atlet</h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content > div').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            document.getElementById(this.dataset.tab).classList.add('active');
        });
    });
</script>
<?= $this->endSection() ?>