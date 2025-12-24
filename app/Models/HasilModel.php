<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'id_hasil';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_pertandingan',
        'id_pemenang_atlet',
        'skor',
        'id_pelapor',
        'dicatat_pada'
    ];

    protected $useTimestamps = false;

    /**
     * Get hasil dengan detail pertandingan dan atlet
     */
    public function getHasilWithDetails()
    {
        return $this->select('hasil.*, 
                             pertandingan.id_atlet1, pertandingan.id_atlet2, pertandingan.jadwal,
                             user1.nama_lengkap as nama_atlet1,
                             user2.nama_lengkap as nama_atlet2,
                             pemenang.nama_lengkap as nama_pemenang,
                             event.nama_event')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan', 'left')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->join('atlet as atlet_pemenang', 'atlet_pemenang.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('user as pemenang', 'pemenang.id_user = atlet_pemenang.id_user', 'left')
            ->join('event', 'event.id_event = pertandingan.id_event', 'left')
            ->orderBy('hasil.dicatat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get hasil by date
     */
    public function getHasilByDate($date)
    {
        return $this->select('hasil.*, 
                             pertandingan.id_atlet1, pertandingan.id_atlet2,
                             user1.nama_lengkap as nama_atlet1,
                             user2.nama_lengkap as nama_atlet2,
                             pemenang.nama_lengkap as nama_pemenang')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan', 'left')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->join('atlet as atlet_pemenang', 'atlet_pemenang.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('user as pemenang', 'pemenang.id_user = atlet_pemenang.id_user', 'left')
            ->where('DATE(hasil.dicatat_pada)', $date)
            ->orderBy('hasil.dicatat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get hasil by atlet
     */
    public function getHasilByAtlet($idAtlet)
    {
        return $this->select('hasil.*, 
                             pertandingan.id_atlet1, pertandingan.id_atlet2,
                             user1.nama_lengkap as nama_atlet1,
                             user2.nama_lengkap as nama_atlet2')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan', 'left')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->where('pertandingan.id_atlet1', $idAtlet)
            ->orWhere('pertandingan.id_atlet2', $idAtlet)
            ->orderBy('hasil.dicatat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get rekap medali by klub
     */
    public function getRekapMedaliByKlub()
    {
        return $this->select('klub.nama, 
                             COUNT(hasil.id_hasil) as total_kemenangan')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan', 'left')
            ->join('atlet', 'atlet.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->groupBy('klub.id_klub')
            ->orderBy('total_kemenangan', 'DESC')
            ->limit(10)
            ->findAll();
    }

    /**
     * Get rekap medali by atlet
     */
    public function getRekapMedaliByAtlet()
    {
        return $this->select('user.nama_lengkap, 
                             COUNT(hasil.id_hasil) as total_kemenangan')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan', 'left')
            ->join('atlet', 'atlet.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->groupBy('hasil.id_pemenang_atlet')
            ->orderBy('total_kemenangan', 'DESC')
            ->limit(10)
            ->findAll();
    }
}
