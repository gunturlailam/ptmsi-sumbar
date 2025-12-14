<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAtletCrudFields extends Migration
{
    public function up()
    {
        // Check existing fields
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('atlet');

        $newFields = [];

        // Add tanggal_bergabung field for tracking when athlete joined
        if (!in_array('tanggal_bergabung', $fields)) {
            $newFields['tanggal_bergabung'] = [
                'type'       => 'DATE',
                'null'       => true,
            ];
        }

        // Add alasan_nonaktif field for tracking deactivation reason
        if (!in_array('alasan_nonaktif', $fields)) {
            $newFields['alasan_nonaktif'] = [
                'type'       => 'TEXT',
                'null'       => true,
            ];
        }

        // Add tanggal_nonaktif field for tracking deactivation date
        if (!in_array('tanggal_nonaktif', $fields)) {
            $newFields['tanggal_nonaktif'] = [
                'type'       => 'DATE',
                'null'       => true,
            ];
        }

        // Add fields if they don't exist
        if (!empty($newFields)) {
            $this->forge->addColumn('atlet', $newFields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('atlet', [
            'tanggal_bergabung',
            'alasan_nonaktif',
            'tanggal_nonaktif'
        ]);
    }
}
