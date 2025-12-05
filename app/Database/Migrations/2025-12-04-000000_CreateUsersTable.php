<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'        => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],

            'peran'          => [
                'type'       => 'ENUM',
                'constraint' => ['pengunjung', 'atlet', 'pelatih', 'admin_klub', 'ofisial', 'admin'],
                'default'    => 'pengunjung',
            ],

            'username'  => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],

            'email'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],

            'password_hash'  => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],

            'nama_lengkap'   => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],

            'nohp'        => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],

            'dibuat_pada'    => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],

            'diperbarui_pada' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_user', true); // primary key
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('id_user');
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
