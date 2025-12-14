<?php

namespace App\Models;

use CodeIgniter\Model;

class KlubModel extends Model
{
    protected $table = 'klub';
    protected $primaryKey = 'id_klub';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_klub',
        'id_user',
        'id_organisasi',
        'nama',
        'alamat',
        'penanggung_jawab',
        'telepon',
        'tanggal_berdiri',
        'status',
        'sk_klub_path',
        'identitas_pengurus_path',
        'catatan_verifikasi',
        'tanggal_verifikasi',
        'diverifikasi_oleh',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'id_user' => 'permit_empty|max_length[36]',
        'id_organisasi' => 'required|integer',
        'nama' => 'required|min_length[3]|max_length[100]',
        'alamat' => 'permit_empty|min_length[10]',
        'penanggung_jawab' => 'permit_empty|min_length[3]',
        'telepon' => 'permit_empty|min_length[10]',
        'tanggal_berdiri' => 'permit_empty|valid_date',
        'status' => 'permit_empty|in_list[pending,aktif,ditolak,nonaktif]',
        'sk_klub_path' => 'permit_empty|max_length[255]',
        'identitas_pengurus_path' => 'permit_empty|max_length[255]',
        'catatan_verifikasi' => 'permit_empty',
        'tanggal_verifikasi' => 'permit_empty|valid_date',
        'diverifikasi_oleh' => 'permit_empty|max_length[36]'
    ];

    protected $validationMessages = [
        'id_organisasi' => [
            'required' => 'Organisasi harus dipilih',
            'integer' => 'ID organisasi tidak valid'
        ],
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
        ],
        'status' => [
            'in_list' => 'Status tidak valid'
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
