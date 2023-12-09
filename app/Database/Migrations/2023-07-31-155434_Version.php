<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Version extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idVers' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomVers' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
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
        

        $this->forge->addKey('idVers', true);
        $this->forge->createTable('version');
    }

    public function down()
    {
        $this->forge->dropTable('version');
    }
}
