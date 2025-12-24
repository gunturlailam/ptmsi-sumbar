<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRatingAtletTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rating' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_atlet' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_penilai' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'rating' => [
                'type' => 'DECIMAL',
                'constraint' => '3,2',
                'comment' => '1.0 - 5.0',
            ],
            'kategori' => [
                'type' => 'ENUM',
                'constraint' => ['teknik', 'kecepatan', 'ketahanan', 'mental', 'sportivitas'],
            ],
            'komentar' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'dibuat_pada' => [
                'type' => 'DATETIME',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id_rating', false, false, 'PRIMARY');
        $this->forge->addKey('id_atlet');
        $this->forge->addKey('id_penilai');
        $this->forge->addKey('kategori');
        $this->forge->createTable('rating_atlet');
    }

    public function down()
    {
        $this->forge->dropTable('rating_atlet');
    }
}
