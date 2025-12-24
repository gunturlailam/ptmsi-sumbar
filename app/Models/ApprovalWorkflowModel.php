<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalWorkflowModel extends Model
{
    protected $table = 'approval_workflow';
    protected $primaryKey = 'id_approval';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'tipe_permohonan',
        'id_referensi',
        'status',
        'prioritas',
        'pemohon_id',
        'penyetuju_id',
        'catatan_pemohon',
        'catatan_penyetuju',
        'tanggal_permohonan',
        'tanggal_persetujuan',
        'deadline'
    ];
    protected $useTimestamps = false;

    /**
     * Create approval request
     */
    public function createRequest($tipePermohonan, $idReferensi, $pemohonId, $prioritas = 'normal', $catatanPemohon = null, $deadline = null)
    {
        return $this->insert([
            'tipe_permohonan' => $tipePermohonan,
            'id_referensi' => $idReferensi,
            'status' => 'pending',
            'prioritas' => $prioritas,
            'pemohon_id' => $pemohonId,
            'catatan_pemohon' => $catatanPemohon,
            'tanggal_permohonan' => date('Y-m-d H:i:s'),
            'deadline' => $deadline
        ]);
    }

    /**
     * Approve request
     */
    public function approveRequest($idApproval, $penyetujuId, $catatanPenyetuju = null)
    {
        return $this->update($idApproval, [
            'status' => 'disetujui',
            'penyetuju_id' => $penyetujuId,
            'catatan_penyetuju' => $catatanPenyetuju,
            'tanggal_persetujuan' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reject request
     */
    public function rejectRequest($idApproval, $penyetujuId, $catatanPenyetuju = null)
    {
        return $this->update($idApproval, [
            'status' => 'ditolak',
            'penyetuju_id' => $penyetujuId,
            'catatan_penyetuju' => $catatanPenyetuju,
            'tanggal_persetujuan' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Request revision
     */
    public function requestRevision($idApproval, $penyetujuId, $catatanPenyetuju = null)
    {
        return $this->update($idApproval, [
            'status' => 'revisi',
            'penyetuju_id' => $penyetujuId,
            'catatan_penyetuju' => $catatanPenyetuju,
            'tanggal_persetujuan' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get pending requests
     */
    public function getPendingRequests($limit = 50)
    {
        return $this->where('status', 'pending')
            ->orderBy('prioritas', 'DESC')
            ->orderBy('tanggal_permohonan', 'ASC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get pending requests by type
     */
    public function getPendingByType($tipePermohonan, $limit = 50)
    {
        return $this->where('tipe_permohonan', $tipePermohonan)
            ->where('status', 'pending')
            ->orderBy('prioritas', 'DESC')
            ->orderBy('tanggal_permohonan', 'ASC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get overdue requests
     */
    public function getOverdueRequests()
    {
        return $this->where('status', 'pending')
            ->where('deadline <', date('Y-m-d H:i:s'))
            ->orderBy('deadline', 'ASC')
            ->findAll();
    }

    /**
     * Get statistics
     */
    public function getStatistics()
    {
        $db = \Config\Database::connect();

        return [
            'total_pending' => $this->where('status', 'pending')->countAllResults(),
            'total_approved' => $this->where('status', 'disetujui')->countAllResults(),
            'total_rejected' => $this->where('status', 'ditolak')->countAllResults(),
            'total_revision' => $this->where('status', 'revisi')->countAllResults(),
            'overdue' => $this->getOverdueRequests(),
            'by_type' => $db->query("
                SELECT tipe_permohonan, COUNT(*) as total, 
                       SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                       SUM(CASE WHEN status = 'disetujui' THEN 1 ELSE 0 END) as approved,
                       SUM(CASE WHEN status = 'ditolak' THEN 1 ELSE 0 END) as rejected
                FROM approval_workflow
                GROUP BY tipe_permohonan
            ")->getResultArray()
        ];
    }

    /**
     * Get approval history
     */
    public function getHistory($tipePermohonan, $idReferensi)
    {
        return $this->where('tipe_permohonan', $tipePermohonan)
            ->where('id_referensi', $idReferensi)
            ->orderBy('tanggal_permohonan', 'DESC')
            ->findAll();
    }
}
