<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AtletModel;
use App\Models\PelatihModel;
use App\Models\OfisialModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $atletModel;
    protected $pelatihModel;
    protected $ofisialModel;

    public function __construct()
    {
        if (!session()->get('logged_in')) {
            redirect()->to('auth/login')->send();
            exit;
        }

        $this->userModel = new UserModel();
        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
        $this->ofisialModel = new OfisialModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $userRole = session()->get('role');

        // Redirect ke dashboard khusus berdasarkan role
        switch ($userRole) {
            case 'atlet':
                return redirect()->to('user/atlet/dashboard');
            case 'admin_klub':
            case 'klub':
                return redirect()->to('user/klub/dashboard');
            case 'admin':
                return redirect()->to('admin/dashboard');
            default:
                // Dashboard umum untuk role lainnya (pelatih, ofisial, dll)
                $user = $this->userModel->find($userId);

                $data = [
                    'title' => 'Dashboard Saya',
                    'user' => $user,
                    'role' => $userRole
                ];

                // Add role-specific data
                switch ($userRole) {
                    case 'pelatih':
                        $data['pelatih_data'] = $this->getPelatihData($userId);
                        break;
                    case 'ofisial':
                        $data['ofisial_data'] = $this->getOfisialData($userId);
                        break;
                }

                return view('user/dashboard', $data);
        }
    }

    private function getAtletData($userId)
    {
        // Get athlete-specific data
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        return [
            'profile' => $atlet,
            'competitions' => [], // Add competition data later
            'achievements' => [], // Add achievement data later
            'ranking' => null // Add ranking data later
        ];
    }

    private function getPelatihData($userId)
    {
        // Get coach-specific data
        $pelatih = $this->pelatihModel->where('id_user', $userId)->first();

        return [
            'profile' => $pelatih,
            'athletes' => [], // Add athletes under this coach
            'certifications' => [], // Add certification data
            'schedule' => [] // Add training schedule
        ];
    }

    private function getOfisialData($userId)
    {
        // Get official-specific data
        $ofisial = $this->ofisialModel->where('id_user', $userId)->first();

        return [
            'profile' => $ofisial,
            'events' => [], // Add events they're officiating
            'licenses' => [], // Add license data
            'assignments' => [] // Add assignment data
        ];
    }

    public function profile()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'title' => 'Profil Saya',
            'user' => $user
        ];

        return view('user/profile', $data);
    }

    public function updateProfile()
    {
        $userId = session()->get('user_id');

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|is_unique[user.email,id_user,{$userId}]",
            'nohp' => 'required|min_length[10]|max_length[15]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'nohp' => $this->request->getPost('nohp'),
            'diperbarui_pada' => date('Y-m-d H:i:s')
        ];

        if ($this->userModel->update($userId, $data)) {
            // Update session data
            session()->set([
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email']
            ]);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui profil');
    }

    public function logAktifitas()
    {
        $userId = session()->get('user_id');
        $logModel = new \App\Models\LogAktifitasModel();

        // Get filter parameters
        $jenis_entitas = $this->request->getGet('jenis_entitas');
        $aksi = $this->request->getGet('aksi');
        $tanggal = $this->request->getGet('tanggal');

        // Build query
        $query = $logModel->where('id_user', $userId);

        if ($jenis_entitas) {
            $query = $query->where('jenis_entitas', $jenis_entitas);
        }

        if ($aksi) {
            $query = $query->where('aksi', $aksi);
        }

        if ($tanggal) {
            $query = $query->where('DATE(dibuat_pada)', $tanggal);
        }

        // Get paginated results
        $log_aktifitas = $query->orderBy('dibuat_pada', 'DESC')
            ->paginate(20);

        $data = [
            'title' => 'Log Aktivitas',
            'log_aktifitas' => $log_aktifitas,
            'pager' => $logModel->pager,
            'jenis_entitas' => $jenis_entitas,
            'aksi' => $aksi,
            'tanggal' => $tanggal
        ];

        return view('user/log_aktifitas', $data);
    }

    public function riwayatUnduhan()
    {
        $userId = session()->get('user_id');
        $unduhanModel = new \App\Models\UnduhanDokumenModel();

        // Get filter parameters
        $kategori = $this->request->getGet('kategori');
        $tanggal = $this->request->getGet('tanggal');

        // Build query
        $query = $unduhanModel->select('unduhan_dokumen.*, dokumen.judul as judul_dokumen, dokumen.kategori')
            ->join('dokumen', 'dokumen.id_dokumen = unduhan_dokumen.id_dokumen', 'left')
            ->where('unduhan_dokumen.id_user', $userId);

        if ($kategori) {
            $query = $query->where('dokumen.kategori', $kategori);
        }

        if ($tanggal) {
            $query = $query->where('DATE(unduhan_dokumen.diunduh_pada)', $tanggal);
        }

        // Get paginated results
        $riwayat_unduhan = $query->orderBy('unduhan_dokumen.diunduh_pada', 'DESC')
            ->paginate(20);

        $data = [
            'title' => 'Riwayat Unduhan',
            'riwayat_unduhan' => $riwayat_unduhan,
            'pager' => $unduhanModel->pager,
            'kategori' => $kategori,
            'tanggal' => $tanggal
        ];

        return view('user/riwayat_unduhan', $data);
    }
}
