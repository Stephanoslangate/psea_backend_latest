<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Structure extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idStruct' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomStruct' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
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
        

        $this->forge->addKey('idStruct', true);
        $this->forge->createTable('structure');
    }

    public function down()
    {
        $this->forge->dropTable('structure');
    }
}
