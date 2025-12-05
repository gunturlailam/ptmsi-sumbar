<?php

namespace App\Models;

use CodeIgniter\Model;

class AtletModel extends Model
{
    protected $table = 'atlet';
    protected $primaryKey = 'id_atlet';
    protected $allowedFields = [
        'id_user',
        'id_klub',
        'tanggal_lahir',
        'jenis_kelamin',
        'kategori_usia',
        'ranking_provinsi',
        'status',
        'dibuat_pada'
    ];
    protected $useTimestamps = false;
}
