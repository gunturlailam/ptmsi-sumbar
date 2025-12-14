<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\TurnamenModel;
use App\Models\KlubModel;

class Pertandingan extends BaseController
{
    protected $eventModel;
    protected $turnamenModel;
    protected $klubModel;

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

        $this->eventModel = new EventModel();
        $this->turnamenModel = new TurnamenModel();
        $this->klubModel = new KlubModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        $builder = $this->eventModel->select('event.*, turnamen.nama as nama_turnamen, turnamen.tingkat, klub.nama as nama_klub')
            ->join('turnamen', 'turnamen.id_turnamen = event.id_turnamen', 'left')
            ->join('klub', 'klub.id_klub = event.id_klub_penyelenggara', 'left')
            ->where('event.status', 'aktif'); // Only show active events for matches

        if ($search) {
            $builder->groupStart()
                ->like('event.judul', $search)
                ->orLike('turnamen.nama', $search)
                ->orLike('event.lokasi', $search)
                ->groupEnd();
        }

        $events = $builder->orderBy('event.tanggal_mulai', 'ASC')->findAll();

        $data = [
            'title' => 'Manajemen Pertandingan',
            'events' => $events,
            'search' => $search,
        ];

        return view('admin/pertandingan', $data);
    }

    public function detail($id)
    {
        $event = $this->eventModel->select('event.*, turnamen.nama as nama_turnamen, turnamen.tingkat, klub.nama as nama_klub')
            ->join('turnamen', 'turnamen.id_turnamen = event.id_turnamen', 'left')
            ->join('klub', 'klub.id_klub = event.id_klub_penyelenggara', 'left')
            ->where('event.id_event', $id)
            ->first();

        if (!$event) {
            return redirect()->to('admin/pertandingan')->with('error', 'Event tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Pertandingan - ' . $event['judul'],
            'event' => $event,
        ];

        return view('admin/pertandingan/detail', $data);
    }
}
