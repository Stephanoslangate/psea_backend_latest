<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Processus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idProcessus' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'version' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
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
        

        $this->forge->addKey('idProcessus', true);
        $this->forge->createTable('processus');
    }

    public function down()
    {
        $this->forge->dropTable('processus');
    }
}
