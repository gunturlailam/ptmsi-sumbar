<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKlubTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_klub' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_organisasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'penanggung_jawab' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'tanggal_berdiri' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_klub', true); // primary key
        $this->forge->addForeignKey('id_organisasi', 'organisasi', 'id_organisasi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('klub');
    }

    public function down()
    {
        $this->forge->dropTable('klub');
    }
}
