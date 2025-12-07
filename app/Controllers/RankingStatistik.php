<?php

namespace App\Controllers;

use App\Models\RankingModel;
use App\Models\PertandinganModel;
use App\Models\HasilModel;

class RankingStatistik extends BaseController
{
    protected $rankingModel;
    protected $pertandinganModel;
    protected $hasilModel;

    public function __construct()
    {
        $this->rankingModel = new RankingModel();
        $this->pertandinganModel = new PertandinganModel();
        $this->hasilModel = new HasilModel();
    }

    public function index()
    {
        $kategori = $this->request->getGet('kategori') ?? 'all';

        // Get ranking data
        if ($kategori === 'all') {
            $rankings = $this->rankingModel->getRankingWithAtlet();
        } else {
            $rankings = $this->rankingModel->getRankingByKategori($kategori);
        }

        // Get all kategori for filter
        $allKategori = $this->rankingModel->getAllKategori();

        // Get statistik pertandingan
        $statistikPertandingan = $this->pertandinganModel->getStatistikPertandingan();

        // Get rekap medali
        $rekapMedaliKlub = $this->hasilModel->getRekapMedaliByKlub();
        $rekapMedaliAtlet = $this->hasilModel->getRekapMedaliByAtlet();

        $data = [
            'title' => 'Ranking & Statistik',
            'rankings' => $rankings,
            'allKategori' => $allKategori,
            'selectedKategori' => $kategori,
            'statistikPertandingan' => $statistikPertandingan,
            'rekapMedaliKlub' => $rekapMedaliKlub,
            'rekapMedaliAtlet' => $rekapMedaliAtlet,
        ];

        return view('ranking', $data);
    }
}
