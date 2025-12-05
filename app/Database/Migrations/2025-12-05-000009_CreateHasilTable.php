<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hasil' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pertandingan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_pemenang_atlet' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // <-- harus nullable
            ],
            'skor' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'id_pelapor' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true, // <-- harus nullable
            ],
            'dicatat_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_hasil', true); // primary key
        $this->forge->addForeignKey('id_pertandingan', 'pertandingan', 'id_pertandingan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pemenang_atlet', 'atlet', 'id_atlet', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_pelapor', 'user', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->createTable('hasil');
    }

    public function down()
    {
        $this->forge->dropTable('hasil');
    }
}
