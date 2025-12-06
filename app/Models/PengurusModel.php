<?php

namespace App\Models;

use CodeIgniter\Model;

class PengurusModel extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'id_pengurus';
    protected $allowedFields = [
        'id_organisasi',
        'nama',
        'jabatan',
        'telepon',
        'email',
        'periode_mulai',
        'periode_selesai',
        'status'
    ];
    protected $useTimestamps = false;

    /**
     * Get all pengurus with organisasi info
     */
    public function getPengurusWithOrganisasi()
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->orderBy('pengurus.jabatan', 'ASC')
            ->findAll();
    }

    /**
     * Get pengurus by organisasi
     */
    public function getPengurusByOrganisasi($idOrganisasi)
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->where('pengurus.id_organisasi', $idOrganisasi)
            ->orderBy('pengurus.jabatan', 'ASC')
            ->findAll();
    }

    /**
     * Get pengurus aktif
     */
    public function getPengurusAktif()
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->where('pengurus.status', 'aktif')
            ->orderBy('pengurus.jabatan', 'ASC')
            ->findAll();
    }

    /**
     * Get pengurus by jabatan
     */
    public function getPengurusByJabatan($jabatan)
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->where('pengurus.jabatan', $jabatan)
            ->findAll();
    }

    /**
     * Get total pengurus
     */
    public function getTotalPengurus()
    {
        return $this->countAll();
    }

    /**
     * Get pengurus aktif count
     */
    public function getPengurusAktifCount()
    {
        return $this->where('status', 'aktif')->countAllResults();
    }
}
