<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanKontakModel extends Model
{
    protected $table = 'pesan_kontak';
    protected $primaryKey = 'id_pesan';
    protected $allowedFields = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'dibuat_pada',
        'status'
    ];
    protected $useTimestamps = false;

    /**
     * Get all messages
     */
    public function getAllMessages()
    {
        return $this->orderBy('dibuat_pada', 'DESC')->findAll();
    }

    /**
     * Get messages by status
     */
    public function getMessagesByStatus($status)
    {
        return $this->where('status', $status)
            ->orderBy('dibuat_pada', 'DESC')
            ->findAll();
    }
}
