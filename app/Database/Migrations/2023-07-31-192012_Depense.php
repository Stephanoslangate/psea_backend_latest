<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Depense extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDepense' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'natureDepense' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'idProg' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idCible' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idCredit' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'idAction' => [
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
        

        $this->forge->addKey('idDepense', true);
        $this->forge->createTable('depense');

    }

    public function down()
    {
        $this->forge->dropTable('depense');
    }
}
