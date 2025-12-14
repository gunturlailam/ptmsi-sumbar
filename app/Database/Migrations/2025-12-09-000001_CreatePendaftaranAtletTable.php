<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendaftaranAtletTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pendaftaran_atlet' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'tanggal_lahir' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
                'null'       => false,
            ],
            'klub' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
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
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'diverifikasi', 'diterima', 'ditolak'],
                'default'    => 'pending',
                'null'       => false,
            ],
            'catatan_admin' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'id_admin_verifikator' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
            ],
            'tanggal_verifikasi' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'id_atlet' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'ID atlet setelah diaktivasi',
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'diupdate_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_pendaftaran_atlet', true);
        $this->forge->addForeignKey('id_admin_verifikator', 'user', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_atlet', 'atlet', 'id_atlet', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pendaftaran_atlet');
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran_atlet');
    }
}
