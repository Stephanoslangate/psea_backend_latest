<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Depenseactivite extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDep' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nature' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'justification' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'ae_ouvert' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'ae_execute' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'cp_ouvert' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'cp_execute' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
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
        

        $this->forge->addKey('idDep', true);
        $this->forge->createTable('depenseactivites');

    }

    public function down()
    {
        $this->forge->dropTable('depenseactivites');
    }
}
