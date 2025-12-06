<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id_event';
    protected $allowedFields = [
        'judul',
        'id_turnamen',
        'id_klub_penyelenggara',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'batas_pendaftaran',
        'status'
    ];
    protected $useTimestamps = false;

    // Join dengan tabel turnamen
    public function getEventWithTurnamen()
    {
        return $this->select('event.*, turnamen.nama as nama_turnamen, turnamen.tingkat, turnamen.tahun_musim')
            ->join('turnamen', 'turnamen.id_turnamen = event.id_turnamen')
            ->findAll();
    }

    // Join dengan turnamen dan klub
    public function getEventWithDetails()
    {
        return $this->select('event.*, turnamen.nama as nama_turnamen, turnamen.tingkat, turnamen.tahun_musim, klub.nama as nama_klub_penyelenggara')
            ->join('turnamen', 'turnamen.id_turnamen = event.id_turnamen')
            ->join('klub', 'klub.id_klub = event.id_klub_penyelenggara')
            ->findAll();
    }
}
