<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrganisasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_organisasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'auto_increment' => true,
            ],
            'nama_organisasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['provinsi', 'kabupaten'],
                'null'       => false,
            ],
            'id_induk_organisasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'nohp' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_organisasi', true); // primary key
        $this->forge->addForeignKey('id_induk_organisasi', 'organisasi', 'id_organisasi', 'SET NULL', 'CASCADE');
        $this->forge->createTable('organisasi');
    }

    public function down()
    {
        $this->forge->dropTable('organisasi');
    }
}
