<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendaftaranPelatihTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pendaftaran_pelatih' => [
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
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => false,
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'jenis_pelatih' => [
                'type'       => 'ENUM',
                'constraint' => ['pelatih', 'wasit'],
                'null'       => false,
            ],
            'id_klub' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'foto_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'sertifikat_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu_verifikasi_provinsi', 'diterima', 'ditolak'],
                'default'    => 'menunggu_verifikasi_provinsi',
                'null'       => false,
            ],
            'tanggal_daftar' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'didaftarkan_oleh' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'catatan_provinsi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'tanggal_verifikasi' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'diverifikasi_oleh' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
            ],
            'id_pelatih' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'ID pelatih setelah diaktivasi',
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'diperbarui_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_pendaftaran_pelatih', true);
        $this->forge->addForeignKey('id_klub', 'klub', 'id_klub', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('didaftarkan_oleh', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('diverifikasi_oleh', 'user', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_pelatih', 'pelatih', 'id_pelatih', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pendaftaran_pelatih');
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran_pelatih');
    }
}
