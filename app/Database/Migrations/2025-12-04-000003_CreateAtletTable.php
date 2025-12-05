<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAtletTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_atlet' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'id_klub' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'tanggal_lahir' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'kategori_usia' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'ranking_provinsi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'dibuat_pada' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id_atlet', true); // primary key
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_klub', 'klub', 'id_klub', 'CASCADE', 'CASCADE');
        $this->forge->createTable('atlet');
    }

    public function down()
    {
        $this->forge->dropTable('atlet');
    }
}
