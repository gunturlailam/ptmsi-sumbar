<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranAtletModel extends Model
{
    protected $table            = 'pendaftaran_atlet';
    protected $primaryKey       = 'id_pendaftaran_atlet';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'kategori_usia',
        'id_klub',
        'foto_path',
        'ktp_path',
        'status',
        'tanggal_daftar',
        'didaftarkan_oleh',
        'catatan_klub',
        'tanggal_verifikasi_klub',
        'diverifikasi_klub_oleh',
        'catatan_provinsi',
        'tanggal_verifikasi_provinsi',
        'diverifikasi_provinsi_oleh',
        'catatan_admin',
        'id_admin_verifikator',
        'tanggal_verifikasi',
        'id_atlet',
        'dibuat_pada',
        'diupdate_pada',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diupdate_pada';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_lengkap'  => 'required|min_length[3]|max_length[150]',
        'nik'           => 'required|min_length[16]|max_length[16]',
        'tempat_lahir'  => 'permit_empty|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'jenis_kelamin' => 'required|in_list[L,P]',
        'alamat'        => 'permit_empty|min_length[3]',
        'no_hp'         => 'permit_empty|min_length[10]|max_length[15]',
        'email'         => 'required|valid_email|max_length[100]',
        'kategori_usia' => 'required|in_list[U-12,U-15,U-18,Senior]',
        'id_klub'       => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setCreatedDate'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['setUpdatedDate'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function setCreatedDate(array $data)
    {
        $data['data']['dibuat_pada'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function setUpdatedDate(array $data)
    {
        $data['data']['diupdate_pada'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Get pendaftaran dengan status tertentu
     */
    public function getPendaftaranByStatus($status)
    {
        return $this->where('status', $status)
            ->orderBy('dibuat_pada', 'DESC')
            ->findAll();
    }

    /**
     * Get pendaftaran pending untuk admin
     */
    public function getPendaftaranPending()
    {
        return $this->where('status', 'pending')
            ->orderBy('dibuat_pada', 'ASC')
            ->findAll();
    }

    /**
     * Verifikasi pendaftaran atlet
     */
    public function verifikasiPendaftaran($id, $status, $catatan = null, $idAdmin = null)
    {
        $data = [
            'status'              => $status,
            'catatan_admin'       => $catatan,
            'id_admin_verifikator' => $idAdmin,
            'tanggal_verifikasi'  => date('Y-m-d H:i:s'),
        ];

        return $this->update($id, $data);
    }

    /**
     * Aktivasi profil atlet setelah diterima
     */
    public function aktivasiAtlet($idPendaftaran, $idAtlet)
    {
        return $this->update($idPendaftaran, [
            'id_atlet' => $idAtlet,
            'status'   => 'diterima',
        ]);
    }
}
