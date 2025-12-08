<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KlubModel;
use App\Models\OrganisasiModel;

class Klub extends BaseController
{
    protected $klubModel;
    protected $organisasiModel;

    public function __construct()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            redirect()->to('auth/login')->send();
            exit;
        }

        $this->klubModel = new KlubModel();
        $this->organisasiModel = new OrganisasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Klub',
            'klub' => $this->klubModel->getKlubWithOrganisasi(),
            'organisasi' => $this->organisasiModel->findAll()
        ];

        return view('admin/klub', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Klub',
            'organisasi' => $this->organisasiModel->findAll()
        ];

        return view('admin/klub_form', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'id_organisasi' => 'required'
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
            'id_organisasi' => $this->request->getPost('id_organisasi'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat') ?: null,
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab') ?: null,
            'telepon' => $this->request->getPost('telepon') ?: null,
            'tanggal_berdiri' => $this->request->getPost('tanggal_berdiri') ?: null,
            'status' => $this->request->getPost('status') ?: null
        ];

        if ($this->klubModel->insert($data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Klub berhasil ditambahkan'
                ]);
            }
            return redirect()->to('admin/klub')->with('success', 'Klub berhasil ditambahkan');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan klub'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan klub');
    }

    public function get($id)
    {
        $klub = $this->klubModel->find($id);
        if (!$klub) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Klub tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $klub
        ]);
    }

    public function edit($id)
    {
        $klub = $this->klubModel->find($id);
        if (!$klub) {
            return redirect()->to('admin/klub')->with('error', 'Klub tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Klub',
            'klub' => $klub,
            'organisasi' => $this->organisasiModel->findAll()
        ];

        return view('admin/klub_form', $data);
    }

    public function update($id)
    {
        $klub = $this->klubModel->find($id);
        if (!$klub) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Klub tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/klub')->with('error', 'Klub tidak ditemukan');
        }

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'id_organisasi' => 'required'
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
            'id_organisasi' => $this->request->getPost('id_organisasi'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat') ?: null,
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab') ?: null,
            'telepon' => $this->request->getPost('telepon') ?: null,
            'tanggal_berdiri' => $this->request->getPost('tanggal_berdiri') ?: null,
            'status' => $this->request->getPost('status') ?: null
        ];

        if ($this->klubModel->update($id, $data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Klub berhasil diupdate'
                ]);
            }
            return redirect()->to('admin/klub')->with('success', 'Klub berhasil diupdate');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate klub'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate klub');
    }

    public function delete($id)
    {
        $klub = $this->klubModel->find($id);
        if (!$klub) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Klub tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/klub')->with('error', 'Klub tidak ditemukan');
        }

        if ($this->klubModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Klub berhasil dihapus'
                ]);
            }
            return redirect()->to('admin/klub')->with('success', 'Klub berhasil dihapus');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus klub'
            ]);
        }
        return redirect()->to('admin/klub')->with('error', 'Gagal menghapus klub');
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
