<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengurusModel;
use App\Models\OrganisasiModel;

class Pengurus extends BaseController
{
    protected $pengurusModel;
    protected $organisasiModel;

    public function __construct()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            redirect()->to('auth/login')->send();
            exit;
        }

        $this->pengurusModel = new PengurusModel();
        $this->organisasiModel = new OrganisasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Pengurus',
            'pengurus' => $this->pengurusModel->getPengurusWithOrganisasi(),
            'organisasi' => $this->organisasiModel->findAll()
        ];

        return view('admin/pengurus', $data);
    }

    public function get($id)
    {
        $pengurus = $this->pengurusModel->find($id);
        if (!$pengurus) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pengurus tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $pengurus
        ]);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'jabatan' => 'required|min_length[3]|max_length[50]',
            'email' => 'permit_empty|valid_email',
            'telepon' => 'permit_empty|min_length[10]'
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
            'id_organisasi' => $this->request->getPost('id_organisasi') ?: null,
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telepon' => $this->request->getPost('telepon') ?: null,
            'email' => $this->request->getPost('email') ?: null,
            'periode_mulai' => $this->request->getPost('periode_mulai') ?: null,
            'periode_selesai' => $this->request->getPost('periode_selesai') ?: null,
            'status' => $this->request->getPost('status') ?: 'aktif'
        ];

        if ($this->pengurusModel->insert($data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pengurus berhasil ditambahkan'
                ]);
            }
            return redirect()->to('admin/pengurus')->with('success', 'Pengurus berhasil ditambahkan');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan pengurus'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengurus');
    }

    public function update($id)
    {
        $pengurus = $this->pengurusModel->find($id);
        if (!$pengurus) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pengurus tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/pengurus')->with('error', 'Pengurus tidak ditemukan');
        }

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'jabatan' => 'required|min_length[3]|max_length[50]',
            'email' => 'permit_empty|valid_email',
            'telepon' => 'permit_empty|min_length[10]'
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
            'id_organisasi' => $this->request->getPost('id_organisasi') ?: null,
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telepon' => $this->request->getPost('telepon') ?: null,
            'email' => $this->request->getPost('email') ?: null,
            'periode_mulai' => $this->request->getPost('periode_mulai') ?: null,
            'periode_selesai' => $this->request->getPost('periode_selesai') ?: null,
            'status' => $this->request->getPost('status') ?: 'aktif'
        ];

        if ($this->pengurusModel->update($id, $data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pengurus berhasil diupdate'
                ]);
            }
            return redirect()->to('admin/pengurus')->with('success', 'Pengurus berhasil diupdate');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate pengurus'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate pengurus');
    }

    public function delete($id)
    {
        $pengurus = $this->pengurusModel->find($id);
        if (!$pengurus) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pengurus tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/pengurus')->with('error', 'Pengurus tidak ditemukan');
        }

        if ($this->pengurusModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Pengurus berhasil dihapus'
                ]);
            }
            return redirect()->to('admin/pengurus')->with('success', 'Pengurus berhasil dihapus');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus pengurus'
            ]);
        }
        return redirect()->to('admin/pengurus')->with('error', 'Gagal menghapus pengurus');
    }
}
