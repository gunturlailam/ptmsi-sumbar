<?php

namespace App\Controllers;

use App\Models\AtletModel;
use App\Models\PelatihModel;
use CodeIgniter\Database\BaseBuilder;

class AtletPelatih extends BaseController
{
    protected $db;
    protected $atletModel;
    protected $pelatihModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
    }

    public function index()
    {
        // Ambil data atlet dengan join user dan klub
        $atlet = $this->db->table('atlet')
            ->select('atlet.*, user.nama_lengkap, user.email, user.nohp, klub.nama as nama_klub')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->orderBy('atlet.dibuat_pada', 'DESC')
            ->get()
            ->getResultArray();

        // Ambil data pelatih dengan join user dan klub
        $pelatih = $this->db->table('pelatih')
            ->select('pelatih.*, user.nama_lengkap, user.email, user.nohp, klub.nama as nama_klub')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Atlet & Pelatih - PTMSI Sumbar',
            'atlet' => $atlet,
            'pelatih' => $pelatih
        ];

        return view('atlet_pelatih', $data);
    }
}
