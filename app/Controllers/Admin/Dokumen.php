<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenModel;

class Dokumen extends BaseController
{
    protected $dokumenModel;

    public function __construct()
    {
        // Check if user is logged in and is admin
        if (!session()->get('logged_in')) {
            redirect()->to('auth/login')->send();
            exit;
        }

        if (session()->get('role') !== 'admin') {
            redirect()->to('/')->with('error', 'Akses ditolak')->send();
            exit;
        }

        $this->dokumenModel = new DokumenModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');

        $builder = $this->dokumenModel->select('dokumen.*, user.nama_lengkap as nama_pengunggah')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('dokumen.judul', $search)
                ->orLike('dokumen.kategori', $search)
                ->groupEnd();
        }

        if ($kategori) {
            $builder->where('dokumen.kategori', $kategori);
        }

        $dokumen = $builder->orderBy('dokumen.diunggah_pada', 'DESC')->findAll();

        // Get all categories for filter
        $allKategori = $this->dokumenModel->getAllKategori();

        $data = [
            'title'        => 'Manajemen Dokumen',
            'dokumen'      => $dokumen,
            'search'       => $search,
            'kategori'     => $kategori,
            'allKategori'  => $allKategori,
        ];

        return view('admin/dokumen', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Dokumen',
        ];

        return view('admin/dokumen/create', $data);
    }

    public function store()
    {
        $rules = [
            'judul'     => 'required|min_length[3]',
            'kategori'  => 'required',
            'file'      => 'uploaded[file]|max_size[file,10240]|ext_in[file,pdf,doc,docx,xls,xlsx,ppt,pptx]',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors'  => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');

        // Create upload directory if it doesn't exist
        if (!is_dir('uploads/dokumen')) {
            mkdir('uploads/dokumen', 0755, true);
        }

        $fileName = $file->getRandomName();
        $file->move('uploads/dokumen', $fileName);

        $data = [
            'judul'         => $this->request->getPost('judul'),
            'kategori'      => $this->request->getPost('kategori'),
            'file_url'      => 'uploads/dokumen/' . $fileName,
            'id_pengunggah' => session()->get('id_user'),
            'diunggah_pada' => date('Y-m-d H:i:s'),
        ];

        if ($this->dokumenModel->insert($data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dokumen berhasil ditambahkan'
                ]);
            }
            return redirect()->to('admin/dokumen')->with('success', 'Dokumen berhasil ditambahkan');
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan dokumen'
                ]);
            }
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan dokumen');
        }
    }

    public function get($id)
    {
        $dokumen = $this->dokumenModel->getDokumenById($id);

        if (!$dokumen) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Dokumen tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data'    => $dokumen
        ]);
    }

    public function edit($id)
    {
        $dokumen = $this->dokumenModel->getDokumenById($id);

        if (!$dokumen) {
            return redirect()->to('admin/dokumen')->with('error', 'Dokumen tidak ditemukan');
        }

        $data = [
            'title'   => 'Edit Dokumen',
            'dokumen' => $dokumen,
        ];

        return view('admin/dokumen/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'judul'     => 'required|min_length[3]',
            'kategori'  => 'required',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors'  => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'judul'    => $this->request->getPost('judul'),
            'kategori' => $this->request->getPost('kategori'),
        ];

        // Handle file upload jika ada file baru
        $file = $this->request->getFile('file');
        if ($file && $file->isValid()) {
            // Validate file
            if (!in_array($file->getExtension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) {
                if ($this->request->isAJAX()) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Format file tidak didukung'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Format file tidak didukung');
            }

            // Hapus file lama
            $dokumen = $this->dokumenModel->find($id);
            if ($dokumen && isset($dokumen['file_url']) && file_exists($dokumen['file_url'])) {
                unlink($dokumen['file_url']);
            }

            // Create upload directory if it doesn't exist
            if (!is_dir('uploads/dokumen')) {
                mkdir('uploads/dokumen', 0755, true);
            }

            // Upload file baru
            $fileName = $file->getRandomName();
            $file->move('uploads/dokumen', $fileName);
            $data['file_url'] = 'uploads/dokumen/' . $fileName;
        }

        if ($this->dokumenModel->update($id, $data)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dokumen berhasil diupdate'
                ]);
            }
            return redirect()->to('admin/dokumen')->with('success', 'Dokumen berhasil diupdate');
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate dokumen'
                ]);
            }
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate dokumen');
        }
    }

    public function delete($id)
    {
        $dokumen = $this->dokumenModel->find($id);

        if (!$dokumen) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Dokumen tidak ditemukan'
                ]);
            }
            return redirect()->to('admin/dokumen')->with('error', 'Dokumen tidak ditemukan');
        }

        // Hapus file
        if (isset($dokumen['file_url']) && file_exists($dokumen['file_url'])) {
            unlink($dokumen['file_url']);
        }

        if ($this->dokumenModel->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dokumen berhasil dihapus'
                ]);
            }
            return redirect()->to('admin/dokumen')->with('success', 'Dokumen berhasil dihapus');
        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus dokumen'
                ]);
            }
            return redirect()->to('admin/dokumen')->with('error', 'Gagal menghapus dokumen');
        }
    }
}
