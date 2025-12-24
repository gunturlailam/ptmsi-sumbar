<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_user',
        'tipe',
        'judul',
        'pesan',
        'id_referensi',
        'tipe_referensi',
        'dibaca',
        'dibaca_pada',
        'dibuat_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Send notification
     */
    public function sendNotification($idUser, $tipe, $judul, $pesan, $idReferensi = null, $tipeReferensi = null)
    {
        return $this->insert([
            'id_user' => $idUser,
            'tipe' => $tipe,
            'judul' => $judul,
            'pesan' => $pesan,
            'id_referensi' => $idReferensi,
            'tipe_referensi' => $tipeReferensi,
            'dibaca' => false,
            'dibuat_pada' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Send notification to multiple users
     */
    public function sendBulkNotification($userIds, $tipe, $judul, $pesan, $idReferensi = null, $tipeReferensi = null)
    {
        $data = [];
        foreach ($userIds as $userId) {
            $data[] = [
                'id_user' => $userId,
                'tipe' => $tipe,
                'judul' => $judul,
                'pesan' => $pesan,
                'id_referensi' => $idReferensi,
                'tipe_referensi' => $tipeReferensi,
                'dibaca' => false,
                'dibuat_pada' => date('Y-m-d H:i:s')
            ];
        }
        return $this->insertBatch($data);
    }

    /**
     * Get unread notifications for user
     */
    public function getUnreadNotifications($idUser, $limit = 10)
    {
        try {
            return $this->where('id_user', $idUser)
                ->where('dibaca', false)
                ->orderBy('dibuat_pada', 'DESC')
                ->limit($limit)
                ->findAll();
        } catch (\Throwable $e) {
            // Table doesn't exist yet
            return [];
        }
    }

    /**
     * Get all notifications for user
     */
    public function getUserNotifications($idUser, $limit = 50)
    {
        try {
            return $this->where('id_user', $idUser)
                ->orderBy('dibuat_pada', 'DESC')
                ->limit($limit)
                ->findAll();
        } catch (\Throwable $e) {
            // Table doesn't exist yet
            return [];
        }
    }

    /**
     * Get unread count for user
     */
    public function getUnreadCount($idUser)
    {
        try {
            return $this->where('id_user', $idUser)
                ->where('dibaca', false)
                ->countAllResults();
        } catch (\Throwable $e) {
            // Table doesn't exist yet
            return 0;
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($idNotifikasi)
    {
        try {
            return $this->update($idNotifikasi, [
                'dibaca' => true,
                'dibaca_pada' => date('Y-m-d H:i:s')
            ]);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Mark all notifications as read for user
     */
    public function markAllAsRead($idUser)
    {
        try {
            return $this->where('id_user', $idUser)
                ->set('dibaca', true)
                ->set('dibaca_pada', date('Y-m-d H:i:s'))
                ->update();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Get notifications by type
     */
    public function getByType($idUser, $tipe, $limit = 20)
    {
        try {
            return $this->where('id_user', $idUser)
                ->where('tipe', $tipe)
                ->orderBy('dibuat_pada', 'DESC')
                ->limit($limit)
                ->findAll();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Delete old notifications (older than X days)
     */
    public function deleteOldNotifications($days = 30)
    {
        try {
            $date = date('Y-m-d H:i:s', strtotime("-{$days} days"));
            return $this->where('dibuat_pada <', $date)
                ->where('dibaca', true)
                ->delete();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Get notification statistics
     */
    public function getStatistics($idUser)
    {
        try {
            return [
                'unread' => $this->where('id_user', $idUser)
                    ->where('dibaca', false)
                    ->countAllResults(),
                'total' => $this->where('id_user', $idUser)
                    ->countAllResults(),
                'by_type' => $this->select('tipe, COUNT(*) as total')
                    ->where('id_user', $idUser)
                    ->groupBy('tipe')
                    ->findAll()
            ];
        } catch (\Throwable $e) {
            return [
                'unread' => 0,
                'total' => 0,
                'by_type' => []
            ];
        }
    }
}
