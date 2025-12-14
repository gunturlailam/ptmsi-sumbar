<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateKlubForRegistration extends Migration
{
    public function up()
    {
        // Add new fields to klub table for registration system
        $fields = [
            'id_user' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'id_klub',
                'comment'    => 'User ID for klub login account'
            ],
            'sk_klub_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'status',
                'comment'    => 'Path to SK klub document'
            ],
            'identitas_pengurus_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'sk_klub_path',
                'comment'    => 'Path to pengurus identity document'
            ],
            'catatan_verifikasi' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'identitas_pengurus_path',
                'comment'    => 'Admin verification notes'
            ],
            'tanggal_verifikasi' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'catatan_verifikasi',
                'comment'    => 'Verification date'
            ],
            'diverifikasi_oleh' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'tanggal_verifikasi',
                'comment'    => 'Admin who verified'
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'diverifikasi_oleh',
                'comment'    => 'Registration date'
            ],
            'diperbarui_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'dibuat_pada',
                'comment'    => 'Last update date'
            ]
        ];

        $this->forge->addColumn('klub', $fields);

        // Add foreign key for id_user
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'SET NULL', 'CASCADE', 'klub');

        // Add foreign key for diverifikasi_oleh
        $this->forge->addForeignKey('diverifikasi_oleh', 'user', 'id_user', 'SET NULL', 'CASCADE', 'klub');

        // Update status field to use ENUM
        $this->db->query("ALTER TABLE klub MODIFY COLUMN status ENUM('pending', 'aktif', 'ditolak', 'nonaktif') DEFAULT 'pending'");
    }

    public function down()
    {
        // Drop foreign keys first
        $this->forge->dropForeignKey('klub', 'klub_id_user_foreign');
        $this->forge->dropForeignKey('klub', 'klub_diverifikasi_oleh_foreign');

        // Drop columns
        $this->forge->dropColumn('klub', [
            'id_user',
            'sk_klub_path',
            'identitas_pengurus_path',
            'catatan_verifikasi',
            'tanggal_verifikasi',
            'diverifikasi_oleh',
            'dibuat_pada',
            'diperbarui_pada'
        ]);

        // Revert status field
        $this->db->query("ALTER TABLE klub MODIFY COLUMN status VARCHAR(20) NULL");
    }
}
