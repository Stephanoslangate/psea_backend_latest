<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeProgramme extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idType' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomTypeProg' => [
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
        

        $this->forge->addKey('idType', true);
        $this->forge->createTable('typeprogramme');
    }

    public function down()
    {
        $this->forge->dropTable('typeprogramme');

    }
}
