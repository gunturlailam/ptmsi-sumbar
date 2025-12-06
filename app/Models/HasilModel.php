<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'id_hasil';
    protected $allowedFields = [
        'id_pertandingan',
        'id_pemenang_atlet',
        'skor',
        'id_pelapor',
        'dicatat_pada'
    ];
    protected $useTimestamps = false;

    // Join dengan pertandingan dan atlet pemenang
    public function getHasilWithDetails()
    {
        return $this->select('hasil.*, pertandingan.babak, pertandingan.jadwal, 
                             event.judul as nama_event,
                             atlet_pemenang.id_atlet as id_pemenang,
                             user_pemenang.nama_lengkap as nama_pemenang,
                             user_pelapor.nama_lengkap as nama_pelapor')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
            ->join('event', 'event.id_event = pertandingan.id_event')
            ->join('atlet atlet_pemenang', 'atlet_pemenang.id_atlet = hasil.id_pemenang_atlet', 'left')
            ->join('user user_pemenang', 'user_pemenang.id_user = atlet_pemenang.id_user', 'left')
            ->join('user user_pelapor', 'user_pelapor.id_user = hasil.id_pelapor', 'left')
            ->findAll();
    }

    public function getRekapMedali()
    {
        return $this->select('atlet.id_klub, COUNT(hasil.id_hasil) as total_medali')
            ->join('pertandingan', 'pertandingan.id_pertandingan = hasil.id_pertandingan')
            ->join('atlet', 'atlet.id_atlet = hasil.id_pemenang_atlet')
            ->groupBy('atlet.id_klub')
            ->orderBy('total_medali', 'DESC')
            ->findAll();
    }
}
