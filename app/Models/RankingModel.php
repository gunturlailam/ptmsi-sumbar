<?php

namespace App\Models;

use CodeIgniter\Model;

class RankingModel extends Model
{
    protected $table = 'ranking';
    protected $primaryKey = 'id_ranking';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_atlet',
        'kategori_usia',
        'posisi',
        'poin',
        'tanggal_berlaku'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';

    protected $validationRules = [
        'id_atlet' => 'required|integer',
        'kategori_usia' => 'required|string|max_length[20]',
        'posisi' => 'required|integer|greater_than[0]',
        'poin' => 'permit_empty|integer'
    ];

    protected $validationMessages = [
        'id_atlet' => [
            'required' => 'ID Atlet harus diisi',
            'integer' => 'ID Atlet harus berupa angka'
        ],
        'kategori_usia' => [
            'required' => 'Kategori usia harus diisi',
            'string' => 'Kategori usia harus berupa teks'
        ],
        'posisi' => [
            'required' => 'Posisi harus diisi',
            'integer' => 'Posisi harus berupa angka',
            'greater_than' => 'Posisi harus lebih dari 0'
        ]
    ];

    /**
     * Get ranking by athlete ID
     */
    public function getRankingByAtlet($idAtlet, $kategori = null)
    {
        $builder = $this->where('id_atlet', $idAtlet);

        if ($kategori) {
            $builder->where('kategori_usia', $kategori);
        }

        return $builder->orderBy('tanggal_berlaku', 'DESC')
            ->findAll();
    }

    /**
     * Get current ranking
     */
    public function getCurrentRanking($limit = null)
    {
        $builder = $this->select('ranking.*, user.nama_lengkap, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('tanggal_berlaku <=', date('Y-m-d'))
            ->orderBy('posisi', 'ASC');

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    /**
     * Update or insert ranking data (upsert)
     */
    public function upsertRanking($data)
    {
        $existing = $this->where('id_atlet', $data['id_atlet'])
            ->where('kategori_usia', $data['kategori_usia'])
            ->first();

        if ($existing) {
            return $this->update($existing['id_ranking'], $data);
        } else {
            return $this->insert($data);
        }
    }

    /**
     * Get ranking with athlete details
     */
    public function getRankingWithAtlet()
    {
        return $this->select('ranking.*, 
                             user.nama_lengkap, 
                             atlet.jenis_kelamin,
                             atlet.tanggal_lahir,
                             klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('tanggal_berlaku <=', date('Y-m-d'))
            ->orderBy('posisi', 'ASC')
            ->findAll();
    }

    /**
     * Get ranking by kategori (gender/age group)
     */
    public function getRankingByKategori($kategori)
    {
        $builder = $this->select('ranking.*, 
                                 user.nama_lengkap, 
                                 atlet.jenis_kelamin,
                                 atlet.tanggal_lahir,
                                 klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet')
            ->join('user', 'user.id_user = atlet.id_user')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('tanggal_berlaku <=', date('Y-m-d'));

        // Filter by kategori
        if ($kategori === 'putra') {
            $builder->where('atlet.jenis_kelamin', 'L');
        } elseif ($kategori === 'putri') {
            $builder->where('atlet.jenis_kelamin', 'P');
        } elseif ($kategori === 'junior') {
            $builder->where('TIMESTAMPDIFF(YEAR, atlet.tanggal_lahir, CURDATE()) <', 18);
        } elseif ($kategori === 'senior') {
            $builder->where('TIMESTAMPDIFF(YEAR, atlet.tanggal_lahir, CURDATE()) >=', 18);
        }

        return $builder->orderBy('posisi', 'ASC')->findAll();
    }

    /**
     * Get all available kategori
     */
    public function getAllKategori()
    {
        return [
            'all' => 'Semua',
            'putra' => 'Putra',
            'putri' => 'Putri',
            'junior' => 'Junior (U-18)',
            'senior' => 'Senior (18+)'
        ];
    }
}
