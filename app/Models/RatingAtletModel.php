<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingAtletModel extends Model
{
    protected $table = 'rating_atlet';
    protected $primaryKey = 'id_rating';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_atlet',
        'id_penilai',
        'rating',
        'kategori',
        'komentar',
        'dibuat_pada'
    ];
    protected $useTimestamps = false;

    /**
     * Add rating for athlete
     */
    public function addRating($idAtlet, $idPenilai, $rating, $kategori, $komentar = null)
    {
        return $this->insert([
            'id_atlet' => $idAtlet,
            'id_penilai' => $idPenilai,
            'rating' => $rating,
            'kategori' => $kategori,
            'komentar' => $komentar,
            'dibuat_pada' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get average rating for athlete
     */
    public function getAverageRating($idAtlet)
    {
        $result = $this->select('AVG(rating) as rata_rata, COUNT(*) as total_rating')
            ->where('id_atlet', $idAtlet)
            ->first();

        return $result ?? ['rata_rata' => 0, 'total_rating' => 0];
    }

    /**
     * Get rating by category
     */
    public function getRatingByCategory($idAtlet)
    {
        return $this->select('kategori, AVG(rating) as rata_rata, COUNT(*) as total')
            ->where('id_atlet', $idAtlet)
            ->groupBy('kategori')
            ->findAll();
    }

    /**
     * Get athlete ratings with details
     */
    public function getAtletRatings($idAtlet, $limit = 20)
    {
        return $this->select('rating_atlet.*, user.nama_lengkap')
            ->join('user', 'user.id_user = rating_atlet.id_penilai', 'left')
            ->where('rating_atlet.id_atlet', $idAtlet)
            ->orderBy('rating_atlet.dibuat_pada', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get top rated athletes
     */
    public function getTopRatedAthletes($limit = 10)
    {
        $db = \Config\Database::connect();
        return $db->query(
            "
            SELECT a.id_atlet, u.nama_lengkap, k.nama as nama_klub,
                   AVG(r.rating) as rata_rata, COUNT(r.id_rating) as total_rating
            FROM atlet a
            JOIN user u ON u.id_user = a.id_user
            LEFT JOIN klub k ON k.id_klub = a.id_klub
            LEFT JOIN rating_atlet r ON r.id_atlet = a.id_atlet
            WHERE a.status = 'aktif'
            GROUP BY a.id_atlet, u.nama_lengkap, k.nama
            HAVING COUNT(r.id_rating) > 0
            ORDER BY rata_rata DESC
            LIMIT " . (int)$limit
        )->getResultArray();
    }

    /**
     * Get rating statistics
     */
    public function getRatingStatistics($idAtlet)
    {
        $db = \Config\Database::connect();
        return $db->query("
            SELECT 
                kategori,
                AVG(rating) as rata_rata,
                MIN(rating) as terendah,
                MAX(rating) as tertinggi,
                COUNT(*) as total
            FROM rating_atlet
            WHERE id_atlet = ?
            GROUP BY kategori
        ", [$idAtlet])->getResultArray();
    }

    /**
     * Check if user already rated athlete
     */
    public function hasUserRated($idAtlet, $idPenilai, $kategori)
    {
        return $this->where('id_atlet', $idAtlet)
            ->where('id_penilai', $idPenilai)
            ->where('kategori', $kategori)
            ->first();
    }

    /**
     * Update rating
     */
    public function updateRating($idRating, $rating, $komentar = null)
    {
        return $this->update($idRating, [
            'rating' => $rating,
            'komentar' => $komentar
        ]);
    }
}
