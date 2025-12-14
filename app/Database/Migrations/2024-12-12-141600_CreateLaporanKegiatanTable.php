<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaporanKegiatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_laporan' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'tanggal_kegiatan' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tanggal_laporan' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'id_organisasi' => [
                'type' => 'VARCHAR',
                'constraint' => 36,
                'null' => false,
            ],
            'dibuat_oleh' => [
                'type' => 'VARCHAR',
                'constraint' => 36,
                'null' => false,
            ],
            'dibuat_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'diperbarui_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_laporan', true);
        // Note: Foreign keys will be added later if needed
        $this->forge->createTable('laporan_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_kegiatan');
    }
}
