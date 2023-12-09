<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ObjectifSpecifique extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idObjectifSpe' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'missionObjectifSpe' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'idObj' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idObjectifStra' => [
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
        

        $this->forge->addKey('idObjectifSpe', true);
        $this->forge->createTable('objectifspecifique');
    }

    public function down()
    {
        $this->forge->dropTable('objectifspecifique');
    }
}
