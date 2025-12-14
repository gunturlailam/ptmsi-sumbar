<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftaranAtletModel;
use App\Models\AtletModel;
use App\Models\UserModel;
use App\Models\KlubModel;

class PendaftaranAtlet extends BaseController
{
    protected $pendaftaranAtletModel;
    protected $atletModel;
    protected $userModel;
    protected $klubModel;

    public function __construct()
    {
        $this->pendaftaranAtletModel = new PendaftaranAtletModel();
        $this->atletModel = new AtletModel();
        $this->userModel = new UserModel();
        $this->klubModel = new KlubModel();
    }

    public function index()
    {
        // Join dengan tabel klub untuk mendapatkan nama klub
        $pendaftaran = $this->pendaftaranAtletModel
            ->select('pendaftaran_atlet.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_atlet.id_klub', 'left')
            ->orderBy('pendaftaran_atlet.tanggal_daftar', 'DESC')
            ->findAll();

        $data = [
            'title'       => 'Pendaftaran Atlet',
            'pendaftaran' => $pendaftaran,
        ];

        return view('admin/pendaftaran_atlet', $data);
    }

    public function pending()
    {
        // Join dengan tabel klub untuk mendapatkan nama klub
        $pendaftaran = $this->pendaftaranAtletModel
            ->select('pendaftaran_atlet.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_atlet.id_klub', 'left')
            ->where('pendaftaran_atlet.status', 'menunggu_verifikasi_provinsi')
            ->orderBy('pendaftaran_atlet.tanggal_daftar', 'ASC')
            ->findAll();

        $data = [
            'title'       => 'Pendaftaran Atlet Pending',
            'pendaftaran' => $pendaftaran,
        ];

        return view('admin/pendaftaran_atlet/pending', $data);
    }

    public function detail($id)
    {
        $pendaftaran = $this->pendaftaranAtletModel->find($id);

        if (!$pendaftaran) {
            return redirect()->to('/admin/pendaftaran-atlet')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title'       => 'Detail Pendaftaran Atlet',
            'pendaftaran' => $pendaftaran,
        ];

        return view('admin/pendaftaran_atlet/detail', $data);
    }

    /**
     * Verifikasi pendaftaran atlet
     */
    public function verifikasi($id)
    {
        $pendaftaran = $this->pendaftaranAtletModel->find($id);

        if (!$pendaftaran) {
            return redirect()->to('/admin/pendaftaran-atlet')->with('error', 'Data tidak ditemukan');
        }

        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');
        $idAdmin = session()->get('id_user');

        if ($status === 'diterima') {
            // Aktivasi profil atlet
            $result = $this->aktivasiProfilAtlet($pendaftaran, $idAdmin, $catatan);

            if ($result['success']) {
                return redirect()->to('/admin/pendaftaran/atlet')->with('success', $result['message']);
            } else {
                return redirect()->back()->with('error', $result['message']);
            }
        } elseif ($status === 'ditolak') {
            // Tolak pendaftaran
            $updateData = [
                'status' => 'ditolak_provinsi',
                'catatan_admin' => $catatan,
                'tanggal_verifikasi' => date('Y-m-d H:i:s'),
                'id_admin_verifikator' => $idAdmin
            ];

            $this->pendaftaranAtletModel->update($id, $updateData);

            // Send notification email (optional)
            // $this->sendRejectionEmail($pendaftaran['email'], $catatan);

            return redirect()->to('/admin/pendaftaran/atlet')->with('success', 'Pendaftaran ditolak');
        }

        return redirect()->back()->with('error', 'Status tidak valid');
    }

    /**
     * Aktivasi profil atlet setelah pendaftaran diterima
     */
    private function aktivasiProfilAtlet($pendaftaran, $idAdmin, $catatan)
    {
        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Generate password default
            $defaultPassword = 'atlet' . date('Y');

            // Generate unique user ID
            $userId = 'atlet_' . uniqid();

            // Buat user account
            $userData = [
                'id_user' => $userId,
                'nama_lengkap' => $pendaftaran['nama_lengkap'],
                'email' => $pendaftaran['email'],
                'username' => strtolower(str_replace(' ', '', $pendaftaran['nama_lengkap'])) . rand(100, 999),
                'password_hash' => password_hash($defaultPassword, PASSWORD_DEFAULT),
                'peran' => 'atlet',
                'nohp' => $pendaftaran['no_hp'],
                'dibuat_pada' => date('Y-m-d H:i:s')
            ];

            // Insert user dengan skip validation untuk menghindari masalah placeholder
            $this->userModel->skipValidation(true);
            $userInserted = $this->userModel->insert($userData);
            $this->userModel->skipValidation(false);

            if (!$userInserted) {
                throw new \Exception('Gagal membuat user account');
            }

            // Handle foto - move from pendaftaran folder to atlet folder
            $fotoPath = null;
            if ($pendaftaran['foto_path']) {
                $oldPath = FCPATH . 'uploads/pendaftaran_atlet/' . $pendaftaran['foto_path'];
                if (file_exists($oldPath)) {
                    $fileName = 'atlet_' . $userData['id_user'] . '_' . time() . '.' . pathinfo($pendaftaran['foto_path'], PATHINFO_EXTENSION);
                    $newPath = FCPATH . 'uploads/foto_atlet/' . $fileName;

                    if (!is_dir(FCPATH . 'uploads/foto_atlet/')) {
                        mkdir(FCPATH . 'uploads/foto_atlet/', 0755, true);
                    }

                    if (copy($oldPath, $newPath)) {
                        $fotoPath = 'uploads/foto_atlet/' . $fileName;
                        unlink($oldPath); // Remove old file
                    }
                }
            }

            // Buat data atlet
            $atletData = [
                'id_user' => $userId,
                'id_klub' => $pendaftaran['id_klub'],
                'tanggal_lahir' => $pendaftaran['tanggal_lahir'],
                'tempat_lahir' => $pendaftaran['tempat_lahir'],
                'jenis_kelamin' => $pendaftaran['jenis_kelamin'],
                'kategori_usia' => $pendaftaran['kategori_usia'],
                'no_hp' => $pendaftaran['no_hp'],
                'alamat' => $pendaftaran['alamat'],
                'foto' => $fotoPath,
                'status' => 'aktif',
                'tanggal_bergabung' => date('Y-m-d'),
                'dibuat_pada' => date('Y-m-d H:i:s')
            ];

            $atletId = $this->atletModel->insert($atletData);
            if (!$atletId) {
                throw new \Exception('Gagal membuat profil atlet');
            }

            // Update status pendaftaran
            $updateData = [
                'status' => 'diterima',
                'catatan_admin' => $catatan,
                'tanggal_verifikasi' => date('Y-m-d H:i:s'),
                'id_admin_verifikator' => $idAdmin,
                'id_atlet' => $atletId
            ];

            $this->pendaftaranAtletModel->update($pendaftaran['id_pendaftaran_atlet'], $updateData);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal memproses verifikasi.');
            }

            return ['success' => true, 'message' => "Pendaftaran atlet diterima! Password default: {$defaultPassword}"];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Gagal memproses verifikasi: ' . $e->getMessage()];
        }
    }

    /**
     * Delete pendaftaran
     */
    public function delete($id)
    {
        if ($this->pendaftaranAtletModel->delete($id)) {
            return redirect()->to('/admin/pendaftaran/atlet')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
