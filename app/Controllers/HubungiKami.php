<?php

namespace App\Controllers;

use App\Models\PesanKontakModel;

class HubungiKami extends BaseController
{
    protected $pesanKontakModel;

    public function __construct()
    {
        $this->pesanKontakModel = new PesanKontakModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Hubungi Kami',
        ];

        return view('hubungi_kami', $data);
    }

    public function submitPesan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'subjek' => 'required|min_length[5]|max_length[150]',
            'pesan' => 'required|min_length[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon'),
            'subjek' => $this->request->getPost('subjek'),
            'pesan' => $this->request->getPost('pesan'),
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'status' => 'baru',
        ];

        if ($this->pesanKontakModel->insert($data)) {
            return redirect()->to('hubungi-kami')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
    }
}
