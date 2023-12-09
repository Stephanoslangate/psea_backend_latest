<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cible extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idCible' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomCible' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
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
        

        $this->forge->addKey('idCible', true);
        $this->forge->createTable('cible');
    }

    public function down()
    {
        $this->forge->dropTable('cible');
    }
}
