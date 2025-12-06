<?php

namespace App\Models;

use CodeIgniter\Model;

class OfisialModel extends Model
{
    protected $table = 'ofisial';
    protected $primaryKey = 'id_ofisial';
    protected $allowedFields = ['id_user', 'nomor_lisensi', 'status'];
    protected $useTimestamps = false;

    /**
     * Ambil ofisial dengan detail user
     */
    public function getOfisialWithDetails()
    {
        return $this->select('ofisial.*, user.nama_lengkap, user.email, user.nohp')
            ->join('user', 'user.id_user = ofisial.id_user', 'left')
            ->orderBy('user.nama_lengkap', 'ASC')
            ->findAll();
    }

    /**
     * Ambil ofisial aktif
     */
    public function getOfisialAktif()
    {
        return $this->select('ofisial.*, user.nama_lengkap, user.email, user.nohp')
            ->join('user', 'user.id_user = ofisial.id_user', 'left')
            ->where('ofisial.status', 'aktif')
            ->orderBy('user.nama_lengkap', 'ASC')
            ->findAll();
    }
}
