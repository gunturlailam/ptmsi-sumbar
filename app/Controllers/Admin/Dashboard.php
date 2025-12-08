<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtletModel;
use App\Models\PelatihModel;
use App\Models\KlubModel;
use App\Models\EventModel;
use App\Models\BeritaModel;

class Dashboard extends BaseController
{
    protected $atletModel;
    protected $pelatihModel;
    protected $klubModel;
    protected $eventModel;
    protected $beritaModel;

    public function __construct()
    {
        // Check if user is logged in and is admin
        if (!session()->get('logged_in')) {
            redirect()->to('auth/login')->send();
            exit;
        }

        if (session()->get('role') !== 'admin') {
            redirect()->to('/')->with('error', 'Akses ditolak. Anda tidak memiliki hak akses admin.')->send();
            exit;
        }

        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
        $this->klubModel = new KlubModel();
        $this->eventModel = new EventModel();
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        // Get statistics - without status filter since tables don't have status column
        $data = [
            'title' => 'Dashboard',
            'totalAtlet' => $this->atletModel->countAllResults(),
            'totalPelatih' => $this->pelatihModel->countAllResults(),
            'totalKlub' => $this->klubModel->countAllResults(),
            'totalEvent' => $this->eventModel->countAllResults(),
            'totalEventAktif' => $this->eventModel->countAllResults(), // All events for now
            'totalBerita' => $this->beritaModel->countAllResults(),
            'pendingCount' => 0, // Will be implemented later
        ];

        // Get latest data
        $data['beritaTerbaru'] = $this->beritaModel
            ->orderBy('tanggal_publikasi', 'DESC')
            ->limit(5)
            ->findAll();

        $data['eventMendatang'] = $this->eventModel
            ->where('tanggal_mulai >=', date('Y-m-d'))
            ->orderBy('tanggal_mulai', 'ASC')
            ->limit(5)
            ->findAll();

        // Pending registrations - will be implemented later
        $data['pendaftaranPending'] = [];

        return view('admin/dashboard/index', $data);
    }
}
