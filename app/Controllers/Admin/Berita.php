<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;

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

        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Berita',
            'berita' => $this->beritaModel->orderBy('tanggal_publikasi', 'DESC')->findAll()
        ];

        return view('admin/berita/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Berita'
        ];

        return view('admin/berita/create', $data);
    }

    public function store()
    {
        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'slug' => 'required|is_unique[berita.slug]',
            'konten' => 'required',
            'kategori' => 'required',
            'status' => 'required|in_list[draft,published]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'slug' => $this->request->getPost('slug'),
            'konten' => $this->request->getPost('konten'),
            'kategori' => $this->request->getPost('kategori'),
            'status' => $this->request->getPost('status'),
            'tanggal_publikasi' => $this->request->getPost('tanggal_publikasi') ?: date('Y-m-d H:i:s'),
            'penulis_id' => session()->get('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $newName = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/assets/img/berita', $newName);
            $data['gambar'] = 'assets/img/berita/' . $newName;
        }

        if ($this->beritaModel->insert($data)) {
            return redirect()->to('admin/berita')->with('success', 'Berita berhasil ditambahkan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan berita');
    }

    public function edit($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            return redirect()->to('admin/berita')->with('error', 'Berita tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Berita',
            'berita' => $berita
        ];

        return view('admin/berita/edit', $data);
    }

    public function update($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            return redirect()->to('admin/berita')->with('error', 'Berita tidak ditemukan');
        }

        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'slug' => "required|is_unique[berita.slug,id,{$id}]",
            'konten' => 'required',
            'kategori' => 'required',
            'status' => 'required|in_list[draft,published]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'slug' => $this->request->getPost('slug'),
            'konten' => $this->request->getPost('konten'),
            'kategori' => $this->request->getPost('kategori'),
            'status' => $this->request->getPost('status'),
            'tanggal_publikasi' => $this->request->getPost('tanggal_publikasi'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Delete old image
            if ($berita['gambar'] && file_exists(ROOTPATH . 'public/' . $berita['gambar'])) {
                unlink(ROOTPATH . 'public/' . $berita['gambar']);
            }

            $newName = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/assets/img/berita', $newName);
            $data['gambar'] = 'assets/img/berita/' . $newName;
        }

        if ($this->beritaModel->update($id, $data)) {
            return redirect()->to('admin/berita')->with('success', 'Berita berhasil diupdate');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate berita');
    }

    public function delete($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            return redirect()->to('admin/berita')->with('error', 'Berita tidak ditemukan');
        }

        // Delete image
        if ($berita['gambar'] && file_exists(ROOTPATH . 'public/' . $berita['gambar'])) {
            unlink(ROOTPATH . 'public/' . $berita['gambar']);
        }

        if ($this->beritaModel->delete($id)) {
            return redirect()->to('admin/berita')->with('success', 'Berita berhasil dihapus');
        }

        return redirect()->to('admin/berita')->with('error', 'Gagal menghapus berita');
    }
}
