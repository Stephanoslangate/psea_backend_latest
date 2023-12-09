<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Maillonppbse extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idMaillon' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'nom' => [
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
        

        $this->forge->addKey('idMaillon', true);
        $this->forge->createTable('maillonppbse');
    }

    public function down()
    {
        $this->forge->dropTable('maillonppbse');
    }
}
