<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFotoKategoriToBeritaTable extends Migration
{
    public function up()
    {
        $fields = [
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Path to news image file',
                'after'      => 'konten'
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'News category: kejuaraan, atlet, pengumuman, artikel',
                'after'      => 'foto'
            ]
        ];

        $this->forge->addColumn('berita', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('berita', ['foto', 'kategori']);
    }
}
