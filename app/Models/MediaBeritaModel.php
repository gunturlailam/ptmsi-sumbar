<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaBeritaModel extends Model
{
    protected $table = 'media_berita';
    protected $primaryKey = 'id_media';
    protected $allowedFields = [
        'id_berita',
        'jenis',
        'url'
    ];
    protected $useTimestamps = false;

    /**
     * Get media by berita ID
     */
    public function getMediaByBerita($idBerita)
    {
        return $this->where('id_berita', $idBerita)->findAll();
    }

    /**
     * Get thumbnail by berita ID (first image)
     */
    public function getThumbnailByBerita($idBerita)
    {
        return $this->where('id_berita', $idBerita)
            ->where('jenis', 'gambar')
            ->first();
    }

    /**
     * Get all gambar by berita ID
     */
    public function getGambarByBerita($idBerita)
    {
        return $this->where('id_berita', $idBerita)
            ->where('jenis', 'gambar')
            ->findAll();
    }

    /**
     * Get all video by berita ID
     */
    public function getVideoByBerita($idBerita)
    {
        return $this->where('id_berita', $idBerita)
            ->where('jenis', 'video')
            ->findAll();
    }
}
