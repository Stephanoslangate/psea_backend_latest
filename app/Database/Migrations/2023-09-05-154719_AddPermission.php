<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPermission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idPermission' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'permission' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        

        $this->forge->addKey('idPermission', true);
        $this->forge->createTable('permission');
    }

    public function down()
    {
        //
    }
}
