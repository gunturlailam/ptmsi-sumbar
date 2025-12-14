<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KlubModel;
use App\Models\OrganisasiModel;
use App\Models\UserModel;

class PendaftaranKlub extends BaseController
{
    protected $klubModel;
    protected $organisasiModel;
    protected $userModel;

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

        $this->klubModel = new KlubModel();
        $this->organisasiModel = new OrganisasiModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $organisasi = $this->request->getGet('organisasi');

        $builder = $this->klubModel->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('klub.nama', $search)
                ->orLike('klub.penanggung_jawab', $search)
                ->orLike('organisasi.nama_organisasi', $search)
                ->groupEnd();
        }

        if ($status) {
            $builder->where('klub.status', $status);
        }

        if ($organisasi) {
            $builder->where('klub.id_organisasi', $organisasi);
        }

        $klub = $builder->orderBy('klub.tanggal_berdiri', 'DESC')->findAll();

        // Get all organisasi for filter
        $allOrganisasi = $this->organisasiModel->findAll();

        $data = [
            'title'         => 'Pendaftaran Klub',
            'klub'          => $klub,
            'search'        => $search,
            'status'        => $status,
            'organisasi'    => $organisasi,
            'allOrganisasi' => $allOrganisasi,
        ];

        return view('admin/pendaftaran/klub', $data);
    }

    public function pending()
    {
        $klub = $this->klubModel->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->where('klub.status', 'pending')
            ->orderBy('klub.tanggal_berdiri', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Pendaftaran Klub - Menunggu Verifikasi',
            'klub'  => $klub,
        ];

        return view('admin/pendaftaran/klub/pending', $data);
    }

    public function detail($id)
    {
        $klub = $this->klubModel->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->where('klub.id_klub', $id)
            ->first();

        if (!$klub) {
            return redirect()->to('admin/pendaftaran/klub')->with('error', 'Klub tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Pendaftaran Klub - ' . $klub['nama'],
            'klub'  => $klub,
        ];

        return view('admin/pendaftaran/klub/detail', $data);
    }

    public function verifikasi($id)
    {
        $status = $this->request->getPost('status'); // 'aktif' or 'ditolak'
        $catatan = $this->request->getPost('catatan');

        $klub = $this->klubModel->find($id);
        if (!$klub) {
            return redirect()->back()->with('error', 'Klub tidak ditemukan');
        }

        $updateData = [
            'status' => $status,
        ];

        if ($this->klubModel->update($id, $updateData)) {
            $message = $status === 'aktif' ? 'Klub berhasil diverifikasi dan diaktifkan' : 'Klub ditolak';
            return redirect()->to('admin/pendaftaran/klub')->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Gagal memverifikasi klub');
        }
    }

    public function delete($id)
    {
        $klub = $this->klubModel->find($id);
        if (!$klub) {
            return redirect()->to('admin/pendaftaran/klub')->with('error', 'Klub tidak ditemukan');
        }

        if ($this->klubModel->delete($id)) {
            return redirect()->to('admin/pendaftaran/klub')->with('success', 'Data klub berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data klub');
        }
    }
}
