<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuditLogModel;
use App\Models\ApprovalWorkflowModel;
use App\Models\AtletModel;
use App\Models\KlubModel;
use App\Models\EventModel;

class Analytics extends BaseController
{
    protected $auditLogModel;
    protected $approvalModel;
    protected $atletModel;
    protected $klubModel;
    protected $eventModel;

    public function __construct()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            redirect()->to('auth/login')->send();
            exit;
        }

        $this->auditLogModel = new AuditLogModel();
        $this->approvalModel = new ApprovalWorkflowModel();
        $this->atletModel = new AtletModel();
        $this->klubModel = new KlubModel();
        $this->eventModel = new EventModel();
    }

    /**
     * Analytics Dashboard
     */
    public function index()
    {
        $db = \Config\Database::connect();

        // Get date range from request
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');

        // Approval statistics
        $approvalStats = $this->approvalModel->getStatistics();

        // Audit log statistics
        $auditStats = $this->auditLogModel->getStatistics($startDate, $endDate);

        // Activity by module
        $activityByModule = $db->query("
            SELECT modul, COUNT(*) as total, 
                   SUM(CASE WHEN status = 'sukses' THEN 1 ELSE 0 END) as sukses,
                   SUM(CASE WHEN status = 'gagal' THEN 1 ELSE 0 END) as gagal
            FROM audit_log
            WHERE dibuat_pada BETWEEN ? AND ?
            GROUP BY modul
            ORDER BY total DESC
        ", [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->getResultArray();

        // Top users by activity
        $topUsers = $db->query("
            SELECT u.id_user, u.nama_lengkap, COUNT(al.id_audit) as total_aksi
            FROM user u
            LEFT JOIN audit_log al ON al.id_user = u.id_user
            WHERE al.dibuat_pada BETWEEN ? AND ?
            GROUP BY u.id_user, u.nama_lengkap
            ORDER BY total_aksi DESC
            LIMIT 10
        ", [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->getResultArray();

        // Failed actions
        $failedActions = $this->auditLogModel->getFailedActions(10);

        // Growth statistics
        $growthStats = $this->getGrowthStatistics($startDate, $endDate);

        $data = [
            'title' => 'Analytics Dashboard',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'approval_stats' => $approvalStats,
            'audit_stats' => $auditStats,
            'activity_by_module' => $activityByModule,
            'top_users' => $topUsers,
            'failed_actions' => $failedActions,
            'growth_stats' => $growthStats
        ];

        return view('admin/analytics/dashboard', $data);
    }

    /**
     * Audit Log Viewer
     */
    public function auditLog()
    {
        $page = $this->request->getGet('page') ?? 1;
        $modul = $this->request->getGet('modul') ?? null;
        $aksi = $this->request->getGet('aksi') ?? null;
        $status = $this->request->getGet('status') ?? null;
        $limit = 50;

        $query = $this->auditLogModel->select('audit_log.*, user.nama_lengkap')
            ->join('user', 'user.id_user = audit_log.id_user', 'left');

        if ($modul) {
            $query->where('audit_log.modul', $modul);
        }
        if ($aksi) {
            $query->where('audit_log.aksi', $aksi);
        }
        if ($status) {
            $query->where('audit_log.status', $status);
        }

        $total = $query->countAllResults();
        $offset = ($page - 1) * $limit;

        $logs = $query->orderBy('audit_log.dibuat_pada', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        $data = [
            'title' => 'Audit Log',
            'logs' => $logs,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
            'modul' => $modul,
            'aksi' => $aksi,
            'status' => $status
        ];

        return view('admin/analytics/audit_log', $data);
    }

    /**
     * Export Audit Log
     */
    public function exportAuditLog()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');

        $logs = $this->auditLogModel->exportToCSV($startDate, $endDate);

        // Create CSV
        $filename = 'audit_log_' . date('Y-m-d_H-i-s') . '.csv';
        $filepath = FCPATH . 'uploads/export/' . $filename;

        if (!is_dir(FCPATH . 'uploads/export/')) {
            mkdir(FCPATH . 'uploads/export/', 0755, true);
        }

        $file = fopen($filepath, 'w');

        // Header
        fputcsv($file, ['No', 'Tanggal', 'User', 'Aksi', 'Modul', 'Deskripsi', 'Status', 'IP Address']);

        // Data
        $no = 1;
        foreach ($logs as $log) {
            fputcsv($file, [
                $no++,
                $log['dibuat_pada'],
                $log['nama_lengkap'] ?? 'System',
                $log['aksi'],
                $log['modul'],
                $log['deskripsi'],
                $log['status'],
                $log['ip_address']
            ]);
        }

        fclose($file);

        return $this->response->download($filepath, null);
    }

    /**
     * Approval Workflow Dashboard
     */
    public function approvalWorkflow()
    {
        $stats = $this->approvalModel->getStatistics();
        $pendingRequests = $this->approvalModel->getPendingRequests(20);

        $data = [
            'title' => 'Approval Workflow',
            'stats' => $stats,
            'pending_requests' => $pendingRequests
        ];

        return view('admin/analytics/approval_workflow', $data);
    }

    /**
     * Backup & Export Data
     */
    public function backup()
    {
        $data = [
            'title' => 'Backup & Export Data'
        ];

        return view('admin/analytics/backup', $data);
    }

    /**
     * Export all data to CSV
     */
    public function exportAllData()
    {
        $db = \Config\Database::connect();

        // Create backup directory
        $backupDir = FCPATH . 'uploads/backup/';
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $timestamp = date('Y-m-d_H-i-s');
        $backupFile = $backupDir . 'backup_' . $timestamp . '.zip';

        // Create temporary directory for CSV files
        $tempDir = sys_get_temp_dir() . '/ptmsi_backup_' . time();
        mkdir($tempDir);

        try {
            // Export tables
            $tables = ['klub', 'atlet', 'pelatih', 'event', 'berita', 'ranking', 'user'];

            foreach ($tables as $table) {
                $data = $db->table($table)->get()->getResultArray();
                $this->exportTableToCSV($tempDir, $table, $data);
            }

            // Create ZIP file
            $zip = new \ZipArchive();
            $zip->open($backupFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($tempDir),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempDir) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();

            // Clean up temp directory
            $this->deleteDirectory($tempDir);

            // Log the backup
            $auditLog = new AuditLogModel();
            $auditLog->logAksi(
                session()->get('user_id'),
                'BACKUP',
                'SYSTEM',
                'Backup data sistem',
                null,
                ['file' => $backupFile],
                'sukses'
            );

            return $this->response->download($backupFile, null);
        } catch (\Exception $e) {
            // Clean up on error
            if (is_dir($tempDir)) {
                $this->deleteDirectory($tempDir);
            }

            return redirect()->back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    /**
     * Export table to CSV
     */
    private function exportTableToCSV($directory, $tableName, $data)
    {
        $filepath = $directory . '/' . $tableName . '.csv';
        $file = fopen($filepath, 'w');

        if (!empty($data)) {
            // Header
            fputcsv($file, array_keys($data[0]));

            // Data
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
        }

        fclose($file);
    }

    /**
     * Delete directory recursively
     */
    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) return;

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }

        rmdir($dir);
    }

    /**
     * Get growth statistics
     */
    private function getGrowthStatistics($startDate, $endDate)
    {
        $db = \Config\Database::connect();

        return [
            'new_atlet' => $this->atletModel
                ->where('tanggal_bergabung >=', $startDate)
                ->where('tanggal_bergabung <=', $endDate)
                ->countAllResults(),
            'new_klub' => $this->klubModel
                ->where('dibuat_pada >=', $startDate)
                ->where('dibuat_pada <=', $endDate)
                ->countAllResults(),
            'new_event' => $this->eventModel
                ->where('dibuat_pada >=', $startDate)
                ->where('dibuat_pada <=', $endDate)
                ->countAllResults(),
            'total_atlet' => $this->atletModel->countAllResults(),
            'total_klub' => $this->klubModel->countAllResults(),
            'total_event' => $this->eventModel->countAllResults()
        ];
    }
}
