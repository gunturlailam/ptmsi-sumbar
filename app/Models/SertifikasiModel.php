<?php

namespace App\Models;

use CodeIgniter\Model;

class SertifikasiModel extends Model
{
    protected $table = 'sertifikasi';
    protected $primaryKey = 'id_sertifikasi';
    protected $allowedFields = [
        'id_pelatih',
        'jenis_sertifikasi',
        'tanggal_dikeluarkan',
        'tanggal_kadaluarsa',
        'file_url'
    ];
    protected $useTimestamps = false;

    // Join dengan pelatih dan user
    public function getSertifikasiWithDetails()
    {
        return $this->select('sertifikasi.*, 
                             pelatih.id_pelatih, 
                             pelatih.tingkat_sertifikasi as tingkat_pelatih,
                             user.nama_lengkap as nama_pelatih,
                             user.email,
                             klub.nama as nama_klub')
            ->join('pelatih', 'pelatih.id_pelatih = sertifikasi.id_pelatih', 'left')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->orderBy('sertifikasi.tanggal_dikeluarkan', 'DESC')
            ->findAll();
    }
}
