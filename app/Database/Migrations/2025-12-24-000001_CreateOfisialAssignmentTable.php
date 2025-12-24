<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOfisialAssignmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_assignment' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_ofisial' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'id_event' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'role_assignment' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'wasit',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'aktif',
            ],
            'dibuat_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'diperbarui_pada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_assignment', true);
        $this->forge->addKey('id_ofisial');
        $this->forge->addKey('id_event');
        $this->forge->createTable('ofisial_assignment');
    }

    public function down()
    {
        $this->forge->dropTable('ofisial_assignment');
    }
}
