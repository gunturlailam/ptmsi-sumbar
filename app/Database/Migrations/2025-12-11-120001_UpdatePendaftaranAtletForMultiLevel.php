<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePendaftaranAtletForMultiLevel extends Migration
{
    public function up()
    {
        // Add new fields for multi-level verification
        $fields = [
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => false,
                'after'      => 'nama_lengkap',
                'comment'    => 'NIK from KTP'
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'after'      => 'nik',
                'comment'    => 'Place of birth'
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => false,
                'after'      => 'jenis_kelamin',
                'comment'    => 'Full address'
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
                'after'      => 'alamat',
                'comment'    => 'Phone number'
            ],
            'kategori_usia' => [
                'type'       => 'ENUM',
                'constraint' => ['U-12', 'U-15', 'U-18', 'Senior'],
                'null'       => false,
                'after'      => 'no_hp',
                'comment'    => 'Age category'
            ],
            'id_klub' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'kategori_usia',
                'comment'    => 'Klub ID'
            ],
            'foto_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'id_klub',
                'comment'    => 'Path to athlete photo'
            ],
            'ktp_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'foto_path',
                'comment'    => 'Path to KTP scan'
            ],
            'tanggal_daftar' => [
                'type'       => 'DATETIME',
                'null'       => false,
                'after'      => 'ktp_path',
                'comment'    => 'Registration date'
            ],
            'didaftarkan_oleh' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
                'after'      => 'tanggal_daftar',
                'comment'    => 'Registered by user ID'
            ],
            'catatan_klub' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'didaftarkan_oleh',
                'comment'    => 'Klub verification notes'
            ],
            'tanggal_verifikasi_klub' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'catatan_klub',
                'comment'    => 'Klub verification date'
            ],
            'diverifikasi_klub_oleh' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'tanggal_verifikasi_klub',
                'comment'    => 'Klub verifier user ID'
            ],
            'catatan_provinsi' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'diverifikasi_klub_oleh',
                'comment'    => 'Province admin notes'
            ],
            'tanggal_verifikasi_provinsi' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'catatan_provinsi',
                'comment'    => 'Province verification date'
            ],
            'diverifikasi_provinsi_oleh' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'tanggal_verifikasi_provinsi',
                'comment'    => 'Province verifier user ID'
            ]
        ];

        $this->forge->addColumn('pendaftaran_atlet', $fields);

        // Add foreign keys
        $this->forge->addForeignKey('id_klub', 'klub', 'id_klub', 'CASCADE', 'CASCADE', 'pendaftaran_atlet');
        $this->forge->addForeignKey('didaftarkan_oleh', 'user', 'id_user', 'CASCADE', 'CASCADE', 'pendaftaran_atlet');
        $this->forge->addForeignKey('diverifikasi_klub_oleh', 'user', 'id_user', 'SET NULL', 'CASCADE', 'pendaftaran_atlet');
        $this->forge->addForeignKey('diverifikasi_provinsi_oleh', 'user', 'id_user', 'SET NULL', 'CASCADE', 'pendaftaran_atlet');

        // Update status field to support multi-level verification
        $this->db->query("ALTER TABLE pendaftaran_atlet MODIFY COLUMN status ENUM('menunggu_verifikasi_klub', 'menunggu_verifikasi_provinsi', 'diterima', 'ditolak_klub', 'ditolak_provinsi') DEFAULT 'menunggu_verifikasi_klub'");

        // Remove old fields that are no longer needed
        $this->forge->dropColumn('pendaftaran_atlet', ['klub', 'nohp', 'dokumen_path']);
    }

    public function down()
    {
        // Drop foreign keys
        $this->forge->dropForeignKey('pendaftaran_atlet', 'pendaftaran_atlet_id_klub_foreign');
        $this->forge->dropForeignKey('pendaftaran_atlet', 'pendaftaran_atlet_didaftarkan_oleh_foreign');
        $this->forge->dropForeignKey('pendaftaran_atlet', 'pendaftaran_atlet_diverifikasi_klub_oleh_foreign');
        $this->forge->dropForeignKey('pendaftaran_atlet', 'pendaftaran_atlet_diverifikasi_provinsi_oleh_foreign');

        // Drop new columns
        $this->forge->dropColumn('pendaftaran_atlet', [
            'nik',
            'tempat_lahir',
            'alamat',
            'no_hp',
            'kategori_usia',
            'id_klub',
            'foto_path',
            'ktp_path',
            'tanggal_daftar',
            'didaftarkan_oleh',
            'catatan_klub',
            'tanggal_verifikasi_klub',
            'diverifikasi_klub_oleh',
            'catatan_provinsi',
            'tanggal_verifikasi_provinsi',
            'diverifikasi_provinsi_oleh'
        ]);

        // Restore old fields
        $oldFields = [
            'klub' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nohp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'dokumen_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ]
        ];

        $this->forge->addColumn('pendaftaran_atlet', $oldFields);

        // Revert status field
        $this->db->query("ALTER TABLE pendaftaran_atlet MODIFY COLUMN status ENUM('pending', 'diverifikasi', 'diterima', 'ditolak') DEFAULT 'pending'");
    }
}
