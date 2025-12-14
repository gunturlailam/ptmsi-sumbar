<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePendaftaranEventTable extends Migration
{
    public function up()
    {
        // Cek kolom yang sudah ada
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('pendaftaran_event');

        // Tambah kolom untuk alur pendaftaran turnamen yang lebih lengkap
        $newFields = [];

        if (!in_array('kategori', $fields)) {
            $newFields['kategori'] = [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ];
        }

        if (!in_array('nama_atlet1', $fields)) {
            $newFields['nama_atlet1'] = [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ];
        }

        if (!in_array('nama_atlet2', $fields)) {
            $newFields['nama_atlet2'] = [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ];
        }

        if (!in_array('nohp_pendaftar', $fields)) {
            $newFields['nohp_pendaftar'] = [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
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

        if (!in_array('bukti_pembayaran', $fields)) {
            $newFields['bukti_pembayaran'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ];
        }

        if (!in_array('tanggal_pembayaran', $fields)) {
            $newFields['tanggal_pembayaran'] = [
                'type'       => 'DATETIME',
                'null'       => true,
            ];
        }

        if (!in_array('status_verifikasi', $fields)) {
            $newFields['status_verifikasi'] = [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'diverifikasi', 'ditolak'],
                'default'    => 'pending',
                'null'       => false,
            ];
        }

        if (!in_array('tanggal_verifikasi', $fields)) {
            $newFields['tanggal_verifikasi'] = [
                'type'       => 'DATETIME',
                'null'       => true,
            ];
        }

        if (!in_array('catatan_verifikasi', $fields)) {
            $newFields['catatan_verifikasi'] = [
                'type'       => 'TEXT',
                'null'       => true,
            ];
        }

        if (!in_array('nomor_peserta', $fields)) {
            $newFields['nomor_peserta'] = [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ];
        }

        // Tambahkan kolom yang belum ada
        if (!empty($newFields)) {
            $this->forge->addColumn('pendaftaran_event', $newFields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('pendaftaran_event', [
            'kategori',
            'nama_atlet1',
            'nama_atlet2',
            'nohp_pendaftar',
            'biaya_pendaftaran',
            'bukti_pembayaran',
            'tanggal_pembayaran',
            'status_verifikasi',
            'tanggal_verifikasi',
            'catatan_verifikasi',
            'nomor_peserta',
        ]);
    }
}
