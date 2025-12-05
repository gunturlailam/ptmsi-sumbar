<?php


namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSertifikasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sertifikasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pelatih' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'jenis_sertifikasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'tanggal_dikeluarkan' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'tanggal_kadaluarsa' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'file_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_sertifikasi', true); // primary key
        $this->forge->addForeignKey('id_pelatih', 'pelatih', 'id_pelatih', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sertifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('sertifikasi');
    }
}
