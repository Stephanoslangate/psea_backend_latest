<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ressource extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'typeRessource' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'zoneIntervention' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idFinancement' => [
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
        

        $this->forge->addKey('id', true);
        $this->forge->createTable('ressource');
    }

    public function down()
    {
        $this->forge->dropTable('ressource');
    }
}
