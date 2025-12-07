<?php

namespace App\Models;

use CodeIgniter\Model;

class PertandinganModel extends Model
{
    protected $table = 'pertandingan';
    protected $primaryKey = 'id_pertandingan';
    protected $allowedFields = [
        'id_event',
        'babak',
        'id_atlet1',
        'id_atlet2',
        'jadwal',
        'venue'
    ];
    protected $useTimestamps = false;

    /**
     * Get pertandingan with event and atlet info
     */
    public function getPertandinganWithDetails()
    {
        return $this->select('pertandingan.*, 
                event.judul as nama_event, event.tanggal_mulai, event.tanggal_selesai,
                u1.nama_lengkap as atlet1_nama, a1.jenis_kelamin as atlet1_gender,
                u2.nama_lengkap as atlet2_nama, a2.jenis_kelamin as atlet2_gender,
                k1.nama as klub1_nama, k2.nama as klub2_nama')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->join('atlet a1', 'a1.id_atlet = pertandingan.id_atlet1')
            ->join('atlet a2', 'a2.id_atlet = pertandingan.id_atlet2')
            ->join('user u1', 'u1.id_user = a1.id_user')
            ->join('user u2', 'u2.id_user = a2.id_user')
            ->join('klub k1', 'k1.id_klub = a1.id_klub', 'left')
            ->join('klub k2', 'k2.id_klub = a2.id_klub', 'left')
            ->orderBy('pertandingan.jadwal', 'DESC')
            ->findAll();
    }

    /**
     * Get pertandingan by event
     */
    public function getPertandinganByEvent($idEvent)
    {
        return $this->select('pertandingan.*, 
                u1.nama_lengkap as atlet1_nama, u2.nama_lengkap as atlet2_nama,
                k1.nama as klub1_nama, k2.nama as klub2_nama')
            ->join('atlet a1', 'a1.id_atlet = pertandingan.id_atlet1')
            ->join('atlet a2', 'a2.id_atlet = pertandingan.id_atlet2')
            ->join('user u1', 'u1.id_user = a1.id_user')
            ->join('user u2', 'u2.id_user = a2.id_user')
            ->join('klub k1', 'k1.id_klub = a1.id_klub', 'left')
            ->join('klub k2', 'k2.id_klub = a2.id_klub', 'left')
            ->where('pertandingan.id_event', $idEvent)
            ->orderBy('pertandingan.jadwal', 'ASC')
            ->findAll();
    }

    /**
     * Get statistik pertandingan
     */
    public function getStatistikPertandingan()
    {
        return $this->select('event.judul as nama_event, 
                COUNT(pertandingan.id_pertandingan) as total_pertandingan,
                event.tanggal_mulai, event.tanggal_selesai')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->groupBy('pertandingan.id_event')
            ->orderBy('event.tanggal_mulai', 'DESC')
            ->findAll();
    }
}
