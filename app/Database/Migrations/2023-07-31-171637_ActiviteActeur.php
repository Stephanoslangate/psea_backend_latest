<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActiviteActeur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idActiviteAct' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'commentaire' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'dateeffective' => [
                'type' => 'DATETIME',
            ],
            'idActeur' => [
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
        

        $this->forge->addKey('idActiviteAct', true);
        $this->forge->createTable('activiteacteur');
    }

    public function down()
    {
        $this->forge->dropTable('activiteacteur');
    }
}
