<?php

namespace App\Controllers;

use App\Models\OrganisasiModel;
use App\Models\OfisialModel;
use CodeIgniter\Database\BaseBuilder;

class Profil extends BaseController
{
    protected $db;
    protected $organisasiModel;
    protected $ofisialModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->organisasiModel = new OrganisasiModel();
        $this->ofisialModel = new OfisialModel();
    }

    public function index()
    {
        // Ambil data organisasi provinsi
        $organisasiProvinsi = $this->organisasiModel->getOrganisasiProvinsi();

        // Ambil data organisasi kabupaten/kota
        $organisasiKabupaten = $this->organisasiModel->getOrganisasiKabupaten();

        // Ambil data pengurus aktif PTMSI Sumbar (organisasi provinsi)
        $pengurusModel = new \App\Models\PengurusModel();
        $orgProv = $organisasiProvinsi[0]['id_organisasi'] ?? null;
        $pengurusProvinsi = $orgProv ? $pengurusModel->where('id_organisasi', $orgProv)->where('status', 'aktif')->orderBy('jabatan', 'ASC')->findAll() : [];

        $data = [
            'title' => 'Profil PTMSI Sumbar',
            'organisasiProvinsi' => $organisasiProvinsi,
            'organisasiKabupaten' => $organisasiKabupaten ?: [],
            'pengurusProvinsi' => $pengurusProvinsi ?: [],
        ];

        return view('profil', $data);
    }

    /**
     * Ambil struktur organisasi provinsi
     */
    private function getStrukturProvinsi()
    {
        try {
            return $this->db->table('ofisial')
                ->select('ofisial.*, user.nama_lengkap, user.email, user.nohp')
                ->join('user', 'user.id_user = ofisial.id_user', 'left')
                ->where('ofisial.status', 'aktif')
                ->orderBy('user.nama_lengkap', 'ASC')
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}
