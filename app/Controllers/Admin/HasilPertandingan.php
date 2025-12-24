<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PertandinganModel;
use App\Models\RankingModel;
use App\Models\HasilModel;
use App\Models\AtletModel;

class HasilPertandingan extends BaseController
{
    protected $pertandinganModel;
    protected $rankingModel;
    protected $hasilModel;
    protected $atletModel;

    public function __construct()
    {
        $this->pertandinganModel = new PertandinganModel();
        $this->rankingModel = new RankingModel();
        $this->hasilModel = new HasilModel();
        $this->atletModel = new AtletModel();
    }

    /**
     * Lihat daftar pertandingan hari ini
     */
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $today = date('Y-m-d');
        $matches = $this->pertandinganModel->getPertandinganByDate($today);

        $data = [
            'title' => 'Input Hasil Pertandingan',
            'matches' => $matches,
            'today' => $today
        ];

        return view('admin/hasil_pertandingan', $data);
    }

    /**
     * Form input hasil pertandingan
     */
    public function input($idPertandingan)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $match = $this->pertandinganModel->find($idPertandingan);
        if (!$match) {
            return redirect()->back()->with('error', 'Pertandingan tidak ditemukan.');
        }

        // Get athlete details
        $atlet1 = $this->atletModel->select('atlet.*, user.nama_lengkap')
            ->join('user', 'user.id_user = atlet.id_user')
            ->find($match['id_atlet1']);

        $atlet2 = $this->atletModel->select('atlet.*, user.nama_lengkap')
            ->join('user', 'user.id_user = atlet.id_user')
            ->find($match['id_atlet2']);

        $data = [
            'title' => 'Input Hasil Pertandingan',
            'match' => $match,
            'atlet1' => $atlet1,
            'atlet2' => $atlet2
        ];

        return view('admin/input_hasil', $data);
    }

    /**
     * Simpan hasil pertandingan
     */
    public function simpan($idPertandingan)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $match = $this->pertandinganModel->find($idPertandingan);
        if (!$match) {
            return redirect()->back()->with('error', 'Pertandingan tidak ditemukan.');
        }

        $rules = [
            'pemenang' => 'required|in_list[1,2]',
            'skor_atlet1' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[3]',
            'skor_atlet2' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $pemenang = $this->request->getPost('pemenang');
            $skorAtlet1 = $this->request->getPost('skor_atlet1');
            $skorAtlet2 = $this->request->getPost('skor_atlet2');

            // Tentukan ID pemenang
            $idPemenang = $pemenang == 1 ? $match['id_atlet1'] : $match['id_atlet2'];

            // Simpan hasil
            $this->hasilModel->insert([
                'id_pertandingan' => $idPertandingan,
                'id_pemenang_atlet' => $idPemenang,
                'skor' => $skorAtlet1 . '-' . $skorAtlet2,
                'id_pelapor' => session()->get('user_id'),
                'dicatat_pada' => date('Y-m-d H:i:s')
            ]);

            // Update ranking otomatis
            $this->updateRankingOtomatis($match['id_atlet1'], $match['id_atlet2'], $idPemenang);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan hasil pertandingan.');
            }

            return redirect()->to('admin/hasil-pertandingan')
                ->with('success', 'Hasil pertandingan berhasil disimpan dan ranking diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Update ranking otomatis berdasarkan hasil
     */
    private function updateRankingOtomatis($idAtlet1, $idAtlet2, $idPemenang)
    {
        $atlet1 = $this->atletModel->find($idAtlet1);
        $atlet2 = $this->atletModel->find($idAtlet2);

        // Poin untuk menang dan kalah
        $poinMenang = 10;
        $poinKalah = 3;

        // Update ranking atlet 1
        $rankingAtlet1 = $this->rankingModel->where('id_atlet', $idAtlet1)
            ->orderBy('tanggal_berlaku', 'DESC')
            ->first();

        $poinAtlet1 = ($rankingAtlet1['poin'] ?? 0) + ($idPemenang == $idAtlet1 ? $poinMenang : $poinKalah);

        $this->rankingModel->insert([
            'id_atlet' => $idAtlet1,
            'kategori_usia' => $atlet1['kategori_usia'] ?? 'Senior',
            'posisi' => 0,
            'poin' => $poinAtlet1,
            'tanggal_berlaku' => date('Y-m-d')
        ]);

        // Update ranking atlet 2
        $rankingAtlet2 = $this->rankingModel->where('id_atlet', $idAtlet2)
            ->orderBy('tanggal_berlaku', 'DESC')
            ->first();

        $poinAtlet2 = ($rankingAtlet2['poin'] ?? 0) + ($idPemenang == $idAtlet2 ? $poinMenang : $poinKalah);

        $this->rankingModel->insert([
            'id_atlet' => $idAtlet2,
            'kategori_usia' => $atlet2['kategori_usia'] ?? 'Senior',
            'posisi' => 0,
            'poin' => $poinAtlet2,
            'tanggal_berlaku' => date('Y-m-d')
        ]);

        // Recalculate positions
        $this->recalculatePositions();
    }

    /**
     * Recalculate ranking positions
     */
    private function recalculatePositions()
    {
        $db = \Config\Database::connect();

        // Get latest ranking for each athlete grouped by kategori_usia
        $rankings = $db->query("
            SELECT r.id_ranking, r.id_atlet, r.poin, r.kategori_usia
            FROM ranking r
            WHERE r.tanggal_berlaku = CURDATE()
            ORDER BY r.kategori_usia ASC, r.poin DESC
        ")->getResultArray();

        $posisi = 1;
        $kategoriSebelumnya = null;

        foreach ($rankings as $ranking) {
            // Reset posisi jika kategori berubah
            if ($kategoriSebelumnya !== $ranking['kategori_usia']) {
                $posisi = 1;
                $kategoriSebelumnya = $ranking['kategori_usia'];
            }

            $db->table('ranking')
                ->where('id_ranking', $ranking['id_ranking'])
                ->update(['posisi' => $posisi]);
            $posisi++;
        }
    }

    /**
     * Lihat semua hasil pertandingan
     */
    public function lihatSemua()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $hasil = $this->hasilModel->getHasilWithDetails();

        $data = [
            'title' => 'Daftar Hasil Pertandingan',
            'hasil' => $hasil
        ];

        return view('admin/lihat_hasil', $data);
    }
}
