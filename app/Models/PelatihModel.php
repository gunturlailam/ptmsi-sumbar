<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihModel extends Model
{
    protected $table = 'pelatih';
    protected $primaryKey = 'id_pelatih';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_pelatih',
        'id_user',
        'id_klub',
        'nomor_lisensi',
        'level_sertifikasi',
        'tanggal_sertifikasi',
        'masa_berlaku_sertifikasi',
        'spesialisasi',
        'pengalaman_tahun',
        'foto_sertifikat',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'id_user' => 'required',
        'nomor_lisensi' => 'permit_empty|is_unique[pelatih.nomor_lisensi,id_pelatih,{id_pelatih}]',
        'level_sertifikasi' => 'permit_empty|in_list[Dasar,Menengah,Lanjut,Nasional,Internasional]',
        'pengalaman_tahun' => 'permit_empty|integer|greater_than_equal_to[0]'
    ];

    protected $validationMessages = [
        'id_user' => [
            'required' => 'User harus dipilih'
        ],
        'nomor_lisensi' => [
            'is_unique' => 'Nomor lisensi sudah digunakan'
        ],
        'level_sertifikasi' => [
            'in_list' => 'Level sertifikasi tidak valid'
        ],
        'pengalaman_tahun' => [
            'integer' => 'Pengalaman harus berupa angka',
            'greater_than_equal_to' => 'Pengalaman tidak boleh negatif'
        ]
    ];

    public function getPelatihWithUser()
    {
        return $this->select('pelatih.*, user.nama_lengkap, user.email, 
                            pelatih.tingkat_sertifikasi as level_sertifikasi,
                            NULL as nomor_lisensi, NULL as masa_berlaku_sertifikasi, 
                            NULL as spesialisasi, NULL as pengalaman_tahun, NULL as foto_sertifikat')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->findAll();
    }

    public function getPelatihById($id)
    {
        return $this->select('pelatih.*, user.nama_lengkap, user.email, 
                            pelatih.tingkat_sertifikasi as level_sertifikasi,
                            NULL as nomor_lisensi, NULL as masa_berlaku_sertifikasi, 
                            NULL as spesialisasi, NULL as pengalaman_tahun, NULL as foto_sertifikat')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->where('pelatih.id_pelatih', $id)
            ->first();
    }

    public function getPelatihWithKlub()
    {
        $pelatih = $this->getPelatihWithUser();

        // Manually get klub info for each pelatih
        $klubModel = new \App\Models\KlubModel();
        foreach ($pelatih as &$item) {
            if ($item['id_klub']) {
                $klub = $klubModel->find($item['id_klub']);
                $item['nama_klub'] = $klub['nama_klub'] ?? null;
            } else {
                $item['nama_klub'] = null;
            }
        }

        return $pelatih;
    }
}
