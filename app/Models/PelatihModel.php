<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihModel extends Model
{
    protected $table = 'pelatih';
    protected $primaryKey = 'id_pelatih';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_user',
        'id_klub',
        'tingkat_sertifikasi',
        'tanggal_sertifikasi'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'id_user' => 'required',
        'id_klub' => 'permit_empty|integer',
        'tingkat_sertifikasi' => 'permit_empty|in_list[Dasar,Menengah,Lanjut,Nasional,Internasional]',
        'tanggal_sertifikasi' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'id_user' => [
            'required' => 'User harus dipilih'
        ],
        'id_klub' => [
            'integer' => 'ID Klub harus berupa angka'
        ],
        'tingkat_sertifikasi' => [
            'in_list' => 'Tingkat sertifikasi tidak valid'
        ],
        'tanggal_sertifikasi' => [
            'valid_date' => 'Tanggal sertifikasi tidak valid'
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

    /**
     * Insert pelatih tanpa validation untuk proses aktivasi
     */
    public function insertWithoutValidation($data)
    {
        $db = \Config\Database::connect();
        $result = $db->table($this->table)->insert($data);

        if ($result) {
            return $db->insertID();
        }

        return false;
    }
}
