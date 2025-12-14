<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftaranEventModel;
use App\Models\EventModel;
use App\Models\BracketTurnamenModel;

class PendaftaranTurnamen extends BaseController
{
    protected $pendaftaranEventModel;
    protected $eventModel;
    protected $bracketModel;

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

        $this->pendaftaranEventModel = new PendaftaranEventModel();
        $this->eventModel = new EventModel();
        $this->bracketModel = new BracketTurnamenModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Pendaftaran Event/Turnamen',
            'events' => $this->eventModel->findAll(),
        ];

        return view('admin/pendaftaran/event', $data);
    }

    public function byEvent($idEvent)
    {
        $event = $this->eventModel->find($idEvent);

        if (!$event) {
            return redirect()->to('/admin/pendaftaran-turnamen')->with('error', 'Event tidak ditemukan');
        }

        $data = [
            'title'       => 'Pendaftaran Turnamen - ' . $event['judul'],
            'event'       => $event,
            'pendaftaran' => $this->pendaftaranEventModel->getPendaftaranByEvent($idEvent),
            'statistik'   => $this->pendaftaranEventModel->getStatistikPendaftaran($idEvent),
        ];

        return view('admin/pendaftaran_turnamen/by_event', $data);
    }

    public function menungguKonfirmasi()
    {
        $data = [
            'title'       => 'Menunggu Konfirmasi Pembayaran',
            'pendaftaran' => $this->pendaftaranEventModel->getPendaftaranMenungguKonfirmasi(),
        ];

        return view('admin/pendaftaran_turnamen/menunggu_konfirmasi', $data);
    }

    public function menungguVerifikasi()
    {
        $data = [
            'title'       => 'Menunggu Verifikasi',
            'pendaftaran' => $this->pendaftaranEventModel->getPendaftaranMenungguVerifikasi(),
        ];

        return view('admin/pendaftaran_turnamen/menunggu_verifikasi', $data);
    }

    /**
     * Konfirmasi pembayaran
     */
    public function konfirmasiPembayaran($id)
    {
        $status = $this->request->getPost('status');
        $idAdmin = session()->get('id_user');

        if ($this->pendaftaranEventModel->konfirmasiPembayaran($id, $status, $idAdmin)) {
            return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
        } else {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi pembayaran');
        }
    }

    /**
     * Verifikasi pendaftaran
     */
    public function verifikasi($id)
    {
        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');
        $idAdmin = session()->get('id_user');

        // Generate nomor peserta jika diverifikasi
        $nomorPeserta = null;
        if ($status === 'diverifikasi') {
            $pendaftaran = $this->pendaftaranEventModel->find($id);
            $nomorPeserta = $this->generateNomorPeserta($pendaftaran['id_event'], $pendaftaran['kategori']);
        }

        if ($this->pendaftaranEventModel->verifikasiPendaftaran($id, $status, $catatan, $idAdmin, $nomorPeserta)) {
            return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi');
        } else {
            return redirect()->back()->with('error', 'Gagal memverifikasi pendaftaran');
        }
    }

    /**
     * Generate nomor peserta
     */
    private function generateNomorPeserta($idEvent, $kategori)
    {
        $count = $this->pendaftaranEventModel
            ->where(['id_event' => $idEvent, 'kategori' => $kategori, 'status_verifikasi' => 'diverifikasi'])
            ->countAllResults();

        $prefix = strtoupper(substr($kategori, 0, 2));
        return $prefix . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate bracket untuk event
     */
    public function generateBracket($idEvent)
    {
        $event = $this->eventModel->find($idEvent);

        if (!$event) {
            return redirect()->to('/admin/pendaftaran-turnamen')->with('error', 'Event tidak ditemukan');
        }

        // Get all categories
        $kategoris = $this->pendaftaranEventModel
            ->select('kategori')
            ->where('id_event', $idEvent)
            ->where('status_verifikasi', 'diverifikasi')
            ->groupBy('kategori')
            ->findAll();

        $generated = 0;
        foreach ($kategoris as $kat) {
            $peserta = $this->pendaftaranEventModel->getPesertaTerverifikasi($idEvent, $kat['kategori']);

            if (count($peserta) >= 2) {
                $this->bracketModel->generateBracket($idEvent, $kat['kategori'], $peserta);
                $generated++;
            }
        }

        if ($generated > 0) {
            return redirect()->to('/admin/pendaftaran-turnamen/event/' . $idEvent)
                ->with('success', "Berhasil generate {$generated} bracket");
        } else {
            return redirect()->back()->with('error', 'Tidak ada kategori dengan peserta yang cukup');
        }
    }

    /**
     * View bracket
     */
    public function viewBracket($idEvent)
    {
        $event = $this->eventModel->find($idEvent);

        if (!$event) {
            return redirect()->to('/admin/pendaftaran-turnamen')->with('error', 'Event tidak ditemukan');
        }

        $data = [
            'title'    => 'Bracket Turnamen - ' . $event['judul'],
            'event'    => $event,
            'brackets' => $this->bracketModel->getBracketsByEvent($idEvent),
        ];

        return view('admin/pendaftaran_turnamen/bracket', $data);
    }

    /**
     * Aktivasi bracket
     */
    public function aktivasiBracket($id)
    {
        if ($this->bracketModel->aktivasiBracket($id)) {
            return redirect()->back()->with('success', 'Bracket berhasil diaktivasi');
        } else {
            return redirect()->back()->with('error', 'Gagal mengaktivasi bracket');
        }
    }
}
