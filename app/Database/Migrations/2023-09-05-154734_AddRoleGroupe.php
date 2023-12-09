<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleGroupe extends Migration
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
            'idRole' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idGroupe' => [
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
        $this->forge->createTable('role_groupe');
    }

    public function down()
    {
        //
    }
}
