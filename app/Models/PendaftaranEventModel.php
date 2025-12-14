<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranEventModel extends Model
{
    protected $table            = 'pendaftaran_event';
    protected $primaryKey       = 'id_pendaftaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_event',
        'tipe_pendaftar',
        'id_klub',
        'id_atlet',
        'kategori',
        'nama_atlet1',
        'nama_atlet2',
        'nohp_pendaftar',
        'biaya_pendaftaran',
        'status_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'status_verifikasi',
        'tanggal_verifikasi',
        'catatan_verifikasi',
        'nomor_peserta',
        'tanggal_daftar',
        'id_verifikator',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_daftar';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_event'       => 'required|integer',
        'tipe_pendaftar' => 'required|in_list[klub,atlet]',
        'kategori'       => 'required|max_length[50]',
        'nama_atlet1'    => 'required|max_length[150]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setTanggalDaftar'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function setTanggalDaftar(array $data)
    {
        if (!isset($data['data']['tanggal_daftar'])) {
            $data['data']['tanggal_daftar'] = date('Y-m-d H:i:s');
        }
        return $data;
    }

    /**
     * Get pendaftaran by event dengan join
     */
    public function getPendaftaranByEvent($idEvent)
    {
        return $this->select('pendaftaran_event.*, event.judul as nama_event, klub.nama_klub, atlet.id_user')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->join('klub', 'klub.id_klub = pendaftaran_event.id_klub', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->where('pendaftaran_event.id_event', $idEvent)
            ->orderBy('pendaftaran_event.tanggal_daftar', 'ASC')
            ->findAll();
    }

    /**
     * Get pendaftaran menunggu verifikasi
     */
    public function getPendaftaranMenungguVerifikasi()
    {
        return $this->select('pendaftaran_event.*, event.judul as nama_event')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->where('pendaftaran_event.status_verifikasi', 'pending')
            ->orderBy('pendaftaran_event.tanggal_daftar', 'ASC')
            ->findAll();
    }

    /**
     * Get pendaftaran menunggu konfirmasi pembayaran
     */
    public function getPendaftaranMenungguKonfirmasi()
    {
        return $this->select('pendaftaran_event.*, event.judul as nama_event')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->where('pendaftaran_event.status_pembayaran', 'menunggu_konfirmasi')
            ->orderBy('pendaftaran_event.tanggal_pembayaran', 'ASC')
            ->findAll();
    }

    /**
     * Konfirmasi pembayaran
     */
    public function konfirmasiPembayaran($id, $status, $idVerifikator = null)
    {
        $data = [
            'status_pembayaran' => $status,
            'id_verifikator'    => $idVerifikator,
        ];

        return $this->update($id, $data);
    }

    /**
     * Verifikasi pendaftaran
     */
    public function verifikasiPendaftaran($id, $status, $catatan = null, $idVerifikator = null, $nomorPeserta = null)
    {
        $data = [
            'status_verifikasi'  => $status,
            'catatan_verifikasi' => $catatan,
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'id_verifikator'     => $idVerifikator,
        ];

        if ($nomorPeserta) {
            $data['nomor_peserta'] = $nomorPeserta;
        }

        return $this->update($id, $data);
    }

    /**
     * Get peserta terverifikasi untuk bracket
     */
    public function getPesertaTerverifikasi($idEvent, $kategori = null)
    {
        $builder = $this->select('pendaftaran_event.*')
            ->where('id_event', $idEvent)
            ->where('status_verifikasi', 'diverifikasi')
            ->where('status_pembayaran', 'lunas');

        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        return $builder->orderBy('nomor_peserta', 'ASC')->findAll();
    }

    /**
     * Get statistik pendaftaran by event
     */
    public function getStatistikPendaftaran($idEvent)
    {
        $total = $this->where('id_event', $idEvent)->countAllResults();
        $pending = $this->where(['id_event' => $idEvent, 'status_verifikasi' => 'pending'])->countAllResults();
        $diverifikasi = $this->where(['id_event' => $idEvent, 'status_verifikasi' => 'diverifikasi'])->countAllResults();
        $ditolak = $this->where(['id_event' => $idEvent, 'status_verifikasi' => 'ditolak'])->countAllResults();

        return [
            'total'        => $total,
            'pending'      => $pending,
            'diverifikasi' => $diverifikasi,
            'ditolak'      => $ditolak,
        ];
    }
}
