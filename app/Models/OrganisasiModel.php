<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganisasiModel extends Model
{
    protected $table = 'organisasi';
    protected $primaryKey = 'id_organisasi';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_organisasi',
        'nama_organisasi',
        'jenis',
        'id_induk_organisasi',
        'alamat',
        'nohp'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'nama_organisasi' => 'required|min_length[3]|max_length[100]',
        'jenis' => 'required|in_list[provinsi,kabupaten]',
        'alamat' => 'permit_empty|min_length[10]'
    ];

    protected $validationMessages = [
        'nama_organisasi' => [
            'required' => 'Nama organisasi harus diisi',
            'min_length' => 'Nama organisasi minimal 3 karakter',
            'max_length' => 'Nama organisasi maksimal 100 karakter'
        ],
        'jenis' => [
            'required' => 'Jenis organisasi harus dipilih',
            'in_list' => 'Jenis organisasi tidak valid'
        ],
        'alamat' => [
            'min_length' => 'Alamat minimal 10 karakter'
        ]
    ];

    public function getOrganisasiByJenis($jenis)
    {
        return $this->where('jenis', $jenis)->findAll();
    }

    public function getOrganisasiProvinsi()
    {
        return $this->where('jenis', 'provinsi')->findAll();
    }

    public function getOrganisasiKabupaten()
    {
        return $this->where('jenis', 'kabupaten')->findAll();
    }

    public function getOrganisasiWithInduk()
    {
        return $this->select('organisasi.*, induk.nama_organisasi as nama_induk')
            ->join('organisasi as induk', 'induk.id_organisasi = organisasi.id_induk_organisasi', 'left')
            ->findAll();
    }

    public function getAllOrganisasi()
    {
        return $this->findAll();
    }
}
