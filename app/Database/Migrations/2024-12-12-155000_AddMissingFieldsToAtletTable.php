<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingFieldsToAtletTable extends Migration
{
    public function up()
    {
        // Cek kolom yang sudah ada di tabel atlet
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('atlet');

        // Tambah kolom yang diperlukan untuk dashboard atlet
        $newFields = [];

        if (!in_array('nama_lengkap', $fields)) {
            $newFields['nama_lengkap'] = [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ];
        }

        if (!in_array('alamat', $fields)) {
            $newFields['alamat'] = [
                'type'       => 'TEXT',
                'null'       => true,
            ];
        }

        if (!in_array('no_hp', $fields)) {
            $newFields['no_hp'] = [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ];
        }

        if (!in_array('foto', $fields)) {
            $newFields['foto'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ];
        }

        if (!in_array('tempat_lahir', $fields)) {
            $newFields['tempat_lahir'] = [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ];
        }

        if (!in_array('tinggi_badan', $fields)) {
            $newFields['tinggi_badan'] = [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ];
        }

        if (!in_array('berat_badan', $fields)) {
            $newFields['berat_badan'] = [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ];
        }

        if (!in_array('riwayat_prestasi', $fields)) {
            $newFields['riwayat_prestasi'] = [
                'type'       => 'TEXT',
                'null'       => true,
            ];
        }

        if (!in_array('diperbarui_pada', $fields)) {
            $newFields['diperbarui_pada'] = [
                'type'       => 'DATETIME',
                'null'       => true,
            ];
        }

        // Tambahkan kolom yang belum ada
        if (!empty($newFields)) {
            $this->forge->addColumn('atlet', $newFields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('atlet', [
            'nama_lengkap',
            'alamat',
            'no_hp',
            'foto',
            'tempat_lahir',
            'tinggi_badan',
            'berat_badan',
            'riwayat_prestasi',
            'diperbarui_pada',
        ]);
    }
}
