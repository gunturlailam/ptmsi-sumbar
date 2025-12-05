<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTurnamenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_turnamen' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'tingkat' => [
                'type'       => 'ENUM',
                'constraint' => ['provinsi', 'nasional', 'open'],
                'null'       => false,
            ],
            'tahun_musim' => [
                'type'       => 'YEAR',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_turnamen', true); // primary key
        $this->forge->createTable('turnamen');
    }

    public function down()
    {
        $this->forge->dropTable('turnamen');
    }
}
