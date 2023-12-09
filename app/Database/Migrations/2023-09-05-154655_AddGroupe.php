<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGroupe extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idGroupe' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        

        $this->forge->addKey('idGroupe', true);
        $this->forge->createTable('groupe');
    }

    public function down()
    {
        //
    }
}
