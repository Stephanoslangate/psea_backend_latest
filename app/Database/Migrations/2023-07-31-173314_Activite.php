<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Activite extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idActivite' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'delais' => [
                'type'           => 'INT',
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'idFaitGen' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idMod' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idMaillon' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idProcedure' => [
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
        

        $this->forge->addKey('idActivite', true);
        $this->forge->createTable('activite');
    }

    public function down()
    {
        $this->forge->dropTable('activite');
    }
}
