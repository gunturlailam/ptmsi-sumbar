<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = [
        'judul',
        'kategori',
        'file_url',
        'id_pengunggah',
        'diunggah_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Get all dokumen
     */
    public function getAllDokumen()
    {
        return $this->select('dokumen.*, user.nama_lengkap as nama_pengunggah')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left')
            ->orderBy('dokumen.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get dokumen by kategori
     */
    public function getDokumenByKategori($kategori)
    {
        return $this->select('dokumen.*, user.nama_lengkap as nama_pengunggah')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left')
            ->where('dokumen.kategori', $kategori)
            ->orderBy('dokumen.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get dokumen by ID
     */
    public function getDokumenById($idDokumen)
    {
        return $this->select('dokumen.*, user.nama_lengkap as nama_pengunggah')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left')
            ->where('dokumen.id_dokumen', $idDokumen)
            ->first();
    }

    /**
     * Get latest dokumen
     */
    public function getLatestDokumen($limit = 10)
    {
        return $this->select('dokumen.*, user.nama_lengkap as nama_pengunggah')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left')
            ->orderBy('dokumen.diunggah_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Search dokumen
     */
    public function searchDokumen($keyword)
    {
        return $this->select('dokumen.*, user.nama_lengkap as nama_pengunggah')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left')
            ->like('dokumen.judul', $keyword)
            ->orLike('dokumen.kategori', $keyword)
            ->orderBy('dokumen.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get total dokumen
     */
    public function getTotalDokumen()
    {
        return $this->countAll();
    }

    /**
     * Get total by kategori
     */
    public function getTotalByKategori($kategori)
    {
        return $this->where('kategori', $kategori)->countAllResults();
    }

    /**
     * Get all kategori
     */
    public function getAllKategori()
    {
        return $this->select('kategori')
            ->distinct()
            ->orderBy('kategori', 'ASC')
            ->findColumn('kategori');
    }
}
