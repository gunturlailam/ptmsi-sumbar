<?php

namespace App\Models;

use CodeIgniter\Model;

class OfisialAssignmentModel extends Model
{
    protected $table = 'ofisial_assignment';
    protected $primaryKey = 'id_assignment';
    protected $allowedFields = [
        'id_ofisial',
        'id_event',
        'role_assignment',
        'status',
        'dibuat_pada',
        'diperbarui_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Get assignment dengan detail ofisial dan event
     */
    public function getAssignmentWithDetails()
    {
        return $this->select('
            ofisial_assignment.*,
            ofisial.nomor_lisensi,
            user.nama_lengkap,
            user.email,
            user.nohp,
            event.nama_event,
            event.tanggal_mulai,
            event.tanggal_selesai,
            event.lokasi
        ')
            ->join('ofisial', 'ofisial.id_ofisial = ofisial_assignment.id_ofisial', 'left')
            ->join('user', 'user.id_user = ofisial.id_user', 'left')
            ->join('event', 'event.id_event = ofisial_assignment.id_event', 'left')
            ->orderBy('ofisial_assignment.dibuat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get assignment by event
     */
    public function getAssignmentByEvent($idEvent)
    {
        return $this->select('
            ofisial_assignment.*,
            ofisial.nomor_lisensi,
            user.nama_lengkap,
            user.email,
            user.nohp
        ')
            ->join('ofisial', 'ofisial.id_ofisial = ofisial_assignment.id_ofisial', 'left')
            ->join('user', 'user.id_user = ofisial.id_user', 'left')
            ->where('ofisial_assignment.id_event', $idEvent)
            ->findAll();
    }

    /**
     * Get assignment by ofisial
     */
    public function getAssignmentByOfisial($idOfisial)
    {
        return $this->select('
            ofisial_assignment.*,
            event.nama_event,
            event.tanggal_mulai,
            event.tanggal_selesai,
            event.lokasi
        ')
            ->join('event', 'event.id_event = ofisial_assignment.id_event', 'left')
            ->where('ofisial_assignment.id_ofisial', $idOfisial)
            ->orderBy('event.tanggal_mulai', 'DESC')
            ->findAll();
    }

    /**
     * Check if ofisial already assigned to event
     */
    public function isAssigned($idOfisial, $idEvent)
    {
        return $this->where('id_ofisial', $idOfisial)
            ->where('id_event', $idEvent)
            ->countAllResults() > 0;
    }
}
