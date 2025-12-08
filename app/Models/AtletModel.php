<?php

namespace App\Models;

use CodeIgniter\Model;

class AtletModel extends Model
{
    protected $table = 'atlet';
    protected $primaryKey = 'id_atlet';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_atlet',
        'id_user',
        'id_klub',
        'nomor_lisensi',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'tinggi_badan',
        'berat_badan',
        'alamat',
        'foto_profil',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'id_user' => 'required',
        'nomor_lisensi' => 'permit_empty|is_unique[atlet.nomor_lisensi,id_atlet,{id_atlet}]',
        'tanggal_lahir' => 'required|valid_date',
        'tempat_lahir' => 'required|min_length[3]',
        'jenis_kelamin' => 'required|in_list[L,P]'
    ];

    protected $validationMessages = [
        'id_user' => [
            'required' => 'User harus dipilih'
        ],
        'nomor_lisensi' => [
            'is_unique' => 'Nomor lisensi sudah digunakan'
        ],
        'tanggal_lahir' => [
            'required' => 'Tanggal lahir harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ],
        'tempat_lahir' => [
            'required' => 'Tempat lahir harus diisi',
            'min_length' => 'Tempat lahir minimal 3 karakter'
        ],
        'jenis_kelamin' => [
            'required' => 'Jenis kelamin harus dipilih',
            'in_list' => 'Jenis kelamin tidak valid'
        ]
    ];

    public function getAtletWithUser()
    {
        return $this->select('atlet.*, user.nama_lengkap, user.email, NULL as foto_profil, NULL as nomor_lisensi, NULL as tempat_lahir, NULL as tinggi_badan, NULL as berat_badan, NULL as alamat')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->findAll();
    }

    public function getAtletById($id)
    {
        return $this->select('atlet.*, user.nama_lengkap, user.email, NULL as foto_profil, NULL as nomor_lisensi, NULL as tempat_lahir, NULL as tinggi_badan, NULL as berat_badan, NULL as alamat')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('atlet.id_atlet', $id)
            ->first();
    }

    public function getAtletWithKlub()
    {
        $atlet = $this->getAtletWithUser();

        // Manually get klub info for each atlet
        $klubModel = new \App\Models\KlubModel();
        foreach ($atlet as &$item) {
            if ($item['id_klub']) {
                $klub = $klubModel->find($item['id_klub']);
                $item['nama_klub'] = $klub['nama'] ?? null; // Fixed: use 'nama' instead of 'nama_klub'
            } else {
                $item['nama_klub'] = null;
            }
        }

        return $atlet;
    }

    public function getAtletByIdWithKlub($id)
    {
        $atlet = $this->getAtletById($id);

        if ($atlet) {
            // Manually get klub info
            $klubModel = new \App\Models\KlubModel();
            if ($atlet['id_klub']) {
                $klub = $klubModel->find($atlet['id_klub']);
                $atlet['nama_klub'] = $klub['nama'] ?? null; // Fixed: use 'nama' instead of 'nama_klub'
            } else {
                $atlet['nama_klub'] = null;
            }
        }

        return $atlet;
    }
}
