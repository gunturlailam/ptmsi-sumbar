<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnduhanDokumenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_unduhan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_dokumen' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_user' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
            ],
            'diunduh_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_unduhan', true); // primary key
        $this->forge->addForeignKey('id_dokumen', 'dokumen', 'id_dokumen', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->createTable('unduhan_dokumen');
    }

    public function down()
    {
        $this->forge->dropTable('unduhan_dokumen');
    }
}
