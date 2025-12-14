<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $allowedFields = [
        'judul',
        'slug',
        'konten',
        'foto',
        'kategori',
        'id_penulis',
        'tanggal_publikasi',
        'status'
    ];
    protected $useTimestamps = false;

    /**
     * Get all published berita
     */
    public function getPublishedBerita()
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.status', 'published')
            ->orderBy('berita.tanggal_publikasi', 'DESC')
            ->findAll();
    }

    /**
     * Get berita by kategori
     */
    public function getBeritaByKategori($kategori)
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.kategori', $kategori)
            ->where('berita.status', 'published')
            ->orderBy('berita.tanggal_publikasi', 'DESC')
            ->findAll();
    }

    /**
     * Get berita by slug
     */
    public function getBeritaBySlug($slug)
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.slug', $slug)
            ->where('berita.status', 'published')
            ->first();
    }

    /**
     * Get latest berita
     */
    public function getLatestBerita($limit = 5)
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.status', 'published')
            ->orderBy('berita.tanggal_publikasi', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get popular berita (dummy - karena tidak ada field views)
     */
    public function getPopularBerita($limit = 5)
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.status', 'published')
            ->orderBy('berita.tanggal_publikasi', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Search berita
     */
    public function searchBerita($keyword)
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->like('berita.judul', $keyword)
            ->orLike('berita.konten', $keyword)
            ->where('berita.status', 'published')
            ->orderBy('berita.tanggal_publikasi', 'DESC')
            ->findAll();
    }

    /**
     * Get total berita
     */
    public function getTotalBerita()
    {
        return $this->where('status', 'published')->countAllResults();
    }

    /**
     * Get berita by ID
     */
    public function getBeritaById($idBerita)
    {
        return $this->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.id_berita', $idBerita)
            ->first();
    }
}
