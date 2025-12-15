<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;
use App\Models\EventModel;

class Galeri extends BaseController
{
    protected $galeriModel;
    protected $eventModel;

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

        $this->galeriModel = new GaleriModel();
        $this->eventModel = new EventModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $jenis = $this->request->getGet('jenis');

        $builder = $this->galeriModel->select('galeri.*, event.judul as nama_event')
            ->join('event', 'event.id_event = galeri.id_event', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('galeri.judul', $search)
                ->orLike('event.judul', $search)
                ->groupEnd();
        }

        if ($jenis) {
            $builder->where('galeri.jenis_media', $jenis);
        }

        $galeri = $builder->orderBy('galeri.diunggah_pada', 'DESC')->findAll();

        $data = [
            'title'   => 'Manajemen Galeri',
            'galeri'  => $galeri,
            'search'  => $search,
            'jenis'   => $jenis,
        ];

        return view('admin/galeri', $data);
    }

    public function create()
    {
        $data = [
            'title'  => 'Tambah Galeri',
            'events' => $this->eventModel->findAll(),
        ];

        return view('admin/galeri/create', $data);
    }

    public function store()
    {
        $rules = [
            'judul'       => 'required|min_length[3]',
            'jenis_media' => 'required|in_list[foto,gambar,video]',
            'url'         => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $jenisMedia = $this->request->getPost('jenis_media');
        $url = $this->request->getPost('url');

        // Convert foto to gambar for database compatibility
        if ($jenisMedia === 'foto') {
            $jenisMedia = 'gambar';
        }

        // Handle file upload for images
        if ($jenisMedia === 'gambar') {
            $file = $this->request->getFile('file_upload');
            if ($file && $file->isValid()) {
                if (!in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    return redirect()->back()->withInput()->with('error', 'File harus berupa gambar (jpg, jpeg, png, gif)');
                }
                $fileName = $file->getRandomName();
                $file->move('uploads/galeri', $fileName);
                $url = 'uploads/galeri/' . $fileName;
            }
        }

        $data = [
            'judul'         => $this->request->getPost('judul'),
            'jenis_media'   => $jenisMedia,
            'url'           => $url,
            'id_event'      => $this->request->getPost('id_event') ?: null,
            'diunggah_pada' => date('Y-m-d H:i:s'),
        ];

        if ($this->galeriModel->insert($data)) {
            return redirect()->to('admin/galeri')->with('success', 'Galeri berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan galeri');
        }
    }

    public function update($id)
    {
        $galeri = $this->galeriModel->find($id);
        if (!$galeri) {
            return redirect()->to('admin/galeri')->with('error', 'Galeri tidak ditemukan');
        }

        $rules = [
            'judul'       => 'required|min_length[3]',
            'jenis_media' => 'required|in_list[foto,video]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Convert foto to gambar for database compatibility
        $jenisMedia = $this->request->getPost('jenis_media');
        if ($jenisMedia === 'foto') {
            $jenisMedia = 'gambar';
        }

        $data = [
            'judul'       => $this->request->getPost('judul'),
            'jenis_media' => $jenisMedia,
        ];

        // Handle file upload if new file is provided
        $file = $this->request->getFile('file');
        if ($file && $file->isValid()) {
            if (!in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'])) {
                return redirect()->back()->withInput()->with('error', 'File harus berupa gambar atau video yang valid');
            }

            // Delete old file if exists
            if (isset($galeri['url']) && $galeri['url'] && file_exists($galeri['url'])) {
                unlink($galeri['url']);
            }

            $fileName = $file->getRandomName();
            $uploadPath = $jenisMedia === 'gambar' ? 'uploads/galeri/foto' : 'uploads/galeri/video';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);
            $data['url'] = $uploadPath . '/' . $fileName;
        }

        if ($this->galeriModel->update($id, $data)) {
            return redirect()->to('admin/galeri')->with('success', 'Galeri berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate galeri');
        }
    }

    public function delete($id)
    {
        $galeri = $this->galeriModel->find($id);

        if (!$galeri) {
            return redirect()->to('admin/galeri')->with('error', 'Galeri tidak ditemukan');
        }

        // Hapus file jika ada dan merupakan file lokal
        if (isset($galeri['url']) && strpos($galeri['url'], 'uploads/') === 0 && file_exists($galeri['url'])) {
            unlink($galeri['url']);
        }

        if ($this->galeriModel->delete($id)) {
            return redirect()->to('admin/galeri')->with('success', 'Galeri berhasil dihapus');
        } else {
            return redirect()->to('admin/galeri')->with('error', 'Gagal menghapus galeri');
        }
    }
}
