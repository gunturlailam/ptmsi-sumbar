<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Get unread notifications (AJAX)
     */
    public function getUnread()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not logged in', 'unread_count' => 0, 'notifications' => []]);
        }

        try {
            $notifications = $this->notificationModel->getUnreadNotifications(session()->get('user_id'), 10);
            $unreadCount = $this->notificationModel->getUnreadCount(session()->get('user_id'));

            return $this->response->setJSON([
                'success' => true,
                'notifications' => $notifications,
                'unread_count' => $unreadCount
            ]);
        } catch (\Throwable $e) {
            // Table doesn't exist yet - return empty gracefully
            return $this->response->setJSON([
                'success' => true,
                'notifications' => [],
                'unread_count' => 0
            ]);
        }
    }

    /**
     * Get all notifications
     */
    public function getAll()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('auth/login');
        }

        try {
            $page = $this->request->getGet('page') ?? 1;
            $limit = 20;
            $offset = ($page - 1) * $limit;

            $notifications = $this->notificationModel->where('id_user', session()->get('user_id'))
                ->orderBy('dibuat_pada', 'DESC')
                ->limit($limit, $offset)
                ->findAll();

            $total = $this->notificationModel->where('id_user', session()->get('user_id'))
                ->countAllResults();

            $data = [
                'title' => 'Notifikasi',
                'notifications' => $notifications,
                'total' => $total,
                'page' => $page,
                'limit' => $limit
            ];

            return view('notifications/index', $data);
        } catch (\Throwable $e) {
            // Table doesn't exist yet
            $data = [
                'title' => 'Notifikasi',
                'notifications' => [],
                'total' => 0,
                'page' => 1,
                'limit' => 20
            ];
            return view('notifications/index', $data);
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($idNotifikasi)
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not logged in']);
        }

        $notification = $this->notificationModel->find($idNotifikasi);

        if (!$notification || $notification['id_user'] != session()->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $this->notificationModel->markAsRead($idNotifikasi);

        return $this->response->setJSON(['success' => true, 'message' => 'Marked as read']);
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not logged in']);
        }

        $this->notificationModel->markAllAsRead(session()->get('user_id'));

        return $this->response->setJSON(['success' => true, 'message' => 'All marked as read']);
    }

    /**
     * Delete notification
     */
    public function delete($idNotifikasi)
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not logged in']);
        }

        $notification = $this->notificationModel->find($idNotifikasi);

        if (!$notification || $notification['id_user'] != session()->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $this->notificationModel->delete($idNotifikasi);

        return $this->response->setJSON(['success' => true, 'message' => 'Deleted']);
    }

    /**
     * Get notifications by type
     */
    public function getByType($tipe)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('auth/login');
        }

        $notifications = $this->notificationModel->getByType(session()->get('user_id'), $tipe, 50);

        $data = [
            'title' => 'Notifikasi - ' . ucfirst($tipe),
            'notifications' => $notifications,
            'type' => $tipe
        ];

        return view('notifications/by_type', $data);
    }
}
