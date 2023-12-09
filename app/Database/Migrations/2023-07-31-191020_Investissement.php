<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Investissement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idInvesti' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomInvestissement' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'cibleInvestissement' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'origineInvestissement' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'montantInvestissement' => [
                'type'           => 'INT',
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
            'idProjet' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'date_validation' => [
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
        

        $this->forge->addKey('idInvesti', true);
        $this->forge->createTable('investissement');
    }

    public function down()
    {
        $this->forge->dropTable('investissement');
    }
}
