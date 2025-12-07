<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'id_hasil';
    protected $allowedFields = [
        'id_pertandingan',
        'id_pemenang_atlet',
        'skor',
        'id_pelapor',
        'dicatat_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Get hasil with pertandingan details
     */
    public function getHasilWithDetails()
    {
        return $this->select('hasil.*, 
                pertandingan.babak, pertandingan.jadwal, pertandingan.venue,
                event.judul as nama_event,
                u1.nama_lengkap as atlet1_nama, u2.nama_lengkap as atlet2_nama,
                upemenang.nama_lengkap as pemenang_nama,
                k1.nama as klub1_nama, k2.nama as klub2_nama')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->join('atlet a1', 'a1.id_atlet = pertandingan.id_atlet1')
            ->join('atlet a2', 'a2.id_atlet = pertandingan.id_atlet2')
            ->join('user u1', 'u1.id_user = a1.id_user')
            ->join('user u2', 'u2.id_user = a2.id_user')
            ->join('atlet pemenang', 'pemenang.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('user upemenang', 'upemenang.id_user = pemenang.id_user', 'left')
            ->join('klub k1', 'k1.id_klub = a1.id_klub', 'left')
            ->join('klub k2', 'k2.id_klub = a2.id_klub', 'left')
            ->orderBy('hasil.dicatat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get hasil by event
     */
    public function getHasilByEvent($idEvent)
    {
        return $this->select('hasil.*, 
                pertandingan.babak,
                u1.nama_lengkap as atlet1_nama, u2.nama_lengkap as atlet2_nama,
                upemenang.nama_lengkap as pemenang_nama')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
            ->join('atlet a1', 'a1.id_atlet = pertandingan.id_atlet1')
            ->join('atlet a2', 'a2.id_atlet = pertandingan.id_atlet2')
            ->join('user u1', 'u1.id_user = a1.id_user')
            ->join('user u2', 'u2.id_user = a2.id_user')
            ->join('atlet pemenang', 'pemenang.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('user upemenang', 'upemenang.id_user = pemenang.id_user', 'left')
            ->where('pertandingan.id_event', $idEvent)
            ->orderBy('hasil.dicatat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get rekap medali by klub
     */
    public function getRekapMedaliByKlub()
    {
        return $this->select('klub.nama as nama_klub,
                COUNT(CASE WHEN pertandingan.babak = "Final" THEN 1 END) as emas,
                COUNT(CASE WHEN pertandingan.babak = "Semi Final" THEN 1 END) as perak,
                COUNT(CASE WHEN pertandingan.babak = "Perempat Final" THEN 1 END) as perunggu')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
            ->join('atlet', 'atlet.id_atlet = hasil.id_pemenang_atlet')
            ->join('klub', 'klub.id_klub = atlet.id_klub')
            ->groupBy('klub.id_klub')
            ->orderBy('emas', 'DESC')
            ->findAll();
    }

    /**
     * Get rekap medali by atlet
     */
    public function getRekapMedaliByAtlet()
    {
        return $this->select('user.nama_lengkap, klub.nama as nama_klub,
                COUNT(CASE WHEN pertandingan.babak = "Final" THEN 1 END) as emas,
                COUNT(CASE WHEN pertandingan.babak = "Semi Final" THEN 1 END) as perak,
                COUNT(CASE WHEN pertandingan.babak = "Perempat Final" THEN 1 END) as perunggu')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
            ->join('atlet', 'atlet.id_atlet = hasil.id_pemenang_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->groupBy('atlet.id_atlet')
            ->orderBy('emas', 'DESC')
            ->findAll();
    }
}
