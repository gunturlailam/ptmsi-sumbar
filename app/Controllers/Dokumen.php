<?php

namespace App\Controllers;

use App\Models\DokumenModel;
use App\Models\UnduhanDokumenModel;

class Dokumen extends BaseController
{
    protected $dokumenModel;
    protected $unduhanModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->unduhanModel = new UnduhanDokumenModel();
    }

    /**
     * Display dokumen page
     */
    public function index()
    {
        $data = [
            'title' => 'Dokumen & Regulasi - PTMSI Sumbar',
            'dokumen' => $this->dokumenModel->getAllDokumen(),
            'adArt' => $this->dokumenModel->getDokumenByKategori('AD/ART'),
            'peraturan' => $this->dokumenModel->getDokumenByKategori('Peraturan Pertandingan'),
            'panduan' => $this->dokumenModel->getDokumenByKategori('Panduan Klub'),
            'sop' => $this->dokumenModel->getDokumenByKategori('SOP Kejuaraan'),
            'formulir' => $this->dokumenModel->getDokumenByKategori('Formulir'),
            'popular' => $this->unduhanModel->getPopularDokumen(5)
        ];

        return view('dokumen/index', $data);
    }

    /**
     * Download dokumen
     */
    public function download($idDokumen)
    {
        $dokumen = $this->dokumenModel->getDokumenById($idDokumen);

        if (!$dokumen) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Record download
        $idUser = session()->get('id_user') ?? null;
        $this->unduhanModel->recordDownload($idDokumen, $idUser);

        // Redirect to file or force download
        $filePath = FCPATH . $dokumen['file_url'];

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            // If file doesn't exist, redirect to URL
            return redirect()->to($dokumen['file_url']);
        }
    }

    /**
     * Search dokumen
     */
    public function search()
    {
        $keyword = $this->request->getGet('q');

        $data = [
            'title' => 'Pencarian Dokumen: ' . $keyword . ' - PTMSI Sumbar',
            'keyword' => $keyword,
            'dokumen' => $this->dokumenModel->searchDokumen($keyword)
        ];

        return view('dokumen/search', $data);
    }
}
