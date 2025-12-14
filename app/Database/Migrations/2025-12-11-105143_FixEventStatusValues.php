<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixEventStatusValues extends Migration
{
    public function up()
    {
        // Update existing status values to match admin controller expectations
        $this->db->query("UPDATE event SET status = 'aktif' WHERE status = 'dibuka'");

        // Add a third event for testing
        $this->db->table('event')->insert([
            'judul' => 'Kejuaraan Nasional Junior 2025 - Kategori U-15',
            'id_turnamen' => 3,
            'id_klub_penyelenggara' => 3,
            'tanggal_mulai' => '2025-12-20',
            'tanggal_selesai' => '2025-12-25',
            'lokasi' => 'GOR Bukittinggi Sport Center',
            'batas_pendaftaran' => '2025-12-10',
            'status' => 'draft',
        ]);
    }

    public function down()
    {
        // Revert status values
        $this->db->query("UPDATE event SET status = 'dibuka' WHERE status = 'aktif'");

        // Remove the added event
        $this->db->query("DELETE FROM event WHERE judul = 'Kejuaraan Nasional Junior 2025 - Kategori U-15'");
    }
}
