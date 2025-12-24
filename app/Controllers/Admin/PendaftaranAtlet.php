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

        return view('admin/pendaftaran/atlet/index', $data);
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

        return view('admin/pendaftaran/atlet/pending', $data);
    }

    public function detail($id)
    {
        $pendaftaran = $this->pendaftaranAtletModel->find($id);

        if (!$pendaftaran) {
            return redirect()->to('/admin/pendaftaran/atlet')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title'       => 'Detail Pendaftaran Atlet',
            'pendaftaran' => $pendaftaran,
        ];

        return view('admin/pendaftaran/atlet/detail', $data);
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
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Generate password default
            $defaultPassword = 'atlet' . date('Y');

            // Check if email already exists
            $existingUser = $db->table('user')->where('email', $pendaftaran['email'])->get()->getRow();

            $userId = null;

            if ($existingUser) {
                // User already exists, use existing user ID
                $userId = $existingUser->id_user;
                log_message('info', 'User already exists with ID: ' . $userId . ', updating role to atlet');

                // Update user role to atlet if not already
                $db->table('user')->where('id_user', $userId)->update([
                    'peran' => 'atlet',
                    'diperbarui_pada' => date('Y-m-d H:i:s')
                ]);
            } else {
                // Generate unique user ID
                $userId = 'atlet_' . uniqid();

                // Buat user account
                $userData = [
                    'id_user' => $userId,
                    'nama_lengkap' => $pendaftaran['nama_lengkap'],
                    'email' => $pendaftaran['email'],
                    'username' => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $pendaftaran['nama_lengkap'])) . rand(100, 999),
                    'password_hash' => password_hash($defaultPassword, PASSWORD_DEFAULT),
                    'peran' => 'atlet',
                    'nohp' => $pendaftaran['no_hp'] ?? null,
                    'dibuat_pada' => date('Y-m-d H:i:s'),
                    'diperbarui_pada' => date('Y-m-d H:i:s')
                ];

                // Insert user langsung dengan query builder
                $userInserted = $db->table('user')->insert($userData);

                if (!$userInserted) {
                    $error = $db->error();
                    log_message('error', 'Failed to create user: ' . json_encode($error));
                    $db->transRollback();
                    return ['success' => false, 'message' => 'Gagal membuat user account: ' . ($error['message'] ?? 'Unknown error')];
                }

                log_message('info', 'User created successfully with ID: ' . $userId);
            }

            // Check if atlet profile already exists for this user
            $existingAtlet = $db->table('atlet')->where('id_user', $userId)->get()->getRow();

            $atletId = null;

            if ($existingAtlet) {
                $atletId = $existingAtlet->id_atlet;
                log_message('info', 'Atlet profile already exists with ID: ' . $atletId);
            } else {
                // Handle foto - move from pendaftaran folder to atlet folder
                $fotoPath = null;
                if (!empty($pendaftaran['foto_path'])) {
                    $oldPath = FCPATH . 'uploads/pendaftaran_atlet/' . $pendaftaran['foto_path'];
                    if (file_exists($oldPath)) {
                        $fileName = 'atlet_' . $userId . '_' . time() . '.' . pathinfo($pendaftaran['foto_path'], PATHINFO_EXTENSION);
                        $newPath = FCPATH . 'uploads/foto_atlet/' . $fileName;

                        if (!is_dir(FCPATH . 'uploads/foto_atlet/')) {
                            mkdir(FCPATH . 'uploads/foto_atlet/', 0755, true);
                        }

                        if (copy($oldPath, $newPath)) {
                            $fotoPath = 'uploads/foto_atlet/' . $fileName;
                            @unlink($oldPath); // Remove old file
                        }
                    }
                }

                // Buat data atlet
                $atletData = [
                    'id_user' => $userId,
                    'id_klub' => $pendaftaran['id_klub'] ?? null,
                    'tanggal_lahir' => $pendaftaran['tanggal_lahir'] ?? null,
                    'tempat_lahir' => $pendaftaran['tempat_lahir'] ?? null,
                    'jenis_kelamin' => $pendaftaran['jenis_kelamin'] ?? null,
                    'kategori_usia' => $pendaftaran['kategori_usia'] ?? null,
                    'no_hp' => $pendaftaran['no_hp'] ?? null,
                    'alamat' => $pendaftaran['alamat'] ?? null,
                    'foto' => $fotoPath,
                    'status' => 'aktif',
                    'tanggal_bergabung' => date('Y-m-d'),
                    'dibuat_pada' => date('Y-m-d H:i:s')
                ];

                $insertResult = $db->table('atlet')->insert($atletData);
                if (!$insertResult) {
                    $error = $db->error();
                    log_message('error', 'Failed to create atlet: ' . json_encode($error));
                    $db->transRollback();
                    return ['success' => false, 'message' => 'Gagal membuat profil atlet: ' . ($error['message'] ?? 'Unknown error')];
                }

                $atletId = $db->insertID();
                log_message('info', 'Atlet created successfully with ID: ' . $atletId);
            }

            // Update status pendaftaran
            $updateResult = $db->table('pendaftaran_atlet')
                ->where('id_pendaftaran_atlet', $pendaftaran['id_pendaftaran_atlet'])
                ->update([
                    'status' => 'diterima',
                    'catatan_admin' => $catatan,
                    'tanggal_verifikasi' => date('Y-m-d H:i:s'),
                    'id_admin_verifikator' => $idAdmin,
                    'id_atlet' => $atletId
                ]);

            if (!$updateResult) {
                $error = $db->error();
                log_message('error', 'Failed to update pendaftaran: ' . json_encode($error));
                $db->transRollback();
                return ['success' => false, 'message' => 'Gagal update status pendaftaran'];
            }

            $db->transCommit();
            log_message('info', 'Atlet activation completed successfully');

            return ['success' => true, 'message' => "Pendaftaran atlet diterima! Password default: {$defaultPassword}"];
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Atlet activation failed: ' . $e->getMessage());
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
