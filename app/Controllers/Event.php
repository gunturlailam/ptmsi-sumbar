<?php

namespace App\Controllers;

use App\Models\TurnamenModel;
use App\Models\EventModel;
use App\Models\PendaftaranEventModel;
use App\Models\PertandinganModel;
use App\Models\HasilModel;

class Event extends BaseController
{
    protected $turnamenModel;
    protected $eventModel;
    protected $pendaftaranEventModel;
    protected $pertandinganModel;
    protected $hasilModel;

    public function __construct()
    {
        $this->turnamenModel = new TurnamenModel();
        $this->eventModel = new EventModel();
        $this->pendaftaranEventModel = new PendaftaranEventModel();
        $this->pertandinganModel = new PertandinganModel();
        $this->hasilModel = new HasilModel();
    }

    public function index()
    {
        // Ambil semua event dengan detail turnamen
        $events = $this->eventModel->getEventWithDetails();
        $turnamen = $this->turnamenModel->findAll();

        $data = [
            'title' => 'Kejuaraan & Event - PTMSI Sumbar',
            'events' => $events,
            'turnamen' => $turnamen
        ];

        return view('event', $data);
    }

    public function detail($id_event)
    {
        // Ambil detail event
        $event = $this->eventModel->select('event.*, turnamen.nama as nama_turnamen, turnamen.tingkat, turnamen.tahun_musim, klub.nama as nama_klub_penyelenggara')
            ->join('turnamen', 'turnamen.id_turnamen = event.id_turnamen')
            ->join('klub', 'klub.id_klub = event.id_klub_penyelenggara')
            ->where('event.id_event', $id_event)
            ->first();

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil pendaftaran event
        $pendaftaran = $this->pendaftaranEventModel->select('pendaftaran_event.*, 
                                                             CASE 
                                                                 WHEN pendaftaran_event.tipe_pendaftar = "klub" THEN klub.nama
                                                                 WHEN pendaftaran_event.tipe_pendaftar = "atlet" THEN user.nama_lengkap
                                                                 END as nama_pendaftar')
            ->join('klub', 'klub.id_klub = pendaftaran_event.id_klub', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('pendaftaran_event.id_event', $id_event)
            ->findAll();

        // Ambil pertandingan dengan nama atlet
        $pertandingan = $this->pertandinganModel->select('pertandingan.*, 
                                                          event.judul as nama_event,
                                                          user1.nama_lengkap as nama_atlet1,
                                                          user2.nama_lengkap as nama_atlet2')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user user2', 'user2.id_user = atlet2.id_user', 'left')
            ->where('pertandingan.id_event', $id_event)
            ->findAll();

        $data = [
            'title' => 'Detail Event - ' . $event['judul'],
            'event' => $event,
            'pendaftaran' => $pendaftaran,
            'pertandingan' => $pertandingan
        ];

        return view('event/detail', $data);
    }

    public function turnamen()
    {
        $turnamen = $this->turnamenModel->findAll();

        $data = [
            'title' => 'Daftar Turnamen - PTMSI Sumbar',
            'turnamen' => $turnamen
        ];

        return view('event/turnamen', $data);
    }

    public function pertandingan($id_event = null)
    {
        $builder = $this->pertandinganModel->select('pertandingan.*, 
                                                     event.judul as nama_event,
                                                     event.tanggal_mulai,
                                                     event.tanggal_selesai,
                                                     user1.nama_lengkap as nama_atlet1,
                                                     user2.nama_lengkap as nama_atlet2')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user user2', 'user2.id_user = atlet2.id_user', 'left');

        if ($id_event) {
            $builder->where('pertandingan.id_event', $id_event);
        }

        $pertandingan = $builder->findAll();

        // Ambil hasil pertandingan jika ada
        foreach ($pertandingan as &$p) {
            $hasil = $this->hasilModel->where('id_pertandingan', $p['id_pertandingan'])->first();
            $p['hasil'] = $hasil;
        }

        $data = [
            'title' => 'Jadwal Pertandingan - PTMSI Sumbar',
            'pertandingan' => $pertandingan
        ];

        return view('event/pertandingan', $data);
    }

    public function hasil($id_pertandingan = null)
    {
        $builder = $this->hasilModel->getHasilWithDetails();

        if ($id_pertandingan) {
            $hasil = $this->hasilModel->select('hasil.*, pertandingan.babak, pertandingan.jadwal, 
                                                event.judul as nama_event,
                                                atlet_pemenang.id_atlet as id_pemenang,
                                                user_pemenang.nama_lengkap as nama_pemenang,
                                                user_pelapor.nama_lengkap as nama_pelapor')
                ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
                ->join('event', 'event.id_event = pertandingan.id_event')
                ->join('atlet atlet_pemenang', 'atlet_pemenang.id_atlet = hasil.id_pemenang_atlet', 'left')
                ->join('user user_pemenang', 'user_pemenang.id_user = atlet_pemenang.id_user', 'left')
                ->join('user user_pelapor', 'user_pelapor.id_user = hasil.id_pelapor', 'left')
                ->where('hasil.id_pertandingan', $id_pertandingan)
                ->first();
        } else {
            $hasil = $builder;
        }

        $data = [
            'title' => 'Hasil Pertandingan - PTMSI Sumbar',
            'hasil' => $hasil
        ];

        return view('event/hasil', $data);
    }
}
