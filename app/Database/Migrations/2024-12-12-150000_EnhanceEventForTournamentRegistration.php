<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EnhanceEventForTournamentRegistration extends Migration
{
    public function up()
    {
        // Cek kolom yang sudah ada di tabel event
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('event');

        // Tambah kolom untuk logika pendaftaran turnamen
        $newFields = [];

        if (!in_array('nama_event', $fields)) {
            $newFields['nama_event'] = [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
            ];
        }

        if (!in_array('deskripsi', $fields)) {
            $newFields['deskripsi'] = [
                'type'       => 'TEXT',
                'null'       => true,
            ];
        }

        if (!in_array('kategori_usia', $fields)) {
            $newFields['kategori_usia'] = [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ];
        }

        if (!in_array('kategori_gender', $fields)) {
            $newFields['kategori_gender'] = [
                'type'       => 'ENUM',
                'constraint' => ['putra', 'putri', 'campuran'],
                'null'       => true,
            ];
        }

        if (!in_array('kuota_peserta', $fields)) {
            $newFields['kuota_peserta'] = [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
            ];
        }

        if (!in_array('biaya_pendaftaran', $fields)) {
            $newFields['biaya_pendaftaran'] = [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'default'    => 0,
            ];
        }

        if (!in_array('syarat_khusus', $fields)) {
            $newFields['syarat_khusus'] = [
                'type'       => 'TEXT',
                'null'       => true,
            ];
        }

        if (!in_array('tingkat', $fields)) {
            $newFields['tingkat'] = [
                'type'       => 'ENUM',
                'constraint' => ['kabupaten', 'kota', 'provinsi', 'nasional'],
                'null'       => true,
                'default'    => 'kabupaten',
            ];
        }

        if (!in_array('id_organisasi', $fields)) {
            $newFields['id_organisasi'] = [
                'type'       => 'VARCHAR',
                'constraint' => 36,
                'null'       => true,
            ];
        }

        if (!in_array('dibuat_oleh', $fields)) {
            $newFields['dibuat_oleh'] = [
                'type'       => 'VARCHAR',
                'constraint' => 36,
                'null'       => true,
            ];
        }

        if (!in_array('dibuat_pada', $fields)) {
            $newFields['dibuat_pada'] = [
                'type'       => 'DATETIME',
                'null'       => true,
            ];
        }

        // Tambahkan kolom yang belum ada
        if (!empty($newFields)) {
            $this->forge->addColumn('event', $newFields);
        }

        // Update status enum untuk event
        $this->db->query("ALTER TABLE event MODIFY COLUMN status ENUM('draft', 'aktif', 'ditutup', 'selesai', 'dibatalkan') DEFAULT 'draft'");
    }

    public function down()
    {
        $this->forge->dropColumn('event', [
            'nama_event',
            'deskripsi',
            'kategori_usia',
            'kategori_gender',
            'kuota_peserta',
            'biaya_pendaftaran',
            'syarat_khusus',
            'tingkat',
            'id_organisasi',
            'dibuat_oleh',
            'dibuat_pada',
        ]);
    }
}
