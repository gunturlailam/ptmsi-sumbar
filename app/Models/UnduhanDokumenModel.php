<?php

namespace App\Models;

use CodeIgniter\Model;

class UnduhanDokumenModel extends Model
{
    protected $table = 'unduhan_dokumen';
    protected $primaryKey = 'id_unduhan';
    protected $allowedFields = [
        'id_dokumen',
        'id_user',
        'diunduh_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Record download
     */
    public function recordDownload($idDokumen, $idUser = null)
    {
        return $this->insert([
            'id_dokumen' => $idDokumen,
            'id_user' => $idUser,
            'diunduh_pada' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get download count by dokumen
     */
    public function getDownloadCount($idDokumen)
    {
        return $this->where('id_dokumen', $idDokumen)->countAllResults();
    }

    /**
     * Get popular dokumen
     */
    public function getPopularDokumen($limit = 10)
    {
        return $this->select('dokumen.*, user.nama_lengkap as nama_pengunggah, COUNT(unduhan_dokumen.id_unduhan) as total_unduhan')
            ->join('dokumen', 'dokumen.id_dokumen = unduhan_dokumen.id_dokumen')
            ->join('user', 'user.id_user = dokumen.id_pengunggah', 'left')
            ->groupBy('unduhan_dokumen.id_dokumen')
            ->orderBy('total_unduhan', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
