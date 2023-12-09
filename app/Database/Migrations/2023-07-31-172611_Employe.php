<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employe extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idEmploye' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'prenom' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'fonction' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            
            'idService' => [
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
        

        $this->forge->addKey('idEmploye', true);
        $this->forge->createTable('employe');
    }

    public function down()
    {
        $this->forge->dropTable('employe');
    }
}
