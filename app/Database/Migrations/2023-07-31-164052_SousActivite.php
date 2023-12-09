<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SousActivite extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idSousActiv' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'chronogramme' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'bailleur' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'etatbudget' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'idActivite' => [
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
        

        $this->forge->addKey('idSousActiv', true);
        $this->forge->createTable('sousactivite');
    }

    public function down()
    {
        $this->forge->dropTable('sousactivite');
    }
}
