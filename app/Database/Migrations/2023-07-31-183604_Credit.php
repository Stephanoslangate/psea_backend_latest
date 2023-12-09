<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Credit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idCredit' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomCredit' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idAction' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idProg' => [
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
        

        $this->forge->addKey('idCredit', true);
        $this->forge->createTable('credit');
    }

    public function down()
    {
        $this->forge->dropTable('credit');
    }
}
