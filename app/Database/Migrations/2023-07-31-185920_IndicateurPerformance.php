<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IndicateurPerformance extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idIndicateurAction' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'indice' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'commentaire' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'etat' => [
                'type'           => 'INT',
            ],
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idActivite' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idProjet' => [
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
        

        $this->forge->addKey('idIndictateur', true);
        $this->forge->createTable('indicateurperformance');
    }

    public function down()
    {
        $this->forge->dropTable('indicateurperformance');
    }
}
