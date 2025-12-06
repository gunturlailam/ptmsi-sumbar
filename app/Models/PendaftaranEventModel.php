<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranEventModel extends Model
{
    protected $table = 'pendaftaran_event';
    protected $primaryKey = 'id_pendaftaran';
    protected $allowedFields = [
        'id_event',
        'tipe_pendaftar',
        'id_klub',
        'id_atlet',
        'tanggal_daftar',
        'status_pembayaran',
        'id_verifikator'
    ];
    protected $useTimestamps = false;

    // Join dengan event dan atlet/klub
    public function getPendaftaranWithDetails()
    {
        return $this->select('pendaftaran_event.*, event.judul as nama_event, atlet.id_atlet, klub.nama as nama_klub')
            ->join('event', 'event.id_event = pendaftaran_event.id_event')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->join('klub', 'klub.id_klub = pendaftaran_event.id_klub', 'left')
            ->findAll();
    }
}
