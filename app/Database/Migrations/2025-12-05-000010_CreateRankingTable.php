<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRankingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ranking' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_atlet' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'kategori_usia' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'posisi' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false,
            ],
            'poin' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'tanggal_berlaku' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_ranking', true); // primary key
        $this->forge->addForeignKey('id_atlet', 'atlet', 'id_atlet', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ranking');
    }

    public function down()
    {
        $this->forge->dropTable('ranking');
    }
}
