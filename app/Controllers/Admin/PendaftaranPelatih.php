<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftaranPelatihModel;
use App\Models\PelatihModel;
use App\Models\UserModel;

class PendaftaranPelatih extends BaseController
{
    protected $pendaftaranPelatihModel;
    protected $pelatihModel;
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

        $this->pendaftaranPelatihModel = new PendaftaranPelatihModel();
        $this->pelatihModel = new PelatihModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $jenis = $this->request->getGet('jenis');

        $builder = $this->pendaftaranPelatihModel->select('pendaftaran_pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_pelatih.id_klub', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('pendaftaran_pelatih.nama_lengkap', $search)
                ->orLike('pendaftaran_pelatih.email', $search)
                ->orLike('klub.nama', $search)
                ->groupEnd();
        }

        if ($status) {
            $builder->where('pendaftaran_pelatih.status', $status);
        }

        if ($jenis) {
            $builder->where('pendaftaran_pelatih.jenis_pelatih', $jenis);
        }

        $pendaftaran = $builder->orderBy('pendaftaran_pelatih.tanggal_daftar', 'DESC')->findAll();

        $data = [
            'title'       => 'Pendaftaran Pelatih/Wasit',
            'pendaftaran' => $pendaftaran,
            'search'      => $search,
            'status'      => $status,
            'jenis'       => $jenis,
        ];

        return view('admin/pendaftaran/pelatih', $data);
    }

    public function pending()
    {
        $pendaftaran = $this->pendaftaranPelatihModel->getPendaftaranPending();

        $data = [
            'title'       => 'Pendaftaran Pelatih/Wasit - Menunggu Verifikasi',
            'pendaftaran' => $pendaftaran,
        ];

        return view('admin/pendaftaran/pelatih/pending', $data);
    }

    public function detail($id)
    {
        $pendaftaran = $this->pendaftaranPelatihModel->select('pendaftaran_pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_pelatih.id_klub', 'left')
            ->where('pendaftaran_pelatih.id_pendaftaran_pelatih', $id)
            ->first();

        if (!$pendaftaran) {
            return redirect()->to('admin/pendaftaran/pelatih')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title'       => 'Detail Pendaftaran Pelatih/Wasit - ' . $pendaftaran['nama_lengkap'],
            'pendaftaran' => $pendaftaran,
        ];

        return view('admin/pendaftaran/pelatih/detail', $data);
    }

    /**
     * Verifikasi pendaftaran pelatih
     */
    public function verifikasi($id)
    {
        $pendaftaran = $this->pendaftaranPelatihModel->find($id);

        if (!$pendaftaran) {
            return redirect()->to('admin/pendaftaran/pelatih')->with('error', 'Data tidak ditemukan');
        }

        $status = $this->request->getPost('status'); // 'diterima' or 'ditolak'
        $catatan = $this->request->getPost('catatan');
        $idAdmin = session()->get('user_id');

        if ($status === 'diterima') {
            // Aktivasi profil pelatih
            $result = $this->aktivasiProfilPelatih($pendaftaran, $idAdmin, $catatan);

            if ($result['success']) {
                return redirect()->to('admin/pendaftaran/pelatih')->with('success', 'Pendaftaran diterima dan profil pelatih berhasil diaktivasi');
            } else {
                return redirect()->back()->with('error', $result['message']);
            }
        } elseif ($status === 'ditolak') {
            // Tolak pendaftaran
            $this->pendaftaranPelatihModel->verifikasiPendaftaran($id, 'ditolak', $catatan, $idAdmin);

            return redirect()->to('admin/pendaftaran/pelatih')->with('success', 'Pendaftaran ditolak');
        }

        return redirect()->back()->with('error', 'Status tidak valid');
    }

    /**
     * Aktivasi profil pelatih setelah pendaftaran diterima
     */
    private function aktivasiProfilPelatih($pendaftaran, $idAdmin, $catatan)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // 1. Buat user account untuk pelatih
            $username = strtolower(str_replace(' ', '', $pendaftaran['nama_lengkap'])) . rand(100, 999);
            $password = bin2hex(random_bytes(4)); // Generate random password

            $userId = $this->generateUUID();
            $userData = [
                'id_user' => $userId,
                'username' => $username,
                'email' => $pendaftaran['email'],
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'nama_lengkap' => $pendaftaran['nama_lengkap'],
                'nohp' => $pendaftaran['no_hp'],
                'peran' => 'pelatih',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            ];

            $this->userModel->insert($userData);

            // 2. Buat profil pelatih
            $pelatihData = [
                'id_user' => $userId,
                'id_klub' => $pendaftaran['id_klub'],
                'nama_lengkap' => $pendaftaran['nama_lengkap'],
                'nik' => $pendaftaran['nik'],
                'tempat_lahir' => $pendaftaran['tempat_lahir'],
                'tanggal_lahir' => $pendaftaran['tanggal_lahir'],
                'jenis_kelamin' => $pendaftaran['jenis_kelamin'],
                'alamat' => $pendaftaran['alamat'],
                'no_hp' => $pendaftaran['no_hp'],
                'email' => $pendaftaran['email'],
                'jenis_pelatih' => $pendaftaran['jenis_pelatih'],
                'foto_path' => $pendaftaran['foto_path'],
                'sertifikat_path' => $pendaftaran['sertifikat_path'],
                'status' => 'aktif',
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ];

            $idPelatih = $this->pelatihModel->insert($pelatihData);

            if (!$idPelatih) {
                throw new \Exception('Gagal membuat profil pelatih');
            }

            // 3. Update pendaftaran
            $this->pendaftaranPelatihModel->aktivasiPelatih($pendaftaran['id_pendaftaran_pelatih'], $idPelatih);
            $this->pendaftaranPelatihModel->verifikasiPendaftaran($pendaftaran['id_pendaftaran_pelatih'], 'diterima', $catatan, $idAdmin);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return ['success' => true, 'message' => 'Profil pelatih berhasil diaktivasi'];
        } catch (\Exception $e) {
            $db->transRollback();
            return ['success' => false, 'message' => 'Gagal mengaktivasi profil pelatih: ' . $e->getMessage()];
        }
    }

    /**
     * Generate UUID v4
     */
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

    /**
     * Delete pendaftaran
     */
    public function delete($id)
    {
        if ($this->pendaftaranPelatihModel->delete($id)) {
            return redirect()->to('admin/pendaftaran/pelatih')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
