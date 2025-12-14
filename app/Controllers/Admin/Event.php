<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\TurnamenModel;
use App\Models\KlubModel;

class Event extends BaseController
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
            ->join('klub', 'klub.id_klub = event.id_klub_penyelenggara', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('event.judul', $search)
                ->orLike('turnamen.nama', $search)
                ->orLike('event.lokasi', $search)
                ->groupEnd();
        }

        if ($status) {
            $builder->where('event.status', $status);
        }

        $events = $builder->orderBy('event.tanggal_mulai', 'DESC')->findAll();

        $data = [
            'title' => 'Manajemen Event & Kejuaraan',
            'events' => $events,
            'search' => $search,
            'status' => $status
        ];

        return view('admin/event', $data);
    }

    public function create()
    {
        $data = [
            'title'     => 'Tambah Event',
            'turnamen'  => $this->turnamenModel->findAll(),
            'klub'      => $this->klubModel->findAll(),
        ];

        return view('admin/event/create', $data);
    }

    public function store()
    {
        $rules = [
            'judul'                  => 'required|min_length[3]',
            'id_turnamen'            => 'required|integer',
            'id_klub_penyelenggara'  => 'required|integer',
            'tanggal_mulai'          => 'required|valid_date',
            'tanggal_selesai'        => 'required|valid_date',
            'lokasi'                 => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'judul'                  => $this->request->getPost('judul'),
            'id_turnamen'            => $this->request->getPost('id_turnamen'),
            'id_klub_penyelenggara'  => $this->request->getPost('id_klub_penyelenggara'),
            'tanggal_mulai'          => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai'        => $this->request->getPost('tanggal_selesai'),
            'lokasi'                 => $this->request->getPost('lokasi'),
            'batas_pendaftaran'      => $this->request->getPost('batas_pendaftaran'),
            'status'                 => $this->request->getPost('status') ?? 'draft',
        ];

        if ($this->eventModel->insert($data)) {
            return redirect()->to('admin/event')->with('success', 'Event berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan event');
        }
    }

    public function edit($id)
    {
        $event = $this->eventModel->select('event.*, turnamen.nama as nama_turnamen, klub.nama as nama_klub')
            ->join('turnamen', 'turnamen.id_turnamen = event.id_turnamen', 'left')
            ->join('klub', 'klub.id_klub = event.id_klub_penyelenggara', 'left')
            ->where('event.id_event', $id)
            ->first();

        if (!$event) {
            return redirect()->to('admin/event')->with('error', 'Event tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Event',
            'event' => $event,
            'turnamen' => $this->turnamenModel->findAll(),
            'klub' => $this->klubModel->findAll(),
        ];

        return view('admin/event/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'judul'                  => 'required|min_length[3]',
            'id_turnamen'            => 'required|integer',
            'id_klub_penyelenggara'  => 'required|integer',
            'tanggal_mulai'          => 'required|valid_date',
            'tanggal_selesai'        => 'required|valid_date',
            'lokasi'                 => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'judul'                  => $this->request->getPost('judul'),
            'id_turnamen'            => $this->request->getPost('id_turnamen'),
            'id_klub_penyelenggara'  => $this->request->getPost('id_klub_penyelenggara'),
            'tanggal_mulai'          => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai'        => $this->request->getPost('tanggal_selesai'),
            'lokasi'                 => $this->request->getPost('lokasi'),
            'batas_pendaftaran'      => $this->request->getPost('batas_pendaftaran'),
            'status'                 => $this->request->getPost('status'),
        ];

        if ($this->eventModel->update($id, $data)) {
            return redirect()->to('admin/event')->with('success', 'Event berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate event');
        }
    }

    public function delete($id)
    {
        $event = $this->eventModel->where('id_event', $id)->first();

        if (!$event) {
            return redirect()->to('admin/event')->with('error', 'Event tidak ditemukan');
        }

        if ($this->eventModel->where('id_event', $id)->delete()) {
            return redirect()->to('admin/event')->with('success', 'Event berhasil dihapus');
        } else {
            return redirect()->to('admin/event')->with('error', 'Gagal menghapus event');
        }
    }
}
