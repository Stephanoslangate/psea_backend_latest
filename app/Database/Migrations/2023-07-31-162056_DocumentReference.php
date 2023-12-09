<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DocumentReference extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDocument' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomDocument' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'sourceDocument' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'idActivite' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 
        ]);
        

        $this->forge->addKey('idDocument', true);
        $this->forge->createTable('documentreference');
    }

    public function down()
    {
        $this->forge->dropTable('documentreference');
    }
}
