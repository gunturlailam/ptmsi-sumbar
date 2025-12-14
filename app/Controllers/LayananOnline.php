<?php

namespace App\Controllers;

use App\Models\PendaftaranAtletModel;
use App\Models\PendaftaranEventModel;
use App\Models\EventModel;
use App\Models\KlubModel;

class LayananOnline extends BaseController
{
    protected $pendaftaranAtletModel;
    protected $pendaftaranEventModel;
    protected $eventModel;
    protected $klubModel;

    public function __construct()
    {
        $this->pendaftaranAtletModel = new PendaftaranAtletModel();
        $this->pendaftaranEventModel = new PendaftaranEventModel();
        $this->eventModel = new EventModel();
        $this->klubModel = new KlubModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Layanan Online',
            'events' => $this->eventModel->where('status', 'aktif')
                ->where('batas_pendaftaran >=', date('Y-m-d'))
                ->findAll(),
        ];

        return view('layanan_online', $data);
    }

    /**
     * Submit Pendaftaran Atlet
     */
    public function submitAtlet()
    {
        $rules = [
            'nama_atlet'    => 'required|min_length[3]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'klub'          => 'required',
            'email'         => 'required|valid_email',
            'nohp'          => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_lengkap'  => $this->request->getPost('nama_atlet'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'klub'          => $this->request->getPost('klub'),
            'email'         => $this->request->getPost('email'),
            'nohp'          => $this->request->getPost('nohp'),
            'status'        => 'pending',
        ];

        if ($this->pendaftaranAtletModel->insert($data)) {
            return redirect()->to('/layanan-online')->with('success', 'Pendaftaran atlet berhasil dikirim. Silakan tunggu verifikasi dari admin.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim pendaftaran. Silakan coba lagi.');
        }
    }

    /**
     * Submit Pendaftaran Klub
     */
    public function submitKlub()
    {
        $rules = [
            'nama_klub'         => 'required|min_length[3]',
            'alamat'            => 'required',
            'penanggung_jawab'  => 'required',
            'telepon'           => 'required',
            'email'             => 'required|valid_email',
            'tanggal_berdiri'   => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_klub'         => $this->request->getPost('nama_klub'),
            'alamat'            => $this->request->getPost('alamat'),
            'penanggung_jawab'  => $this->request->getPost('penanggung_jawab'),
            'telepon'           => $this->request->getPost('telepon'),
            'email'             => $this->request->getPost('email'),
            'tanggal_berdiri'   => $this->request->getPost('tanggal_berdiri'),
            'status'            => 'pending',
        ];

        if ($this->klubModel->insert($data)) {
            return redirect()->to('/layanan-online')->with('success', 'Pendaftaran klub berhasil dikirim. Silakan tunggu verifikasi dari admin.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim pendaftaran. Silakan coba lagi.');
        }
    }

    /**
     * Submit Pendaftaran Turnamen
     */
    public function submitTurnamen()
    {
        $rules = [
            'id_event'  => 'required|integer',
            'kategori'  => 'required',
            'atlet1'    => 'required',
            'klub'      => 'required',
            'nohp'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_event'          => $this->request->getPost('id_event'),
            'tipe_pendaftar'    => 'atlet',
            'kategori'          => $this->request->getPost('kategori'),
            'nama_atlet1'       => $this->request->getPost('atlet1'),
            'nama_atlet2'       => $this->request->getPost('atlet2'),
            'nohp_pendaftar'    => $this->request->getPost('nohp'),
            'status_pembayaran' => 'belum_bayar',
            'status_verifikasi' => 'pending',
        ];

        if ($this->pendaftaranEventModel->insert($data)) {
            return redirect()->to('/layanan-online')->with('success', 'Pendaftaran turnamen berhasil. Silakan lakukan pembayaran dan upload bukti pembayaran.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim pendaftaran. Silakan coba lagi.');
        }
    }

    /**
     * Submit SK Klub
     */
    public function submitSkKlub()
    {
        $rules = [
            'nama_klub'      => 'required',
            'tanggal_berdiri' => 'required|valid_date',
            'alamat'         => 'required',
            'ketua'          => 'required',
            'nohp_ketua'     => 'required',
            'jumlah_atlet'   => 'required|integer|greater_than_equal_to[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $dokumen = $this->request->getFile('dokumen');
        $dokumenPath = null;

        if ($dokumen && $dokumen->isValid() && !$dokumen->hasMoved()) {
            $dokumenPath = $dokumen->store('dokumen_sk_klub');
        }

        $data = [
            'nama_klub'       => $this->request->getPost('nama_klub'),
            'tanggal_berdiri' => $this->request->getPost('tanggal_berdiri'),
            'alamat'          => $this->request->getPost('alamat'),
            'ketua'           => $this->request->getPost('ketua'),
            'telepon'         => $this->request->getPost('nohp_ketua'),
            'email'           => $this->request->getPost('email') ?? '',
            'status'          => 'pending',
        ];

        if ($this->klubModel->insert($data)) {
            return redirect()->to('/layanan-online')->with('success', 'Pengajuan SK Klub berhasil dikirim. Silakan tunggu verifikasi dari admin.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim pengajuan. Silakan coba lagi.');
        }
    }

    /**
     * Submit Sertifikasi
     */
    public function submitSertifikasi()
    {
        $rules = [
            'nama'              => 'required',
            'nik'               => 'required|exact_length[16]',
            'jenis_sertifikasi' => 'required',
            'klub'              => 'required',
            'email'             => 'required|valid_email',
            'nohp'              => 'required',
            'pengalaman'        => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $dokumen = $this->request->getFile('dokumen');
        $dokumenPath = null;

        if ($dokumen && $dokumen->isValid() && !$dokumen->hasMoved()) {
            $dokumenPath = $dokumen->store('dokumen_sertifikasi');
        }

        // Store in sertifikasi table (you may need to create this model)
        // For now, just return success

        return redirect()->to('/layanan-online')->with('success', 'Pengajuan sertifikasi berhasil dikirim. Silakan tunggu verifikasi dari admin.');
    }
}
