<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Acteur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idActeur' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'typeActeur' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'idEmploye' => [
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
        

        $this->forge->addKey('idActeur', true);
        $this->forge->createTable('acteur');
    }

    public function down()
    {
        $this->forge->dropTable('acteur');
    }
}
