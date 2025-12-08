<?php

namespace App\Models;

use CodeIgniter\Model;

class KlubModel extends Model
{
    protected $table = 'klub';
    protected $primaryKey = 'id_klub';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_klub',
        'id_organisasi',
        'nama',
        'alamat',
        'penanggung_jawab',
        'telepon',
        'tanggal_berdiri',
        'status'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'alamat' => 'permit_empty|min_length[10]',
        'penanggung_jawab' => 'permit_empty|min_length[3]',
        'telepon' => 'permit_empty|min_length[10]',
        'tanggal_berdiri' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama klub harus diisi',
            'min_length' => 'Nama klub minimal 3 karakter',
            'max_length' => 'Nama klub maksimal 100 karakter'
        ],
        'alamat' => [
            'min_length' => 'Alamat minimal 10 karakter'
        ],
        'penanggung_jawab' => [
            'min_length' => 'Penanggung jawab minimal 3 karakter'
        ],
        'telepon' => [
            'min_length' => 'Telepon minimal 10 karakter'
        ],
        'tanggal_berdiri' => [
            'valid_date' => 'Format tanggal tidak valid'
        ]
    ];

    public function getKlubWithOrganisasi()
    {
        return $this->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->findAll();
    }

    public function getKlubById($id)
    {
        return $this->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->where('klub.id_klub', $id)
            ->first();
    }

    public function getKlubByOrganisasi($organisasiId)
    {
        return $this->where('id_organisasi', $organisasiId)->findAll();
    }
}
