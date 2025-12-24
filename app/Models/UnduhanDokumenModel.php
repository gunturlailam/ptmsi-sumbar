<?php

namespace App\Models;

use CodeIgniter\Model;

class UnduhanDokumenModel extends Model
{
    protected $table            = 'unduhan_dokumen';
    protected $primaryKey       = 'id_unduhan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_dokumen', 'id_user', 'diunduh_pada'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'diunduh_pada';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get popular dokumen berdasarkan jumlah unduhan
     */
    public function getPopularDokumen($limit = 5)
    {
        return $this->select('dokumen.*, COUNT(unduhan_dokumen.id_unduhan) as jumlah_unduhan')
            ->join('dokumen', 'dokumen.id_dokumen = unduhan_dokumen.id_dokumen', 'left')
            ->groupBy('unduhan_dokumen.id_dokumen')
            ->orderBy('jumlah_unduhan', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Record download dokumen
     */
    public function recordDownload($idDokumen, $idUser = null)
    {
        return $this->insert([
            'id_dokumen' => $idDokumen,
            'id_user' => $idUser,
            'diunduh_pada' => date('Y-m-d H:i:s')
        ]);
    }
}
