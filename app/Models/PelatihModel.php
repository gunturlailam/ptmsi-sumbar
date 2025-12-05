<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihModel extends Model
{
    protected $table = 'pelatih';
    protected $primaryKey = 'id_pelatih';
    protected $allowedFields = [
        'id_user',
        'id_klub',
        'tingkat_sertifikasi',
        'tanggal_sertifikasi'
    ];
    protected $useTimestamps = false;
}
