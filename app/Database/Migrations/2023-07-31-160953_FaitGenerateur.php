<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FaitGenerateur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idFaitGen' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
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
        

        $this->forge->addKey('idFaitGen', true);
        $this->forge->createTable('faitgenerateur');
    }

    public function down()
    {
        $this->forge->dropTable('faitgenerateur');
    }
}
