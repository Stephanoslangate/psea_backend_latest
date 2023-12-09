<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projet extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idProjet' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomProjet' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'budgetAlloue' => [
                'type'           => 'INT',
            ],
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'date_debut' => [
                'type' => 'DATETIME',
            ],
            'date_fin' => [
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
        

        $this->forge->addKey('idProjet', true);
        $this->forge->createTable('projet');
    }

    public function down()
    {
        $this->forge->dropTable('projet');
    }
}
