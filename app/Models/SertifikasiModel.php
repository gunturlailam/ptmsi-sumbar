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

    /**
     * Get sertifikasi with pelatih info
     */
    public function getSertifikasiWithPelatih()
    {
        return $this->select('sertifikasi.*, 
                user.nama_lengkap as nama_pelatih,
                klub.nama as nama_klub')
            ->join('pelatih', 'pelatih.id_pelatih = sertifikasi.id_pelatih')
            ->join('user', 'user.id_user = pelatih.id_user')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->orderBy('sertifikasi.tanggal_dikeluarkan', 'DESC')
            ->findAll();
    }

    /**
     * Get sertifikasi by pelatih
     */
    public function getSertifikasiByPelatih($idPelatih)
    {
        return $this->where('id_pelatih', $idPelatih)
            ->orderBy('tanggal_dikeluarkan', 'DESC')
            ->findAll();
    }
}
