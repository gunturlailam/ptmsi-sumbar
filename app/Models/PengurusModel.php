<?php

namespace App\Models;

use CodeIgniter\Model;

class PengurusModel extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'id_pengurus';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_organisasi',
        'nama',
        'jabatan',
        'telepon',
        'email',
        'periode_mulai',
        'periode_selesai',
        'status'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'jabatan' => 'required|min_length[3]|max_length[50]',
        'email' => 'permit_empty|valid_email',
        'telepon' => 'permit_empty|min_length[10]',
        'status' => 'permit_empty|in_list[aktif,non-aktif]'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama pengurus harus diisi',
            'min_length' => 'Nama pengurus minimal 3 karakter',
            'max_length' => 'Nama pengurus maksimal 100 karakter'
        ],
        'jabatan' => [
            'required' => 'Jabatan harus diisi',
            'min_length' => 'Jabatan minimal 3 karakter',
            'max_length' => 'Jabatan maksimal 50 karakter'
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid'
        ],
        'telepon' => [
            'min_length' => 'Telepon minimal 10 karakter'
        ],
        'status' => [
            'in_list' => 'Status tidak valid'
        ]
    ];

    public function getPengurusWithOrganisasi()
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->findAll();
    }

    public function getPengurusById($id)
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->where('pengurus.id_pengurus', $id)
            ->first();
    }

    public function getPengurusByOrganisasi($organisasiId)
    {
        return $this->where('id_organisasi', $organisasiId)->findAll();
    }

    public function getPengurusAktif()
    {
        return $this->select('pengurus.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = pengurus.id_organisasi', 'left')
            ->where('pengurus.status', 'aktif')
            ->findAll();
    }
}
