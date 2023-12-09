<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Modalite extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idMod' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
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
        

        $this->forge->addKey('idMod', true);
        $this->forge->createTable('modalite');
    }

    public function down()
    {
        $this->forge->dropTable('modalite');
    }
}
