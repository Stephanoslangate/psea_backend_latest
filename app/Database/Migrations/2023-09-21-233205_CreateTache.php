<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTache extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idTache' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'pourcentage' => [
                'type'       => 'INT',
            ],
            'validee' => [
                'type'       => 'BOOLEAN',
            ],
            'idSousActivite' => [
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


        $this->forge->addKey('idTache', true);
        $this->forge->createTable('tache');
    }

    public function down()
    {
        $this->forge->dropTable('tache');

    }
}
