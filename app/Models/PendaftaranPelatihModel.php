<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranPelatihModel extends Model
{
    protected $table            = 'pendaftaran_pelatih';
    protected $primaryKey       = 'id_pendaftaran_pelatih';
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
        'jenis_pelatih',
        'id_klub',
        'foto_path',
        'sertifikat_path',
        'status',
        'tanggal_daftar',
        'didaftarkan_oleh',
        'catatan_provinsi',
        'tanggal_verifikasi',
        'diverifikasi_oleh',
        'id_pelatih',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diperbarui_pada';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_lengkap'  => 'required|min_length[3]|max_length[150]',
        'nik'           => 'required|exact_length[16]',
        'tempat_lahir'  => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'jenis_kelamin' => 'required|in_list[L,P]',
        'alamat'        => 'required|min_length[10]',
        'no_hp'         => 'required|min_length[10]|max_length[15]',
        'email'         => 'required|valid_email|max_length[100]',
        'jenis_pelatih' => 'required|in_list[pelatih,wasit]',
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
        $data['data']['diperbarui_pada'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Get pendaftaran dengan status tertentu
     */
    public function getPendaftaranByStatus($status)
    {
        return $this->select('pendaftaran_pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_pelatih.id_klub', 'left')
            ->where('pendaftaran_pelatih.status', $status)
            ->orderBy('pendaftaran_pelatih.tanggal_daftar', 'DESC')
            ->findAll();
    }

    /**
     * Get pendaftaran pending untuk admin
     */
    public function getPendaftaranPending()
    {
        return $this->select('pendaftaran_pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_pelatih.id_klub', 'left')
            ->where('pendaftaran_pelatih.status', 'menunggu_verifikasi_provinsi')
            ->orderBy('pendaftaran_pelatih.tanggal_daftar', 'ASC')
            ->findAll();
    }

    /**
     * Verifikasi pendaftaran pelatih
     */
    public function verifikasiPendaftaran($id, $status, $catatan = null, $idAdmin = null)
    {
        $data = [
            'status'              => $status,
            'catatan_provinsi'    => $catatan,
            'diverifikasi_oleh'   => $idAdmin,
            'tanggal_verifikasi'  => date('Y-m-d H:i:s'),
        ];

        return $this->update($id, $data);
    }

    /**
     * Aktivasi profil pelatih setelah diterima
     */
    public function aktivasiPelatih($idPendaftaran, $idPelatih)
    {
        return $this->update($idPendaftaran, [
            'id_pelatih' => $idPelatih,
            'status'     => 'diterima',
        ]);
    }

    /**
     * Get all pendaftaran with klub info
     */
    public function getAllWithKlub()
    {
        return $this->select('pendaftaran_pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pendaftaran_pelatih.id_klub', 'left')
            ->orderBy('pendaftaran_pelatih.tanggal_daftar', 'DESC')
            ->findAll();
    }
}
