<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Financement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idFinancement' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nature' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idDepense' => [
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
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 
        ]);
        

        $this->forge->addKey('idFinancement', true);
        $this->forge->createTable('financement');
    }

    public function down()
    {
        $this->forge->dropTable('financement');
    }
}
