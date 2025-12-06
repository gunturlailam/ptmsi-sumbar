<?php

namespace App\Models;

use CodeIgniter\Model;

class KlubModel extends Model
{
    protected $table = 'klub';
    protected $primaryKey = 'id_klub';
    protected $allowedFields = [
        'id_organisasi',
        'nama',
        'alamat',
        'penanggung_jawab',
        'telepon',
        'tanggal_berdiri',
        'status'
    ];
    protected $useTimestamps = false;

    /**
     * Get all klub with organisasi info
     */
    public function getKlubWithOrganisasi()
    {
        return $this->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->orderBy('klub.nama', 'ASC')
            ->findAll();
    }

    /**
     * Get klub by organisasi
     */
    public function getKlubByOrganisasi($idOrganisasi)
    {
        return $this->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->where('klub.id_organisasi', $idOrganisasi)
            ->orderBy('klub.nama', 'ASC')
            ->findAll();
    }

    /**
     * Get klub by ID with organisasi info
     */
    public function getKlubById($idKlub)
    {
        return $this->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->where('klub.id_klub', $idKlub)
            ->first();
    }

    /**
     * Search klub by name
     */
    public function searchKlub($keyword)
    {
        return $this->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->like('klub.nama', $keyword)
            ->orderBy('klub.nama', 'ASC')
            ->findAll();
    }

    /**
     * Get total klub
     */
    public function getTotalKlub()
    {
        return $this->countAll();
    }

    /**
     * Get klub aktif
     */
    public function getKlubAktif()
    {
        return $this->where('status', 'aktif')->countAllResults();
    }
}
