<?php

namespace App\Models;

use CodeIgniter\Model;

class BracketTurnamenModel extends Model
{
    protected $table            = 'bracket_turnamen';
    protected $primaryKey       = 'id_bracket';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_event',
        'kategori',
        'sistem_pertandingan',
        'jumlah_peserta',
        'data_bracket',
        'status',
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
        'id_event'            => 'required|integer',
        'kategori'            => 'required|max_length[50]',
        'sistem_pertandingan' => 'required|in_list[single_elimination,double_elimination,round_robin,group_stage]',
        'jumlah_peserta'      => 'required|integer',
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
     * Get bracket by event dan kategori
     */
    public function getBracketByEventKategori($idEvent, $kategori)
    {
        return $this->where(['id_event' => $idEvent, 'kategori' => $kategori])->first();
    }

    /**
     * Generate bracket dari peserta terverifikasi
     */
    public function generateBracket($idEvent, $kategori, $peserta, $sistemPertandingan = 'single_elimination')
    {
        $jumlahPeserta = count($peserta);

        // Generate bracket structure (simplified)
        $bracketData = [
            'peserta' => $peserta,
            'rounds'  => $this->calculateRounds($jumlahPeserta, $sistemPertandingan),
        ];

        $data = [
            'id_event'            => $idEvent,
            'kategori'            => $kategori,
            'sistem_pertandingan' => $sistemPertandingan,
            'jumlah_peserta'      => $jumlahPeserta,
            'data_bracket'        => json_encode($bracketData),
            'status'              => 'draft',
        ];

        // Check if bracket already exists
        $existing = $this->getBracketByEventKategori($idEvent, $kategori);

        if ($existing) {
            return $this->update($existing['id_bracket'], $data);
        } else {
            return $this->insert($data);
        }
    }

    /**
     * Calculate number of rounds based on participants
     */
    private function calculateRounds($jumlahPeserta, $sistem)
    {
        if ($sistem === 'single_elimination' || $sistem === 'double_elimination') {
            return ceil(log($jumlahPeserta, 2));
        } elseif ($sistem === 'round_robin') {
            return $jumlahPeserta - 1;
        }

        return 1;
    }

    /**
     * Aktivasi bracket
     */
    public function aktivasiBracket($id)
    {
        return $this->update($id, ['status' => 'aktif']);
    }

    /**
     * Update bracket data
     */
    public function updateBracketData($id, $bracketData)
    {
        return $this->update($id, ['data_bracket' => json_encode($bracketData)]);
    }

    /**
     * Get all brackets by event
     */
    public function getBracketsByEvent($idEvent)
    {
        return $this->where('id_event', $idEvent)
            ->orderBy('kategori', 'ASC')
            ->findAll();
    }
}
