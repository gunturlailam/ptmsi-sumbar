<?php

namespace App\Models;

use CodeIgniter\Model;

class PertandinganModel extends Model
{
    protected $table = 'pertandingan';
    protected $primaryKey = 'id_pertandingan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_event',
        'babak',
        'id_atlet1',
        'id_atlet2',
        'jadwal',
        'venue'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_event' => 'required|integer',
        'id_atlet1' => 'required|integer',
        'id_atlet2' => 'required|integer',
        'jadwal' => 'required|valid_date[Y-m-d H:i:s]'
    ];

    protected $validationMessages = [
        'id_event' => [
            'required' => 'Event harus dipilih',
            'integer' => 'Event ID harus berupa angka'
        ],
        'id_atlet1' => [
            'required' => 'Atlet 1 harus dipilih',
            'integer' => 'Atlet 1 ID harus berupa angka'
        ],
        'id_atlet2' => [
            'required' => 'Atlet 2 harus dipilih',
            'integer' => 'Atlet 2 ID harus berupa angka'
        ],
        'jadwal' => [
            'required' => 'Jadwal harus diisi',
            'valid_date' => 'Format jadwal tidak valid'
        ]
    ];

    /**
     * Get pertandingan dengan detail atlet
     */
    public function getPertandinganWithAtlet($limit = null)
    {
        $builder = $this->select('pertandingan.*, 
                                 user1.nama_lengkap as nama_atlet1,
                                 user2.nama_lengkap as nama_atlet2,
                                 event.nama_event')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->join('event', 'event.id_event = pertandingan.id_event', 'left')
            ->orderBy('pertandingan.jadwal', 'ASC');

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    /**
     * Get pertandingan by event
     */
    public function getPertandinganByEvent($idEvent)
    {
        return $this->select('pertandingan.*, 
                             user1.nama_lengkap as nama_atlet1,
                             user2.nama_lengkap as nama_atlet2')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->where('pertandingan.id_event', $idEvent)
            ->orderBy('pertandingan.jadwal', 'ASC')
            ->findAll();
    }

    /**
     * Get pertandingan by date
     */
    public function getPertandinganByDate($date)
    {
        return $this->select('pertandingan.*, 
                             user1.nama_lengkap as nama_atlet1,
                             user2.nama_lengkap as nama_atlet2,
                             event.nama_event')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->join('event', 'event.id_event = pertandingan.id_event', 'left')
            ->where('DATE(pertandingan.jadwal)', $date)
            ->orderBy('pertandingan.jadwal', 'ASC')
            ->findAll();
    }

    /**
     * Get pertandingan by atlet
     */
    public function getPertandinganByAtlet($idAtlet)
    {
        return $this->select('pertandingan.*, 
                             user1.nama_lengkap as nama_atlet1,
                             user2.nama_lengkap as nama_atlet2,
                             event.nama_event')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->join('event', 'event.id_event = pertandingan.id_event', 'left')
            ->where('pertandingan.id_atlet1', $idAtlet)
            ->orWhere('pertandingan.id_atlet2', $idAtlet)
            ->orderBy('pertandingan.jadwal', 'ASC')
            ->findAll();
    }

    /**
     * Get statistik pertandingan
     */
    public function getStatistikPertandingan()
    {
        return $this->select('event.id_event, event.nama_event, event.tanggal_mulai, event.tanggal_selesai,
                             COUNT(pertandingan.id_pertandingan) as total_pertandingan')
            ->join('event', 'event.id_event = pertandingan.id_event', 'left')
            ->groupBy('pertandingan.id_event')
            ->orderBy('event.tanggal_mulai', 'DESC')
            ->findAll();
    }
}
