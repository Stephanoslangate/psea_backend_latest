<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Resultat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idResultat' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomResultat' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'typeResultat' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'dateResultat' => [
                'type' => 'DATETIME',
            ],
            'idObjectifStra' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idObjectifSpe' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idAction' => [
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
        

        $this->forge->addKey('idResultat', true);
        $this->forge->createTable('resultat');
    }

    public function down()
    {
        $this->forge->dropTable('resultat');
    }
}
