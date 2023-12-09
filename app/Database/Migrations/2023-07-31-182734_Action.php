<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Action extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idAction' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'delais' => [
                'type'       => 'INT',
            ],
            'idEmploye' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idIndictateur' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'date' => [
                'type' => 'DATETIME',
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
        

        $this->forge->addKey('idAction', true);
        $this->forge->createTable('action');
    
    }

    public function down()
    {
        $this->forge->dropTable('action');
    }
}
