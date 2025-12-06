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

    // Join dengan event dan atlet
    public function getPertandinganWithDetails()
    {
        return $this->select('pertandingan.*, event.judul as nama_event, 
                             user1.nama_lengkap as nama_atlet1, user2.nama_lengkap as nama_atlet2')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user user2', 'user2.id_user = atlet2.id_user', 'left')
            ->findAll();
    }

    public function getStatistikPertandingan()
    {
        return $this->select('pertandingan.*, e.judul as event, a1.id_user as atlet1, a2.id_user as atlet2')
            ->join('event e', 'e.id_event = pertandingan.id_event')
            ->join('atlet a1', 'a1.id_atlet = pertandingan.id_atlet1')
            ->join('atlet a2', 'a2.id_atlet = pertandingan.id_atlet2')
            ->orderBy('pertandingan.jadwal', 'DESC')
            ->findAll();
    }
}
