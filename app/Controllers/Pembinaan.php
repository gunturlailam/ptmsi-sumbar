<?php

namespace App\Controllers;

use App\Models\SertifikasiModel;
use App\Models\PelatihModel;
use CodeIgniter\Database\BaseBuilder;

class Pembinaan extends BaseController
{
    protected $db;
    protected $sertifikasiModel;
    protected $pelatihModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->sertifikasiModel = new SertifikasiModel();
        $this->pelatihModel = new PelatihModel();
    }

    public function index()
    {
        // Ambil semua sertifikasi dengan detail
        $sertifikasi = $this->sertifikasiModel->getSertifikasiWithDetails();

        // Ambil semua pelatih untuk statistik
        $pelatih = $this->db->table('pelatih')
            ->select('pelatih.*, user.nama_lengkap, klub.nama as nama_klub')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->get()
            ->getResultArray();

        // Statistik
        $totalPelatih = count($pelatih);
        $totalSertifikasi = count($sertifikasi);
        $sertifikasiAktif = 0;

        foreach ($sertifikasi as $s) {
            if ($s['tanggal_kadaluarsa']) {
                if (strtotime($s['tanggal_kadaluarsa']) >= strtotime('today')) {
                    $sertifikasiAktif++;
                }
            } else {
                $sertifikasiAktif++;
            }
        }

        $data = [
            'title' => 'Program Pembinaan - PTMSI Sumbar',
            'sertifikasi' => $sertifikasi,
            'pelatih' => $pelatih,
            'totalPelatih' => $totalPelatih,
            'totalSertifikasi' => $totalSertifikasi,
            'sertifikasiAktif' => $sertifikasiAktif
        ];

        return view('pembinaan/index', $data);
    }

    public function detail($id_sertifikasi)
    {
        $sertifikasi = $this->sertifikasiModel->select('sertifikasi.*, 
                                                       pelatih.id_pelatih, 
                                                       pelatih.tingkat_sertifikasi as tingkat_pelatih,
                                                       user.nama_lengkap as nama_pelatih,
                                                       user.email,
                                                       user.nohp,
                                                       klub.nama as nama_klub,
                                                       klub.alamat as alamat_klub')
            ->join('pelatih', 'pelatih.id_pelatih = sertifikasi.id_pelatih', 'left')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->where('sertifikasi.id_sertifikasi', $id_sertifikasi)
            ->first();

        if (!$sertifikasi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Detail Sertifikasi - ' . $sertifikasi['jenis_sertifikasi'],
            'sertifikasi' => $sertifikasi
        ];

        return view('pembinaan/detail', $data);
    }
}
