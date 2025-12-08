<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PelatihModel;
use App\Models\UserModel;
use App\Models\KlubModel;

class Pelatih extends BaseController
{
    protected $pelatihModel;
    protected $userModel;
    protected $klubModel;

    public function __construct()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            redirect()->to('auth/login')->send();
            exit;
        }

        $this->pelatihModel = new PelatihModel();
        $this->userModel = new UserModel();
        $this->klubModel = new KlubModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Pelatih',
            'pelatih' => $this->pelatihModel->getPelatihWithKlub(),
            'users' => $this->userModel->where('peran', 'pelatih')->findAll(),
            'klub' => $this->klubModel->findAll()
        ];

        return view('admin/pelatih', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pelatih',
            'users' => $this->userModel->where('peran', 'pelatih')->findAll(),
            'klub' => $this->klubModel->findAll()
        ];

        return view('admin/pelatih_form', $data);
    }

    public function store()
    {
        $rules = [
            'id_user' => 'required'
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'id_klub' => $this->request->getPost('id_klub') ?: null,
            'tingkat_sertifikasi' => $this->request->getPost('tingkat_sertifikasi') ?: null,
            'tanggal_sertifikasi' => $this->request->getPost('tanggal_sertifikasi') ?: null
        ];

        if ($this->pelatihModel->insert($data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pelatih berhasil ditambahkan'
                ]);
            }
            return redirect()->to('admin/pelatih')->with('success', 'Pelatih berhasil ditambahkan');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan pelatih'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pelatih');
    }

    public function get($id)
    {
        $pelatih = $this->pelatihModel->find($id);
        if (!$pelatih) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pelatih tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $pelatih
        ]);
    }

    public function edit($id)
    {
        $pelatih = $this->pelatihModel->find($id);
        if (!$pelatih) {
            return redirect()->to('admin/pelatih')->with('error', 'Pelatih tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Pelatih',
            'pelatih' => $pelatih,
            'users' => $this->userModel->where('peran', 'pelatih')->findAll(),
            'klub' => $this->klubModel->findAll()
        ];

        return view('admin/pelatih_form', $data);
    }

    public function update($id)
    {
        $pelatih = $this->pelatihModel->find($id);
        if (!$pelatih) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pelatih tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/pelatih')->with('error', 'Pelatih tidak ditemukan');
        }

        $rules = [
            'id_user' => 'required'
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'id_klub' => $this->request->getPost('id_klub') ?: null,
            'tingkat_sertifikasi' => $this->request->getPost('tingkat_sertifikasi') ?: null,
            'tanggal_sertifikasi' => $this->request->getPost('tanggal_sertifikasi') ?: null
        ];

        if ($this->pelatihModel->update($id, $data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pelatih berhasil diupdate'
                ]);
            }
            return redirect()->to('admin/pelatih')->with('success', 'Pelatih berhasil diupdate');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate pelatih'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate pelatih');
    }

    public function delete($id)
    {
        $pelatih = $this->pelatihModel->find($id);
        if (!$pelatih) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pelatih tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/pelatih')->with('error', 'Pelatih tidak ditemukan');
        }

        if ($this->pelatihModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pelatih berhasil dihapus'
                ]);
            }
            return redirect()->to('admin/pelatih')->with('success', 'Pelatih berhasil dihapus');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus pelatih'
            ]);
        }
        return redirect()->to('admin/pelatih')->with('error', 'Gagal menghapus pelatih');
    }

    private function generateUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
