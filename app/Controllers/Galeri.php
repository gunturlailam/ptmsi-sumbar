<?php

namespace App\Controllers;

use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
    }

    /**
     * Display galeri page
     */
    public function index()
    {
        $data = [
            'title' => 'Galeri - PTMSI Sumbar',
            'galeri' => $this->galeriModel->getLatestGaleri(24),
            'fotoKegiatan' => $this->galeriModel->getFotoKegiatan(),
            'videoHighlight' => $this->galeriModel->getVideoHighlight(),
            'totalFoto' => $this->galeriModel->getTotalByJenis('gambar'),
            'totalVideo' => $this->galeriModel->getTotalByJenis('video')
        ];

        return view('galeri/index', $data);
    }

    /**
     * Display foto kegiatan
     */
    public function foto()
    {
        $data = [
            'title' => 'Foto Kegiatan - PTMSI Sumbar',
            'galeri' => $this->galeriModel->getFotoKegiatan()
        ];

        return view('galeri/foto', $data);
    }

    /**
     * Display video highlight
     */
    public function video()
    {
        $data = [
            'title' => 'Video Highlight - PTMSI Sumbar',
            'galeri' => $this->galeriModel->getVideoHighlight()
        ];

        return view('galeri/video', $data);
    }

    /**
     * Display galeri by event
     */
    public function event($idEvent)
    {
        $data = [
            'title' => 'Galeri Event - PTMSI Sumbar',
            'galeri' => $this->galeriModel->getGaleriByEvent($idEvent)
        ];

        return view('galeri/event', $data);
    }
}
