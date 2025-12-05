<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfisialTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ofisial' => [
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
            'nomor_lisensi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_ofisial', true); // primary key
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ofisial');
    }

    public function down()
    {
        $this->forge->dropTable('ofisial');
    }
}
