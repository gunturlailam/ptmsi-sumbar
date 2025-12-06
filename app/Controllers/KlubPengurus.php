<?php

namespace App\Controllers;

use App\Models\KlubModel;
use App\Models\OrganisasiModel;
use App\Models\PengurusModel;

class KlubPengurus extends BaseController
{
    protected $klubModel;
    protected $organisasiModel;
    protected $pengurusModel;

    public function __construct()
    {
        $this->klubModel = new KlubModel();
        $this->organisasiModel = new OrganisasiModel();
        $this->pengurusModel = new PengurusModel();
    }

    /**
     * Display klub dan pengurus page
     */
    public function index()
    {
        // Data dummy untuk wasit (nanti bisa diganti dengan data dari database)
        $wasit = [
            [
                'nama' => 'Drs. Agus Salim',
                'jenis' => 'Wasit',
                'lisensi' => 'Lisensi Nasional A',
                'kab_kota' => 'Padang',
                'telepon' => '0812-1111-2222'
            ],
            [
                'nama' => 'Ir. Budi Hartono',
                'jenis' => 'Wasit',
                'lisensi' => 'Lisensi Nasional B',
                'kab_kota' => 'Bukittinggi',
                'telepon' => '0813-2222-3333'
            ],
            [
                'nama' => 'Dra. Citra Dewi',
                'jenis' => 'Ofisial',
                'lisensi' => 'Lisensi Provinsi',
                'kab_kota' => 'Padang',
                'telepon' => '0814-3333-4444'
            ],
            [
                'nama' => 'Eko Prasetyo, S.Pd.',
                'jenis' => 'Wasit',
                'lisensi' => 'Lisensi Provinsi',
                'kab_kota' => 'Payakumbuh',
                'telepon' => '0815-4444-5555'
            ],
            [
                'nama' => 'Fitri Handayani',
                'jenis' => 'Ofisial',
                'lisensi' => 'Lisensi Kabupaten',
                'kab_kota' => 'Solok',
                'telepon' => '0816-5555-6666'
            ],
        ];

        $data = [
            'title' => 'Klub & Pengurus - PTMSI Sumbar',
            'klub' => $this->klubModel->getKlubWithOrganisasi(),
            'organisasi' => $this->organisasiModel->getAllOrganisasi(),
            'pengurus' => $this->pengurusModel->getPengurusWithOrganisasi(),
            'wasit' => $wasit
        ];

        return view('klub_pengurus/index', $data);
    }

    /**
     * Get klub by organisasi (AJAX)
     */
    public function getKlubByOrganisasi($idOrganisasi)
    {
        if ($this->request->isAJAX()) {
            $klub = $this->klubModel->getKlubByOrganisasi($idOrganisasi);
            return $this->response->setJSON($klub);
        }

        return redirect()->to('/klub-pengurus');
    }

    /**
     * Get pengurus by organisasi (AJAX)
     */
    public function getPengurusByOrganisasi($idOrganisasi)
    {
        if ($this->request->isAJAX()) {
            $pengurus = $this->pengurusModel->getPengurusByOrganisasi($idOrganisasi);
            return $this->response->setJSON($pengurus);
        }

        return redirect()->to('/klub-pengurus');
    }

    /**
     * Search klub (AJAX)
     */
    public function searchKlub()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getGet('keyword');
            $klub = $this->klubModel->searchKlub($keyword);
            return $this->response->setJSON($klub);
        }

        return redirect()->to('/klub-pengurus');
    }
}
