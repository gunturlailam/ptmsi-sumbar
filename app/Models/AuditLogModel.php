<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table = 'audit_log';
    protected $primaryKey = 'id_audit';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_user',
        'aksi',
        'modul',
        'deskripsi',
        'data_lama',
        'data_baru',
        'ip_address',
        'user_agent',
        'status',
        'dibuat_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Log an action
     */
    public function logAksi($idUser, $aksi, $modul, $deskripsi = null, $dataLama = null, $dataBaru = null, $status = 'sukses')
    {
        return $this->insert([
            'id_user' => $idUser,
            'aksi' => $aksi,
            'modul' => $modul,
            'deskripsi' => $deskripsi,
            'data_lama' => $dataLama ? json_encode($dataLama) : null,
            'data_baru' => $dataBaru ? json_encode($dataBaru) : null,
            'ip_address' => $this->getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'status' => $status,
            'dibuat_pada' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get client IP address
     */
    private function getClientIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     * Get audit log by user
     */
    public function getByUser($idUser, $limit = 50)
    {
        return $this->where('id_user', $idUser)
            ->orderBy('dibuat_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get audit log by module
     */
    public function getByModule($modul, $limit = 50)
    {
        return $this->where('modul', $modul)
            ->orderBy('dibuat_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get audit log by date range
     */
    public function getByDateRange($startDate, $endDate, $limit = 100)
    {
        return $this->where('dibuat_pada >=', $startDate)
            ->where('dibuat_pada <=', $endDate)
            ->orderBy('dibuat_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get failed actions
     */
    public function getFailedActions($limit = 50)
    {
        return $this->where('status', 'gagal')
            ->orderBy('dibuat_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get statistics
     */
    public function getStatistics($startDate = null, $endDate = null)
    {
        $query = $this->select('aksi, COUNT(*) as total')
            ->groupBy('aksi');

        if ($startDate && $endDate) {
            $query->where('dibuat_pada >=', $startDate)
                ->where('dibuat_pada <=', $endDate);
        }

        return $query->findAll();
    }

    /**
     * Export audit log to CSV
     */
    public function exportToCSV($startDate = null, $endDate = null)
    {
        $query = $this->select('audit_log.*, user.nama_lengkap')
            ->join('user', 'user.id_user = audit_log.id_user', 'left');

        if ($startDate && $endDate) {
            $query->where('audit_log.dibuat_pada >=', $startDate)
                ->where('audit_log.dibuat_pada <=', $endDate);
        }

        return $query->orderBy('audit_log.dibuat_pada', 'DESC')->findAll();
    }
}
