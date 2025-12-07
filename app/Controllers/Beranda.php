<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\TurnamenModel;
use App\Models\AtletModel;
use App\Models\PelatihModel;
use CodeIgniter\Database\BaseBuilder;

class Beranda extends BaseController
{
    protected $db;
    protected $eventModel;
    protected $turnamenModel;
    protected $atletModel;
    protected $pelatihModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->eventModel = new EventModel();
        $this->turnamenModel = new TurnamenModel();
        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
    }

    public function index()
    {
        // Ambil data untuk ditampilkan di beranda
        $data = [
            'title' => 'PTMSI Sumbar - Beranda',
            'events' => $this->eventModel->getEventWithDetails() ?: [],
            'turnamen' => $this->turnamenModel->findAll() ?: [],
            'atlet' => $this->atletModel->findAll() ?: [],
            'pelatih' => $this->pelatihModel->findAll() ?: [],
            'ranking' => $this->getRanking(),
            'berita' => $this->getBerita(),
            'galeri' => $this->getGaleri(),
            'dokumen' => $this->getDokumen(),
            'klub' => $this->getKlub(),
            'organisasi' => $this->getOrganisasi(),
            'ofisial' => $this->getOfisial(),
            'sertifikasi' => $this->getSertifikasi(),
            'pertandinganTerdekat' => $this->getPertandinganTerdekat(),
            'pengumuman' => $this->getPengumuman(),
            'kegiatanTerbaru' => $this->getKegiatanTerbaru(),
        ];

        return view('beranda', $data);
    }

    private function getRanking()
    {
        try {
            return $this->db->table('ranking')
                ->select('ranking.*, atlet.id_atlet, user.nama_lengkap, klub.nama as nama_klub')
                ->join('atlet', 'atlet.id_atlet = ranking.id_atlet', 'left')
                ->join('user', 'user.id_user = atlet.id_user', 'left')
                ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
                ->orderBy('ranking.poin', 'DESC')
                ->limit(10)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getBerita()
    {
        try {
            return $this->db->table('berita')
                ->select('berita.*, user.nama_lengkap as nama_penulis')
                ->join('user', 'user.id_user = berita.id_penulis', 'left')
                ->where('berita.status', 'published')
                ->orderBy('berita.tanggal_publikasi', 'DESC')
                ->limit(3)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getGaleri()
    {
        try {
            return $this->db->table('galeri')
                ->orderBy('diunggah_pada', 'DESC')
                ->limit(8)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getDokumen()
    {
        try {
            return $this->db->table('dokumen')
                ->orderBy('diunggah_pada', 'DESC')
                ->limit(5)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getKlub()
    {
        try {
            return $this->db->table('klub')
                ->select('klub.*, organisasi.nama_organisasi')
                ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
                ->limit(10)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getOrganisasi()
    {
        try {
            return $this->db->table('organisasi')
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getOfisial()
    {
        try {
            return $this->db->table('ofisial')
                ->select('ofisial.*, user.nama_lengkap')
                ->join('user', 'user.id_user = ofisial.id_user', 'left')
                ->limit(10)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getSertifikasi()
    {
        try {
            return $this->db->table('sertifikasi')
                ->select('sertifikasi.*, pelatih.id_pelatih, user.nama_lengkap')
                ->join('pelatih', 'pelatih.id_pelatih = sertifikasi.id_pelatih', 'left')
                ->join('user', 'user.id_user = pelatih.id_user', 'left')
                ->limit(10)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getPertandinganTerdekat()
    {
        try {
            return $this->db->table('pertandingan')
                ->select('pertandingan.*, event.judul as nama_event, event.tanggal_mulai, event.tanggal_selesai,
                         user1.nama_lengkap as nama_atlet1, user2.nama_lengkap as nama_atlet2')
                ->join('event', 'event.id_event = pertandingan.id_event', 'left')
                ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
                ->join('user user1', 'user1.id_user = atlet1.id_user', 'left')
                ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
                ->join('user user2', 'user2.id_user = atlet2.id_user', 'left')
                ->where('pertandingan.jadwal >=', date('Y-m-d H:i:s'))
                ->orderBy('pertandingan.jadwal', 'ASC')
                ->limit(5)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getPengumuman()
    {
        try {
            // Ambil dari berita dengan kategori pengumuman atau berita terbaru
            return $this->db->table('berita')
                ->select('berita.*, user.nama_lengkap as nama_penulis')
                ->join('user', 'user.id_user = berita.id_penulis', 'left')
                ->where('berita.status', 'published')
                ->orderBy('berita.tanggal_publikasi', 'DESC')
                ->limit(5)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getKegiatanTerbaru()
    {
        try {
            // Ambil dari galeri kegiatan terbaru
            return $this->db->table('galeri')
                ->select('galeri.*, event.judul as nama_event')
                ->join('event', 'event.id_event = galeri.id_event', 'left')
                ->orderBy('galeri.diunggah_pada', 'DESC')
                ->limit(6)
                ->get()
                ->getResultArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}
