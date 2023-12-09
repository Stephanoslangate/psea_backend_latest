<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Procedure extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idProcedure' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'reference' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'datemiseajour' => [
                'type' => 'DATETIME',
            ],
            'idProcessus' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'etat' => [
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
        

        $this->forge->addKey('idProcedure', true);
        $this->forge->createTable('procedure');
    }

    public function down()
    {
        $this->forge->dropTable('procedure');
    }
}
