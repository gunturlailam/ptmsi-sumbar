<?php

namespace App\Controllers;

use App\Models\PendaftaranEventModel;
use App\Models\SertifikasiModel;
use App\Models\KlubModel;
use App\Models\EventModel;

class LayananOnline extends BaseController
{
    protected $pendaftaranModel;
    protected $sertifikasiModel;
    protected $klubModel;
    protected $eventModel;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranEventModel();
        $this->sertifikasiModel = new SertifikasiModel();
        $this->klubModel = new KlubModel();
        $this->eventModel = new \App\Models\EventModel();
    }

    public function index()
    {
        // Get data for display
        $events = $this->eventModel->orderBy('tanggal_mulai', 'DESC')->findAll(5);
        $pendaftaran = $this->pendaftaranModel->getPendaftaranWithDetails();

        $data = [
            'title' => 'Layanan Online',
            'events' => $events,
            'pendaftaran' => $pendaftaran,
        ];

        return view('layanan_online', $data);
    }

    public function submitPendaftaranAtlet()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_event' => 'required|integer',
            'id_atlet' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $data = [
            'id_event' => $this->request->getPost('id_event'),
            'tipe_pendaftar' => 'atlet',
            'id_atlet' => $this->request->getPost('id_atlet'),
            'id_klub' => null,
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status_pembayaran' => 'pending',
        ];

        if ($this->pendaftaranModel->insert($data)) {
            return redirect()->to('layanan-online')->with('success', 'Pendaftaran atlet berhasil!');
        }

        return redirect()->back()->with('error', 'Pendaftaran gagal');
    }

    public function submitPendaftaranKlub()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_event' => 'required|integer',
            'id_klub' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $data = [
            'id_event' => $this->request->getPost('id_event'),
            'tipe_pendaftar' => 'klub',
            'id_klub' => $this->request->getPost('id_klub'),
            'id_atlet' => null,
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status_pembayaran' => 'pending',
        ];

        if ($this->pendaftaranModel->insert($data)) {
            return redirect()->to('layanan-online')->with('success', 'Pendaftaran klub berhasil!');
        }

        return redirect()->back()->with('error', 'Pendaftaran gagal');
    }

    public function submitSertifikasi()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_pelatih' => 'required|integer',
            'jenis_sertifikasi' => 'required|string',
            'tanggal_dikeluarkan' => 'required|valid_date',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $data = [
            'id_pelatih' => $this->request->getPost('id_pelatih'),
            'jenis_sertifikasi' => $this->request->getPost('jenis_sertifikasi'),
            'tanggal_dikeluarkan' => $this->request->getPost('tanggal_dikeluarkan'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'file_url' => null,
        ];

        if ($this->sertifikasiModel->insert($data)) {
            return redirect()->to('layanan-online')->with('success', 'Pengajuan sertifikasi berhasil!');
        }

        return redirect()->back()->with('error', 'Pengajuan gagal');
    }
}
