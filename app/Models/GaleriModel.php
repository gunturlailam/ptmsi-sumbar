<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    protected $allowedFields = [
        'judul',
        'jenis_media',
        'url',
        'id_event',
        'diunggah_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Get all galeri
     */
    public function getAllGaleri()
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->orderBy('galeri.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get galeri by jenis media
     */
    public function getGaleriByJenis($jenisMedia)
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->where('galeri.jenis_media', $jenisMedia)
            ->orderBy('galeri.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get foto kegiatan
     */
    public function getFotoKegiatan()
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->where('galeri.jenis_media', 'gambar')
            ->orderBy('galeri.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get video highlight
     */
    public function getVideoHighlight()
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->where('galeri.jenis_media', 'video')
            ->orderBy('galeri.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get galeri by event
     */
    public function getGaleriByEvent($idEvent)
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->where('galeri.id_event', $idEvent)
            ->orderBy('galeri.diunggah_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get latest galeri
     */
    public function getLatestGaleri($limit = 12)
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->orderBy('galeri.diunggah_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get galeri by ID
     */
    public function getGaleriById($idGaleri)
    {
        return $this->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left')
            ->where('galeri.id_galeri', $idGaleri)
            ->first();
    }

    /**
     * Get total galeri
     */
    public function getTotalGaleri()
    {
        return $this->countAll();
    }

    /**
     * Get total by jenis
     */
    public function getTotalByJenis($jenisMedia)
    {
        return $this->where('jenis_media', $jenisMedia)->countAllResults();
    }
}
