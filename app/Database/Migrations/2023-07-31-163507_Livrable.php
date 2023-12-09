<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Livrable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idLivrable' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomLivrable' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'date_emission' => [
                'type' => 'DATETIME',
            ],
            'idActivite' => [
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
        

        $this->forge->addKey('idLivrable', true);
        $this->forge->createTable('livrable');
    }

    public function down()
    {
        $this->forge->dropTable('livrable');
    }
}
