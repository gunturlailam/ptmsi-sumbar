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
        'id_user',
        'id_klub',
        'nama_lengkap',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'kategori_usia',
        'alamat',
        'no_hp',
        'tinggi_badan',
        'berat_badan',
        'foto',
        'riwayat_prestasi',
        'ranking_provinsi',
        'status',
        'tanggal_bergabung',
        'alasan_nonaktif',
        'tanggal_nonaktif',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'id_user' => 'required',
        'id_klub' => 'required|integer',
        'jenis_kelamin' => 'permit_empty|in_list[L,P]',
        'kategori_usia' => 'permit_empty|in_list[U-12,U-15,U-18,Senior]'
    ];

    protected $validationMessages = [
        'id_user' => [
            'required' => 'User harus dipilih'
        ],
        'id_klub' => [
            'required' => 'Klub harus dipilih',
            'integer' => 'ID klub harus berupa angka'
        ],
        'jenis_kelamin' => [
            'in_list' => 'Jenis kelamin tidak valid (L/P)'
        ],
        'kategori_usia' => [
            'in_list' => 'Kategori usia tidak valid'
        ]
    ];

    public function getAtletWithUser()
    {
        return $this->select('atlet.*, user.nama_lengkap, user.email')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->findAll();
    }

    public function getAtletById($id)
    {
        return $this->select('atlet.*, user.nama_lengkap, user.email')
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
