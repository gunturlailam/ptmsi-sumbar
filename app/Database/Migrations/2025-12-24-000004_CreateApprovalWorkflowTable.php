<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApprovalWorkflowTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_approval' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tipe_permohonan' => [
                'type' => 'ENUM',
                'constraint' => ['atlet', 'pelatih', 'klub', 'event', 'berita'],
            ],
            'id_referensi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'disetujui', 'ditolak', 'revisi'],
                'default' => 'pending',
            ],
            'prioritas' => [
                'type' => 'ENUM',
                'constraint' => ['rendah', 'normal', 'tinggi', 'urgent'],
                'default' => 'normal',
            ],
            'pemohon_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'penyetuju_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'catatan_pemohon' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'catatan_penyetuju' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_permohonan' => [
                'type' => 'DATETIME',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'tanggal_persetujuan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deadline' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_approval', false, false, 'PRIMARY');
        $this->forge->addKey('tipe_permohonan');
        $this->forge->addKey('status');
        $this->forge->addKey('prioritas');
        $this->forge->addKey('tanggal_permohonan');
        $this->forge->createTable('approval_workflow');
    }

    public function down()
    {
        $this->forge->dropTable('approval_workflow');
    }
}
