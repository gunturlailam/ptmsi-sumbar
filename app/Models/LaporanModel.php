<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan_kegiatan';
    protected $primaryKey = 'id_laporan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'judul_laporan',
        'deskripsi',
        'tanggal_kegiatan',
        'tanggal_laporan',
        'file_path',
        'id_organisasi',
        'dibuat_oleh',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'judul_laporan' => 'required|min_length[3]|max_length[200]',
        'deskripsi' => 'required|min_length[10]',
        'tanggal_kegiatan' => 'required|valid_date',
        'id_organisasi' => 'required|integer',
        'dibuat_oleh' => 'required'
    ];

    protected $validationMessages = [
        'judul_laporan' => [
            'required' => 'Judul laporan harus diisi',
            'min_length' => 'Judul laporan minimal 3 karakter',
            'max_length' => 'Judul laporan maksimal 200 karakter'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi minimal 10 karakter'
        ],
        'tanggal_kegiatan' => [
            'required' => 'Tanggal kegiatan harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ]
    ];

    /**
     * Get laporan by organisasi
     */
    public function getLaporanByOrganisasi($idOrganisasi, $tahun = null)
    {
        $builder = $this->select('laporan_kegiatan.*, user.nama_lengkap as nama_pembuat')
            ->join('user', 'user.id_user = laporan_kegiatan.dibuat_oleh', 'left')
            ->where('id_organisasi', $idOrganisasi);

        if ($tahun) {
            $builder->where('YEAR(tanggal_kegiatan)', $tahun);
        }

        return $builder->orderBy('tanggal_kegiatan', 'DESC')->findAll();
    }
}
