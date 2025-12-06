<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganisasiModel extends Model
{
    protected $table = 'organisasi';
    protected $primaryKey = 'id_organisasi';
    protected $allowedFields = [
        'nama_organisasi',
        'jenis',
        'id_induk_organisasi',
        'alamat',
        'nohp'
    ];
    protected $useTimestamps = false;

    /**
     * Get all organisasi
     */
    public function getAllOrganisasi()
    {
        return $this->orderBy('nama_organisasi', 'ASC')->findAll();
    }

    /**
     * Get organisasi by jenis
     */
    public function getOrganisasiByJenis($jenis)
    {
        return $this->where('jenis', $jenis)
            ->orderBy('nama_organisasi', 'ASC')
            ->findAll();
    }

    /**
     * Get organisasi provinsi
     */
    public function getOrganisasiProvinsi()
    {
        return $this->where('jenis', 'provinsi')->findAll();
    }

    /**
     * Get organisasi kabupaten
     */
    public function getOrganisasiKabupaten()
    {
        return $this->where('jenis', 'kabupaten')->findAll();
    }

    /**
     * Get organisasi with induk
     */
    public function getOrganisasiWithInduk()
    {
        return $this->select('organisasi.*, induk.nama_organisasi as nama_induk')
            ->join('organisasi as induk', 'induk.id_organisasi = organisasi.id_induk_organisasi', 'left')
            ->orderBy('organisasi.nama_organisasi', 'ASC')
            ->findAll();
    }

    /**
     * Get organisasi by ID
     */
    public function getOrganisasiById($idOrganisasi)
    {
        return $this->find($idOrganisasi);
    }

    /**
     * Get total organisasi
     */
    public function getTotalOrganisasi()
    {
        return $this->countAll();
    }
}
