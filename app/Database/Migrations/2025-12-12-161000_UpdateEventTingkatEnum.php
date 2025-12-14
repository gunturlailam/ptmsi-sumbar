<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEventTingkatEnum extends Migration
{
    public function up()
    {
        // Update tingkat enum to only include appropriate levels for province
        // Remove 'nasional' since this is province-level system
        $this->db->query("ALTER TABLE event MODIFY COLUMN tingkat ENUM('kabupaten', 'kota', 'provinsi') DEFAULT 'provinsi'");

        // Update any existing 'nasional' events to 'provinsi'
        $this->db->query("UPDATE event SET tingkat = 'provinsi' WHERE tingkat = 'nasional'");

        echo "Event tingkat enum updated for province-level system!\n";
    }

    public function down()
    {
        // Revert back to include nasional
        $this->db->query("ALTER TABLE event MODIFY COLUMN tingkat ENUM('kabupaten', 'kota', 'provinsi', 'nasional') DEFAULT 'kabupaten'");
    }
}
