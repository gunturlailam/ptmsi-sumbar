<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\MediaBeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;
    protected $mediaBeritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->mediaBeritaModel = new MediaBeritaModel();
    }

    /**
     * Display berita page
     */
    public function index()
    {
        $data = [
            'title' => 'Berita - PTMSI Sumbar',
            'berita' => $this->beritaModel->getPublishedBerita(),
            'beritaKejuaraan' => $this->beritaModel->getBeritaByKategori('kejuaraan'),
            'beritaAtlet' => $this->beritaModel->getBeritaByKategori('atlet_berprestasi'),
            'pengumuman' => $this->beritaModel->getBeritaByKategori('pengumuman'),
            'artikel' => $this->beritaModel->getBeritaByKategori('artikel_pembinaan'),
            'popular' => $this->beritaModel->getPopularBerita(5)
        ];

        return view('berita', $data);
    }

    /**
     * Display berita detail
     */
    public function detail($slug)
    {
        $berita = $this->beritaModel->getBeritaBySlug($slug);

        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get media
        $media = $this->mediaBeritaModel->getMediaByBerita($berita['id_berita']);

        $data = [
            'title' => $berita['judul'] . ' - PTMSI Sumbar',
            'berita' => $berita,
            'media' => $media,
            'related' => $this->beritaModel->getLatestBerita(4)
        ];

        return view('berita/detail', $data);
    }

    /**
     * Get berita by kategori
     */
    public function kategori($kategori)
    {
        $data = [
            'title' => ucfirst(str_replace('_', ' ', $kategori)) . ' - PTMSI Sumbar',
            'kategori' => $kategori,
            'berita' => $this->beritaModel->getBeritaByKategori($kategori)
        ];

        return view('berita/kategori', $data);
    }

    /**
     * Search berita
     */
    public function search()
    {
        $keyword = $this->request->getGet('q');

        $data = [
            'title' => 'Pencarian: ' . $keyword . ' - PTMSI Sumbar',
            'keyword' => $keyword,
            'berita' => $this->beritaModel->searchBerita($keyword)
        ];

        return view('berita/search', $data);
    }
}
