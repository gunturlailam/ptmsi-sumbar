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

    /**
     * Get ranking with atlet info
     */
    public function getRankingWithAtlet()
    {
        return $this->select('ranking.*, user.nama_lengkap, atlet.jenis_kelamin, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->orderBy('ranking.posisi', 'ASC')
            ->findAll();
    }

    /**
     * Get ranking by kategori
     */
    public function getRankingByKategori($kategoriUsia)
    {
        return $this->select('ranking.*, user.nama_lengkap, atlet.jenis_kelamin, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('ranking.kategori_usia', $kategoriUsia)
            ->orderBy('ranking.posisi', 'ASC')
            ->findAll();
    }

    /**
     * Get top ranking
     */
    public function getTopRanking($limit = 10)
    {
        return $this->select('ranking.*, user.nama_lengkap, atlet.jenis_kelamin, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->orderBy('ranking.poin', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get all kategori
     */
    public function getAllKategori()
    {
        return $this->select('kategori_usia')
            ->distinct()
            ->orderBy('kategori_usia', 'ASC')
            ->findColumn('kategori_usia');
    }

    /**
     * Get ranking by atlet
     */
    public function getRankingByAtlet($idAtlet)
    {
        return $this->select('ranking.*, user.nama_lengkap, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('ranking.id_atlet', $idAtlet)
            ->first();
    }
}
