<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Programme extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomProg' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'idType' => [
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
        

        $this->forge->addKey('idProg', true);
        $this->forge->createTable('programme');

    }

    public function down()
    {
        $this->forge->dropTable('programme');
    }
}
