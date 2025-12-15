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
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');

        $builder = $this->beritaModel->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('berita.judul', $search)
                ->orLike('berita.konten', $search)
                ->groupEnd();
        }

        if ($kategori) {
            $builder->where('berita.kategori', $kategori);
        }

        $berita = $builder->orderBy('berita.tanggal_publikasi', 'DESC')->findAll();

        $data = [
            'title' => 'Manajemen Berita',
            'berita' => $berita,
            'search' => $search,
            'kategori' => $kategori
        ];

        return view('admin/berita', $data);
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
            'kategori' => 'required|in_list[kejuaraan,atlet,pengumuman,artikel]',
            'status' => 'required|in_list[draft,published]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]'
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
            'id_penulis' => session()->get('user_id')
        ];

        // Handle image upload
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/berita', $newName);
            $data['foto'] = 'uploads/berita/' . $newName;
        }

        if ($this->beritaModel->insert($data)) {
            return redirect()->to('admin/berita')->with('success', 'Berita berhasil ditambahkan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan berita');
    }

    public function edit($id)
    {
        $berita = $this->beritaModel->select('berita.*, user.nama_lengkap as nama_penulis')
            ->join('user', 'user.id_user = berita.id_penulis', 'left')
            ->where('berita.id_berita', $id)
            ->first();

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
        $berita = $this->beritaModel->where('id_berita', $id)->first();

        if (!$berita) {
            return redirect()->to('admin/berita')->with('error', 'Berita tidak ditemukan');
        }

        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'slug' => "required|is_unique[berita.slug,id_berita,{$id}]",
            'konten' => 'required',
            'kategori' => 'required|in_list[kejuaraan,atlet,pengumuman,artikel]',
            'status' => 'required|in_list[draft,published]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]'
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
            'tanggal_publikasi' => $this->request->getPost('tanggal_publikasi')
        ];

        // Handle image upload
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Delete old image
            if (!empty($berita['foto']) && file_exists(ROOTPATH . 'public/' . $berita['foto'])) {
                unlink(ROOTPATH . 'public/' . $berita['foto']);
            }

            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/berita', $newName);
            $data['foto'] = 'uploads/berita/' . $newName;
        }

        if ($this->beritaModel->update($id, $data)) {
            return redirect()->to('admin/berita')->with('success', 'Berita berhasil diupdate');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate berita');
    }

    public function delete($id)
    {
        $berita = $this->beritaModel->where('id_berita', $id)->first();

        if (!$berita) {
            return redirect()->to('admin/berita')->with('error', 'Berita tidak ditemukan');
        }

        // Delete image
        if (!empty($berita['foto']) && file_exists(ROOTPATH . 'public/' . $berita['foto'])) {
            unlink(ROOTPATH . 'public/' . $berita['foto']);
        }

        if ($this->beritaModel->where('id_berita', $id)->delete()) {
            return redirect()->to('admin/berita')->with('success', 'Berita berhasil dihapus');
        }

        return redirect()->to('admin/berita')->with('error', 'Gagal menghapus berita');
    }
}
