<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ObjectifStrategique extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idObjectifStra' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'anneecible' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idObj' => [
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
        

        $this->forge->addKey('idObjectifStra', true);
        $this->forge->createTable('objectifstrategique');

    }

    public function down()
    {
        $this->forge->dropTable('objectifstrategique');

    }
}
