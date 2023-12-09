<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProgramme extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'idUser' => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                ],
                'idProgramme' => [
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
            ],
        );


        $this->forge->addKey('id', true);
        $this->forge->createTable('user_programmes');
    }

    public function down()
    {
        //
    }
}
