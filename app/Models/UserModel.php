<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = false; // Using UUID
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_user',
        'username',
        'email',
        'password_hash',
        'nama_lengkap',
        'nohp',
        'peran',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diperbarui_pada';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[user.username,id_user,{id_user}]',
        'email' => 'required|valid_email|is_unique[user.email,id_user,{id_user}]',
        'password_hash' => 'permit_empty',
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'peran' => 'permit_empty|in_list[admin,user,atlet,pelatih,pengurus,admin_klub,ofisial,pengunjung]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'max_length' => 'Username maksimal 50 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'password_hash' => [
            'min_length' => 'Password minimal 8 karakter'
        ],
        'nama_lengkap' => [
            'required' => 'Nama lengkap harus diisi',
            'min_length' => 'Nama lengkap minimal 3 karakter',
            'max_length' => 'Nama lengkap maksimal 100 karakter'
        ],
        'peran' => [
            'in_list' => 'Role tidak valid'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash password before insert/update
     */
    protected function hashPassword(array $data)
    {
        // Handle 'password' field
        if (isset($data['data']['password'])) {
            // Only hash if password is not already hashed
            if (strlen($data['data']['password']) < 60) {
                $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
                // Also set password_hash for compatibility
                $data['data']['password_hash'] = $data['data']['password'];
            }
        }

        // Handle 'password_hash' field
        if (isset($data['data']['password_hash'])) {
            // Only hash if password is not already hashed
            if (strlen($data['data']['password_hash']) < 60) {
                $data['data']['password_hash'] = password_hash($data['data']['password_hash'], PASSWORD_DEFAULT);
            }
        }

        return $data;
    }

    /**
     * Get user by username or email
     */
    public function getUserByUsernameOrEmail($identifier)
    {
        $user = $this->where('username', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        // Normalize field names for compatibility
        if ($user) {
            if (isset($user['password_hash']) && !isset($user['password'])) {
                $user['password'] = $user['password_hash'];
            }
            if (isset($user['peran']) && !isset($user['role'])) {
                $user['role'] = $user['peran'];
            }
            if (isset($user['nohp']) && !isset($user['no_hp'])) {
                $user['no_hp'] = $user['nohp'];
            }
        }

        return $user;
    }

    /**
     * Get all users
     */
    public function getAllUsers()
    {
        return $this->findAll();
    }

    /**
     * Get users by role (peran)
     */
    public function getUsersByRole($role)
    {
        return $this->where('peran', $role)->findAll();
    }

    /**
     * Check if username exists
     */
    public function usernameExists($username, $excludeId = null)
    {
        $builder = $this->where('username', $username);
        if ($excludeId) {
            $builder->where('id_user !=', $excludeId);
        }
        return $builder->countAllResults() > 0;
    }

    /**
     * Check if email exists
     */
    public function emailExists($email, $excludeId = null)
    {
        $builder = $this->where('email', $email);
        if ($excludeId) {
            $builder->where('id_user !=', $excludeId);
        }
        return $builder->countAllResults() > 0;
    }
}
