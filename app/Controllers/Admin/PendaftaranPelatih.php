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

        return view('admin/pendaftaran/pelatih/index', $data);
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
        $db->transBegin();

        try {
            log_message('info', 'Starting pelatih activation for: ' . $pendaftaran['nama_lengkap']);

            // Check if email already exists
            $existingUser = $db->table('user')->where('email', $pendaftaran['email'])->get()->getRow();

            $userId = null;

            if ($existingUser) {
                // User already exists, use existing user ID
                $userId = $existingUser->id_user;
                log_message('info', 'User already exists with ID: ' . $userId . ', updating role to pelatih');

                // Update user role to pelatih if not already
                $db->table('user')->where('id_user', $userId)->update([
                    'peran' => 'pelatih',
                    'diperbarui_pada' => date('Y-m-d H:i:s')
                ]);
            } else {
                // Create new user account
                $username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $pendaftaran['nama_lengkap'])) . rand(100, 999);
                $password = 'pelatih2025'; // Default password untuk pelatih

                $userId = $this->generateUUID();
                $userData = [
                    'id_user' => $userId,
                    'username' => $username,
                    'email' => $pendaftaran['email'],
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'nama_lengkap' => $pendaftaran['nama_lengkap'],
                    'nohp' => $pendaftaran['no_hp'] ?? null,
                    'peran' => 'pelatih',
                    'dibuat_pada' => date('Y-m-d H:i:s'),
                    'diperbarui_pada' => date('Y-m-d H:i:s')
                ];

                log_message('info', 'Inserting user data: ' . json_encode($userData));
                $userInserted = $db->table('user')->insert($userData);

                if (!$userInserted) {
                    $error = $db->error();
                    log_message('error', 'Failed to create user: ' . json_encode($error));
                    $db->transRollback();
                    return ['success' => false, 'message' => 'Gagal membuat user account: ' . ($error['message'] ?? 'Unknown error')];
                }

                log_message('info', 'User created successfully with ID: ' . $userId);
            }

            // Check if pelatih profile already exists for this user
            $existingPelatih = $db->table('pelatih')->where('id_user', $userId)->get()->getRow();

            $idPelatih = null;

            if ($existingPelatih) {
                $idPelatih = $existingPelatih->id_pelatih;
                log_message('info', 'Pelatih profile already exists with ID: ' . $idPelatih);
            } else {
                // Create pelatih profile
                $pelatihData = [
                    'id_user' => $userId,
                    'id_klub' => $pendaftaran['id_klub'] ?? null,
                    'tingkat_sertifikasi' => 'Dasar',
                    'tanggal_sertifikasi' => date('Y-m-d'),
                ];

                log_message('info', 'Inserting pelatih data: ' . json_encode($pelatihData));
                $insertResult = $db->table('pelatih')->insert($pelatihData);

                if (!$insertResult) {
                    $error = $db->error();
                    log_message('error', 'Failed to insert pelatih data: ' . json_encode($error));
                    $db->transRollback();
                    return ['success' => false, 'message' => 'Gagal membuat profil pelatih: ' . ($error['message'] ?? 'Unknown error')];
                }

                $idPelatih = $db->insertID();
                log_message('info', 'Pelatih created successfully with ID: ' . $idPelatih);
            }

            // Update pendaftaran status
            $updateResult = $db->table('pendaftaran_pelatih')
                ->where('id_pendaftaran_pelatih', $pendaftaran['id_pendaftaran_pelatih'])
                ->update([
                    'status' => 'diterima',
                    'id_pelatih' => $idPelatih,
                    'catatan_provinsi' => $catatan,
                    'diverifikasi_oleh' => $idAdmin,
                    'tanggal_verifikasi' => date('Y-m-d H:i:s')
                ]);

            if (!$updateResult) {
                $error = $db->error();
                log_message('error', 'Failed to update pendaftaran: ' . json_encode($error));
                $db->transRollback();
                return ['success' => false, 'message' => 'Gagal update status pendaftaran'];
            }

            $db->transCommit();
            log_message('info', 'Pelatih activation completed successfully');

            return ['success' => true, 'message' => 'Profil pelatih berhasil diaktivasi'];
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Activation failed: ' . $e->getMessage());
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
