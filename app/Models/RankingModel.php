<?php

namespace App\Models;

use CodeIgniter\Model;

class RankingModel extends Model
{
    protected $table = 'ranking';
    protected $primaryKey = 'id_ranking';
    protected $allowedFields = [
        'id_atlet',
        'kategori_usia',
        'posisi',
        'poin',
        'tanggal_berlaku'
    ];
    protected $useTimestamps = false;

    public function getRankingByKategori($kategori)
    {
        return $this->select('ranking.*, atlet.id_user, atlet.id_klub, atlet.jenis_kelamin')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->where('ranking.kategori_usia', $kategori)
            ->orderBy('ranking.posisi', 'ASC')
            ->findAll();
    }
}
