<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtletModel;
use App\Models\UserModel;
use App\Models\KlubModel;

class Atlet extends BaseController
{
    protected $atletModel;
    protected $userModel;
    protected $klubModel;

    public function __construct()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            redirect()->to('auth/login')->send();
            exit;
        }

        $this->atletModel = new AtletModel();
        $this->userModel = new UserModel();
        $this->klubModel = new KlubModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Atlet',
            'atlet' => $this->atletModel->getAtletWithKlub(),
            'users' => $this->userModel->where('peran', 'atlet')->findAll(),
            'klub' => $this->klubModel->findAll()
        ];

        return view('admin/atlet', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Atlet',
            'users' => $this->userModel->where('peran', 'atlet')->findAll(),
            'klub' => $this->klubModel->findAll()
        ];

        return view('admin/atlet_form', $data);
    }

    public function store()
    {
        $rules = [
            'id_user' => 'required',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]'
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
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'kategori_usia' => $this->request->getPost('kategori_usia') ?: null,
            'ranking_provinsi' => $this->request->getPost('ranking_provinsi') ?: null,
            'status' => $this->request->getPost('status') ?: null,
            'dibuat_pada' => date('Y-m-d H:i:s')
        ];

        if ($this->atletModel->insert($data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Atlet berhasil ditambahkan'
                ]);
            }
            return redirect()->to('admin/atlet')->with('success', 'Atlet berhasil ditambahkan');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan atlet'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan atlet');
    }

    public function get($id)
    {
        $atlet = $this->atletModel->getAtletByIdWithKlub($id);
        if (!$atlet) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Atlet tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $atlet
        ]);
    }

    public function edit($id)
    {
        $atlet = $this->atletModel->find($id);
        if (!$atlet) {
            return redirect()->to('admin/atlet')->with('error', 'Atlet tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Atlet',
            'atlet' => $atlet,
            'users' => $this->userModel->where('peran', 'atlet')->findAll(),
            'klub' => $this->klubModel->findAll()
        ];

        return view('admin/atlet_form', $data);
    }

    public function update($id)
    {
        $atlet = $this->atletModel->find($id);
        if (!$atlet) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Atlet tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/atlet')->with('error', 'Atlet tidak ditemukan');
        }

        $rules = [
            'id_user' => 'required',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]'
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
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'kategori_usia' => $this->request->getPost('kategori_usia') ?: null,
            'ranking_provinsi' => $this->request->getPost('ranking_provinsi') ?: null,
            'status' => $this->request->getPost('status') ?: null
        ];

        if ($this->atletModel->update($id, $data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Atlet berhasil diupdate'
                ]);
            }
            return redirect()->to('admin/atlet')->with('success', 'Atlet berhasil diupdate');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate atlet'
            ]);
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate atlet');
    }

    public function delete($id)
    {
        $atlet = $this->atletModel->find($id);
        if (!$atlet) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Atlet tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/atlet')->with('error', 'Atlet tidak ditemukan');
        }

        if ($this->atletModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Atlet berhasil dihapus'
                ]);
            }
            return redirect()->to('admin/atlet')->with('success', 'Atlet berhasil dihapus');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus atlet'
            ]);
        }
        return redirect()->to('admin/atlet')->with('error', 'Gagal menghapus atlet');
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
