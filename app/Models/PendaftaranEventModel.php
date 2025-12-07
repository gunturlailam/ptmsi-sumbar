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

    /**
     * Get all pendaftaran with details
     */
    public function getPendaftaranWithDetails()
    {
        return $this->select('pendaftaran_event.*, 
                event.judul as nama_event,
                klub.nama as nama_klub,
                user.nama_lengkap as nama_atlet')
            ->join('event', 'event.id_event = pendaftaran_event.id_event')
            ->join('klub', 'klub.id_klub = pendaftaran_event.id_klub', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->orderBy('pendaftaran_event.tanggal_daftar', 'DESC')
            ->findAll();
    }

    /**
     * Get pendaftaran by event
     */
    public function getPendaftaranByEvent($idEvent)
    {
        return $this->select('pendaftaran_event.*, 
                klub.nama as nama_klub,
                user.nama_lengkap as nama_atlet')
            ->join('klub', 'klub.id_klub = pendaftaran_event.id_klub', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('pendaftaran_event.id_event', $idEvent)
            ->orderBy('pendaftaran_event.tanggal_daftar', 'DESC')
            ->findAll();
    }
}
