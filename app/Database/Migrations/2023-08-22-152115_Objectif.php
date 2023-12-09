<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Objectif extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idObj' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomObjectif' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idProg' => [
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
        

        $this->forge->addKey('idObj', true);
        $this->forge->createTable('objectif');
    }

    public function down()
    {
        $this->forge->dropTable('objectif');
    }
}
