<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBracketTurnamenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bracket' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_event' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'sistem_pertandingan' => [
                'type'       => 'ENUM',
                'constraint' => ['single_elimination', 'double_elimination', 'round_robin', 'group_stage'],
                'default'    => 'single_elimination',
                'null'       => false,
            ],
            'jumlah_peserta' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'data_bracket' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => 'JSON data untuk bracket structure',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'aktif', 'selesai'],
                'default'    => 'draft',
                'null'       => false,
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

        $this->forge->addKey('id_bracket', true);
        $this->forge->addForeignKey('id_event', 'event', 'id_event', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bracket_turnamen');
    }

    public function down()
    {
        $this->forge->dropTable('bracket_turnamen');
    }
}
