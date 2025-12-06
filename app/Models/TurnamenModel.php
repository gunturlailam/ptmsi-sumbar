<?php

namespace App\Models;

use CodeIgniter\Model;

class TurnamenModel extends Model
{
    protected $table = 'turnamen';
    protected $primaryKey = 'id_turnamen';
    protected $allowedFields = [
        'nama',
        'tingkat',
        'tahun_musim'
    ];
    protected $useTimestamps = false;
}
