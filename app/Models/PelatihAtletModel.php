<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihAtletModel extends Model
{
    protected $table = 'pelatih_atlet';
    protected $primaryKey = 'id_pelatih_atlet';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_pelatih',
        'id_atlet',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'catatan'
    ];

    protected $useTimestamps = false;

    /**
     * Get atlet binaan by pelatih
     */
    public function getAtletBinaanByPelatih($idPelatih)
    {
        return $this->select('pa.*, 
                             atlet.id_atlet, atlet.kategori_usia, atlet.jenis_kelamin,
                             user.nama_lengkap,
                             klub.nama as nama_klub,
                             ranking.poin, ranking.posisi')
            ->join('atlet', 'atlet.id_atlet = pa.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->join('ranking', 'ranking.id_atlet = atlet.id_atlet', 'left')
            ->where('pa.id_pelatih', $idPelatih)
            ->where('pa.status', 'aktif')
            ->orderBy('user.nama_lengkap', 'ASC')
            ->findAll();
    }

    /**
     * Get atlet binaan aktif
     */
    public function getAtletBinaanAktif($idPelatih)
    {
        return $this->select('pa.*, 
                             atlet.id_atlet, atlet.kategori_usia,
                             user.nama_lengkap,
                             ranking.poin, ranking.posisi')
            ->join('atlet', 'atlet.id_atlet = pa.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('ranking', 'ranking.id_atlet = atlet.id_atlet', 'left')
            ->where('pa.id_pelatih', $idPelatih)
            ->where('pa.status', 'aktif')
            ->where('pa.tanggal_selesai IS NULL OR pa.tanggal_selesai >=', date('Y-m-d'))
            ->findAll();
    }

    /**
     * Get riwayat atlet binaan
     */
    public function getRiwayatAtletBinaan($idPelatih)
    {
        return $this->select('pa.*, 
                             atlet.id_atlet,
                             user.nama_lengkap,
                             klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = pa.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('pa.id_pelatih', $idPelatih)
            ->orderBy('pa.tanggal_mulai', 'DESC')
            ->findAll();
    }

    /**
     * Check if pelatih already coaching atlet
     */
    public function isCoachingAtlet($idPelatih, $idAtlet)
    {
        return $this->where('id_pelatih', $idPelatih)
            ->where('id_atlet', $idAtlet)
            ->where('status', 'aktif')
            ->first();
    }

    /**
     * Get total atlet binaan aktif
     */
    public function getTotalAtletAktif($idPelatih)
    {
        return $this->where('id_pelatih', $idPelatih)
            ->where('status', 'aktif')
            ->where('tanggal_selesai IS NULL OR tanggal_selesai >=', date('Y-m-d'))
            ->countAllResults();
    }
}
