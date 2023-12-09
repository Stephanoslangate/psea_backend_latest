<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Source extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomSource' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'idFinancement' => [
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
        

        $this->forge->addKey('id', true);
        $this->forge->createTable('source');
    }

    public function down()
    {
        $this->forge->dropTable('source');
    }
}
