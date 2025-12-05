<?php

namespace App\Models;

use CodeIgniter\Model;

class AtletPelatihModel extends Model
{
    protected $table = 'atlet_pelatih';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jenis', 'klub', 'foto'];
    protected $useTimestamps = true;
}
