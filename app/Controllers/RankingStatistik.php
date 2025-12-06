<?php

namespace App\Controllers;

use App\Models\RankingModel;
use App\Models\PertandinganModel;
use App\Models\HasilModel;

class RankingStatistik extends BaseController
{
    public function index()
    {
        $rankingModel = new RankingModel();
        $pertandinganModel = new PertandinganModel();
        $hasilModel = new HasilModel();

        $kategori = $this->request->getGet('kategori') ?? 'Umum';

        $data = [
            'title' => 'Ranking & Statistik',
            'ranking' => $rankingModel->getRankingByKategori($kategori),
            'statistik' => $pertandinganModel->getStatistikPertandingan(),
            'rekap_medali' => $hasilModel->getRekapMedali(),
            'kategori' => $kategori
        ];

        return view('ranking_statistik', $data);
    }
}
